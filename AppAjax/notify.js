(function () {
  'use strict';

  /* ---------------- 1. Inject CSS once ---------------- */
  const STYLE_ID = 'notify-popup-styles';
  if (!document.getElementById(STYLE_ID)) {
    const style = document.createElement('style');
    style.id = STYLE_ID;
    style.textContent = `
      :root{
        --a1:#6366f1;
        --a2:#22d3ee;
      }

      .notify-overlay{
        position:fixed;
        inset:0;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:20px;
        background:rgba(15,23,42,.55);
        -webkit-backdrop-filter:blur(6px);
        backdrop-filter:blur(6px);
        opacity:0;
        visibility:hidden;
        transition:opacity .28s ease, visibility .28s ease;
        z-index:9999;
        perspective:1000px;
      }
      .notify-overlay.open{opacity:1;visibility:visible;}
      .notify-overlay.closing{opacity:0;}

      .notify-tilt{
        width:100%;
        max-width:360px;
        transform-style:preserve-3d;
        will-change:transform;
        transition:transform .25s cubic-bezier(.22,1,.36,1);
      }

      .notify-card{
        position:relative;
        background:#fff;
        border-radius:18px;
        padding:30px 26px 24px;
        text-align:center;
        box-shadow:0 30px 70px rgba(0,0,0,.35);
        transform:translateY(18px) scale(.96);
        opacity:0;
        transition:transform .34s cubic-bezier(.22,1,.36,1), opacity .34s ease;
        overflow:hidden;
        font-family:system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
      }
      .notify-overlay.open .notify-card{
        transform:translateY(0) scale(1);
        opacity:1;
      }

      .notify-card::before{
        content:"";
        position:absolute;
        top:0;left:0;right:0;
        height:4px;
        background:linear-gradient(90deg,var(--a1),var(--a2));
      }
      .notify-card[data-type="error"]::before{background:linear-gradient(90deg,#ef4444,#f97316);}
      .notify-card[data-type="warning"]::before{background:linear-gradient(90deg,#f59e0b,#fbbf24);}
      .notify-card[data-type="info"]::before{background:linear-gradient(90deg,#3b82f6,#22d3ee);}

      .notify-icon-wrap{
        position:relative;
        width:74px;
        height:74px;
        margin:0 auto 16px;
      }
      .notify-icon-box{
        width:100%;
        height:100%;
        border-radius:50%;
        display:grid;
        place-items:center;
        background:rgba(99,102,241,.12);
        color:var(--a1);
      }
      .notify-card[data-type="error"]   .notify-icon-box{background:rgba(239,68,68,.12); color:#ef4444;}
      .notify-card[data-type="warning"] .notify-icon-box{background:rgba(245,158,11,.14);color:#f59e0b;}
      .notify-card[data-type="info"]    .notify-icon-box{background:rgba(59,130,246,.12);color:#3b82f6;}

      .notify-icon-box svg{
        width:36px;height:36px;
        fill:none;
        stroke:currentColor;
        stroke-width:2;
        stroke-linecap:round;
        stroke-linejoin:round;
      }

      .notify-particle{
        position:absolute;
        top:50%;left:50%;
        width:7px;height:7px;
        border-radius:50%;
        opacity:0;
        pointer-events:none;
        animation:notifyPop .75s cubic-bezier(.22,1,.36,1) forwards;
      }
      @keyframes notifyPop{
        0%{opacity:1;transform:translate(-50%,-50%) scale(1);}
        100%{opacity:0;transform:translate(calc(-50% + var(--dx)),calc(-50% + var(--dy))) scale(.2);}
      }

      .notify-title{
        margin:0 0 8px;
        font-size:19px;
        color:#0f172a;
      }
      .notify-msg{
        margin:0;
        font-size:14px;
        line-height:1.55;
        color:#64748b;
      }

      .notify-actions{
        display:flex;
        gap:10px;
        margin-top:22px;
      }
      .notify-actions button{
        flex:1;
        padding:11px;
        border-radius:11px;
        font-size:14px;
        font-weight:600;
        cursor:pointer;
        border:0;
        transition:transform .15s ease, opacity .2s ease, background .2s ease;
      }
      .notify-actions button:active{transform:scale(.97);}
      .notify-ok{background:linear-gradient(135deg,var(--a1),var(--a2));color:#fff;}
      .notify-cancel{background:#f1f5f9;color:#64748b;}
      .notify-cancel:hover{background:#e2e8f0;}

      .notify-progress{
        position:absolute;
        bottom:0;left:0;
        height:3px;
        width:100%;
        transform-origin:left;
        background:linear-gradient(90deg,var(--a1),var(--a2));
        transform:scaleX(1);
      }
      @keyframes notifyFill{
        from{transform:scaleX(1);}
        to{transform:scaleX(0);}
      }

      @media (prefers-reduced-motion: reduce){
        .notify-overlay, .notify-card, .notify-particle{animation-duration:.01ms !important;transition-duration:.01ms !important;}
      }
    `;
    document.head.appendChild(style);
  }

  /* ---------------- 2. Icons ---------------- */
  const ICONS = {
    success: `<svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>`,
    error:   `<svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="15" y1="9" x2="9" y2="15"/>
                <line x1="9" y1="9" x2="15" y2="15"/>
              </svg>`,
    warning: `<svg viewBox="0 0 24 24">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13.5"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
              </svg>`,
    info:    `<svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="16" x2="12" y2="11"/>
                <line x1="12" y1="8" x2="12.01" y2="8"/>
              </svg>`
  };

  /* ---------------- 3. Build popup DOM dynamically ---------------- */
  function buildPopupDOM() {
    // Overlay
    const overlay = document.createElement('div');
    overlay.className = 'notify-overlay';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');

    // Tilt wrapper
    const tilt = document.createElement('div');
    tilt.className = 'notify-tilt';

    // Card
    const card = document.createElement('div');
    card.className = 'notify-card';
    card.dataset.type = 'info';

    // Icon
    const iconWrap = document.createElement('div');
    iconWrap.className = 'notify-icon-wrap';
    const iconBox = document.createElement('div');
    iconBox.className = 'notify-icon-box';
    iconWrap.appendChild(iconBox);

    // Text
    const title = document.createElement('h3');
    title.className = 'notify-title';
    title.textContent = 'Message';

    const msg = document.createElement('p');
    msg.className = 'notify-msg';

    // Actions
    const actions = document.createElement('div');
    actions.className = 'notify-actions';

    const cancelBtn = document.createElement('button');
    cancelBtn.type = 'button';
    cancelBtn.className = 'notify-cancel';
    cancelBtn.textContent = 'Later';
    cancelBtn.hidden = true;

    const okBtn = document.createElement('button');
    okBtn.type = 'button';
    okBtn.className = 'notify-ok';
    okBtn.textContent = 'Got it';

    actions.appendChild(cancelBtn);
    actions.appendChild(okBtn);

    // Progress
    const progress = document.createElement('div');
    progress.className = 'notify-progress';
    progress.hidden = true;

    // Assemble
    card.appendChild(iconWrap);
    card.appendChild(title);
    card.appendChild(msg);
    card.appendChild(actions);
    card.appendChild(progress);
    tilt.appendChild(card);
    overlay.appendChild(tilt);
    document.body.appendChild(overlay);

    return { overlay, tilt, card, iconWrap, iconBox, titleEl: title, msgEl: msg, okBtn, cancelBtn, bar: progress };
  }

  /* ---------------- 4. Popup controller ---------------- */
  function createPopup() {
    const el = buildPopupDOM();
    const {
      overlay, tilt, card, iconWrap, iconBox,
      titleEl, msgEl, okBtn, cancelBtn, bar
    } = el;

    const CLOSE_MS = 240;
    let autoTimer  = null;
    let closeTimer = null;
    let onConfirm  = null;
    let onCancel   = null;

    function burst(count = 14) {
      iconWrap.querySelectorAll('.notify-particle').forEach(p => p.remove());
      const frag = document.createDocumentFragment();
      for (let i = 0; i < count; i++) {
        const p   = document.createElement('span');
        const ang = (Math.PI * 2 * i) / count + Math.random() * 0.4;
        const dst = 30 + Math.random() * 30;
        p.className = 'notify-particle';
        p.style.setProperty('--dx', `${Math.cos(ang) * dst}px`);
        p.style.setProperty('--dy', `${Math.sin(ang) * dst}px`);
        p.style.animationDelay = `${220 + Math.random() * 120}ms`;
        const color = i % 2 ? 'var(--a1)' : 'var(--a2)';
        p.style.background = color;
        p.style.color = color;
        frag.appendChild(p);
      }
      iconWrap.appendChild(frag);
    }

    function clearParticles() {
      iconWrap.querySelectorAll('.notify-particle').forEach(p => p.remove());
    }

    function show(opts = {}) {
      const {
        type        = 'info',
        heading     = 'Message',
        message     = '',
        autoClose   = 5000,
        confirmText = 'Got it',
        cancelText  = 'Later',
        showCancel  = false,
        onConfirm: onOk = null,
        onCancel:  onNo = null
      } = opts;

      onConfirm = onOk;
      onCancel  = onNo;

      card.dataset.type = type;
      iconBox.innerHTML = ICONS[type] || ICONS.info;
      titleEl.textContent = heading;
      msgEl.textContent   = message;
      okBtn.textContent   = confirmText;
      cancelBtn.textContent = cancelText;
      cancelBtn.hidden    = !showCancel;

      clearTimeout(autoTimer);
      clearTimeout(closeTimer);
      bar.style.animation = 'none';
      void bar.offsetWidth;

      if (autoClose > 0) {
        bar.hidden = false;
        bar.style.animation = `notifyFill ${autoClose}ms linear forwards`;
        autoTimer = setTimeout(close, autoClose);
      } else {
        bar.hidden = true;
      }

      overlay.classList.remove('closing');
      overlay.classList.add('open');

      if (type === 'success') requestAnimationFrame(() => burst(14));
    }

    function close() {
      if (!overlay.classList.contains('open') ||
           overlay.classList.contains('closing')) return;

      clearTimeout(autoTimer);
      overlay.classList.add('closing');
      tilt.style.transform = '';

      closeTimer = setTimeout(() => {
        overlay.classList.remove('open', 'closing');
        clearParticles();
      }, CLOSE_MS);
    }

    /* Events */
    okBtn.addEventListener('click', () => {
      const fn = onConfirm;
      close();
      if (fn) fn();
    });

    cancelBtn.addEventListener('click', () => {
      const fn = onCancel;
      close();
      if (fn) fn();
    });

    overlay.addEventListener('click', e => {
      if (e.target === overlay) close();
    });

    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') close();
    });

    /* 3D tilt (desktop) */
    if (window.matchMedia('(hover:hover) and (pointer:fine)').matches) {
      overlay.addEventListener('mousemove', e => {
        if (!overlay.classList.contains('open')) return;
        const r  = card.getBoundingClientRect();
        const cx = r.left + r.width / 2;
        const cy = r.top  + r.height / 2;
        const rx = ((e.clientY - cy) / r.height) * -7;
        const ry = ((e.clientX - cx) / r.width)  *  7;
        tilt.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
      });
      overlay.addEventListener('mouseleave', () => {
        tilt.style.transform = '';
      });
    }

    return { show, close, el };
  }

  /* ---------------- 5. Singleton popup ---------------- */
  let popup = null;
  function getPopup() {
    if (!popup) popup = createPopup();
    return popup;
  }

  /* ---------------- 6. Public API ---------------- */
  window.Notify = {
    success: (msg, o = {}) => getPopup().show({ type: 'success', heading: o.heading ?? 'Success!',        message: msg, ...o }),
    error:   (msg, o = {}) => getPopup().show({ type: 'error',   heading: o.heading ?? 'Something broke', message: msg, autoClose: 6500, ...o }),
    warning: (msg, o = {}) => getPopup().show({ type: 'warning', heading: o.heading ?? 'Heads up',        message: msg, autoClose: 6000, ...o }),
    info:    (msg, o = {}) => getPopup().show({ type: 'info',    heading: o.heading ?? 'For your info',  message: msg, ...o })
  };

  window.showPopup  = (opts) => getPopup().show(opts);
  window.closePopup = ()    => getPopup().close();
})();