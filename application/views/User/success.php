<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Success · <?php echo title; ?></title>

<style>
  /* ---------- Reset & tokens ---------- */
  *, *::before, *::after { box-sizing: border-box; }

  :root {
    --green-1: #34d399;
    --green-2: #059669;
    --ink:     #0f172a;
    --muted:   #64748b;
    --line:    #e2e8f0;
    --surface: #f8fafc;
  }

  html, body { height: 100%; }

  body {
    margin: 0;
    padding: 24px;
    min-height: 100dvh;
    display: grid;
    place-items: center;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto,
                 Helvetica, Arial, sans-serif;
    color: var(--ink);
    background:
      radial-gradient(900px 520px at 50% -10%, #e6fff5 0%, transparent 62%),
      linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
    -webkit-font-smoothing: antialiased;
  }

  /* ---------- Confetti canvas ---------- */
  #confetti {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 9999;
  }

  /* ---------- Card ---------- */
  .card {
    position: relative;
    width: min(480px, 100%);
    padding: 40px 32px 32px;
    text-align: center;
    background: #fff;
    border: 1px solid rgba(255, 255, 255, .8);
    border-radius: 24px;
    box-shadow:
      0 1px 2px rgba(15, 23, 42, .06),
      0 12px 24px -8px rgba(15, 23, 42, .10),
      0 40px 80px -40px rgba(15, 23, 42, .32);
    animation: cardIn .6s cubic-bezier(.2, .8, .2, 1) both;
  }

  /* ---------- Animated checkmark ---------- */
  .check-wrap {
    position: relative;
    width: 112px;
    height: 112px;
    margin: 0 auto 24px;
    display: grid;
    place-items: center;
  }

  /* pulsing rings behind the badge */
  .ring {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    border: 2px solid rgba(16, 185, 129, .55);
    opacity: 0;
    animation: ripple 2.6s ease-out infinite;
  }
  .ring-2 { animation-delay: 1.3s; }

  .check-circle {
    position: relative;
    z-index: 1;
    width: 92px;
    height: 92px;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: linear-gradient(145deg, var(--green-1), var(--green-2));
    box-shadow:
      0 12px 28px -10px rgba(5, 150, 105, .8),
      inset 0 1px 0 rgba(255, 255, 255, .4);
    animation: pop .55s cubic-bezier(.2, 1.5, .45, 1) both;
  }

  .check-svg { width: 52px; height: 52px; overflow: visible; }

  .check-path {
    fill: none;
    stroke: #fff;
    stroke-width: 5.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 36;
    stroke-dashoffset: 36;
    animation: draw .42s ease-out .38s forwards;
  }

  /* ---------- Copy ---------- */
  h1 {
    margin: 0 0 10px;
    font-size: clamp(1.5rem, 1.2rem + 1.3vw, 1.85rem);
    letter-spacing: -.02em;
  }

  .sub {
    max-width: 34ch;
    margin: 0 auto;
    font-size: .975rem;
    line-height: 1.55;
    color: var(--muted);
  }

  /* ---------- Details ---------- */
  .details {
    margin: 26px 0 22px;
    padding: 4px 16px;
    text-align: left;
    font-size: .875rem;
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: 14px;
    animation: fadeUp .6s ease .45s both;
  }

  .details .row {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 11px 0;
  }
  .details .row + .row { border-top: 1px dashed var(--line); }
  .details .row span   { color: var(--muted); }
  .details .row strong { font-weight: 600; }

  /* ---------- Buttons ---------- */
  .actions {
    display: grid;
    gap: 10px;
    animation: fadeUp .6s ease .55s both;
  }

  .btn {
    width: 100%;
    padding: 13px 18px;
    font: inherit;
    font-size: .95rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: transform .16s ease, box-shadow .16s ease,
                background-color .16s ease, border-color .16s ease;
  }
  .btn:active { transform: translateY(0) scale(.99); }
  .btn:focus-visible { outline: 2px solid var(--green-2); outline-offset: 3px; }

  .btn-primary {
    color: #fff;
    border: 0;
    background: linear-gradient(145deg, var(--green-1), var(--green-2));
    box-shadow: 0 10px 22px -12px rgba(5, 150, 105, 1);
  }
  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 14px 26px -12px rgba(5, 150, 105, 1);
  }

  .btn-ghost {
    color: var(--ink);
    background: #fff;
    border: 1px solid var(--line);
  }
  .btn-ghost:hover { background: var(--surface); border-color: #cbd5e1; }

  /* ---------- Keyframes ---------- */
  @keyframes cardIn {
    from { opacity: 0; transform: translateY(18px) scale(.98); }
    to   { opacity: 1; transform: none; }
  }
  @keyframes pop {
    from { opacity: 0; transform: scale(.3); }
    to   { opacity: 1; transform: scale(1); }
  }
  @keyframes draw { to { stroke-dashoffset: 0; } }
  @keyframes ripple {
    0%   { transform: scale(.68); opacity: .75; }
    70%  { opacity: 0; }
    100% { transform: scale(1.4); opacity: 0; }
  }
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: none; }
  }

  /* ---------- Accessibility ---------- */
  @media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
      animation-duration: .001ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: .001ms !important;
    }
    .check-path { stroke-dashoffset: 0; }
  }
</style>
</head>

<body>
  <canvas id="confetti" aria-hidden="true"></canvas>

  <main class="card" role="status" aria-live="polite">
    <div class="check-wrap">
      <span class="ring"></span>
      <span class="ring ring-2"></span>

      <div class="check-circle">
        <svg class="check-svg" viewBox="0 0 52 52" aria-hidden="true">
          <path class="check-path" d="M14 27l7.5 7.5L38 18" />
        </svg>
      </div>
    </div>

    <h1>Registration Successful!</h1>
    <p class="sub">
      Thanks for your registration.
    </p>

    <div class="details">
      <div class="row"><span>Name</span><strong><?php echo $data['name']; ?></strong></div>
      <div class="row"><span>User ID</span><strong><?php echo $data['user_id'] ?></strong></div>
      <div class="row"><span>Password</span><strong><?php echo $data['password'] ?></strong></div>
      <div class="row"><span>Transaction ID</span><strong >—</strong></div>

    </div>

    <div class="actions">
      <a href="<?php echo base_url('login'); ?>" class="btn btn-primary" id="continueBtn" type="button">
        Login
</a>
   
    </div>
  </main>

<script>
(function () {
  "use strict";

  /* ============ Confetti engine ============ */
  const canvas = document.getElementById("confetti");
  const ctx = canvas.getContext("2d");
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const COLORS = [
    "#34d399", "#10b981", "#059669", "#60a5fa",
    "#fbbf24", "#f472b6", "#a78bfa", "#38bdf8"
  ];

  let W = 0, H = 0, dpr = 1;
  const particles = [];
  let running = false;

  function resize() {
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    W = window.innerWidth;
    H = window.innerHeight;
    canvas.width  = Math.floor(W * dpr);
    canvas.height = Math.floor(H * dpr);
    canvas.style.width  = W + "px";
    canvas.style.height = H + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  const rand = (min, max) => Math.random() * (max - min) + min;

  /** Launch a burst of confetti from (x, y) in viewport coordinates. */
  function burst(x, y, count = 110) {
    if (reduceMotion) return;

    for (let i = 0; i < count; i++) {
      const angle = rand(0, Math.PI * 2);
      const speed = rand(3, 12);

      particles.push({
        x, y,
        vx: Math.cos(angle) * speed,
        vy: Math.sin(angle) * speed - rand(2, 6),  // bias upward
        w: rand(6, 12),
        h: rand(6, 12),
        color: COLORS[(Math.random() * COLORS.length) | 0],
        rot: rand(0, Math.PI * 2),
        vrot: rand(-0.25, 0.25),
        alpha: 1,
        decay: rand(0.006, 0.014),
        round: Math.random() < 0.25
      });
    }
    start();
  }

  function start() {
    if (!running) {
      running = true;
      requestAnimationFrame(frame);
    }
  }

  function frame() {
    ctx.clearRect(0, 0, W, H);

    for (let i = particles.length - 1; i >= 0; i--) {
      const p = particles[i];

      p.vy += 0.22;      // gravity
      p.vx *= 0.99;      // air drag
      p.vy *= 0.99;
      p.x  += p.vx;
      p.y  += p.vy;
      p.rot += p.vrot;
      p.alpha -= p.decay;

      // Retire off-screen / faded particles
      if (p.alpha <= 0 || p.y - 60 > H) {
        particles.splice(i, 1);
        continue;
      }

      ctx.save();
      ctx.globalAlpha = Math.max(p.alpha, 0);
      ctx.translate(p.x, p.y);
      ctx.rotate(p.rot);
      ctx.fillStyle = p.color;

      if (p.round) {
        ctx.beginPath();
        ctx.arc(0, 0, p.w / 2, 0, Math.PI * 2);
        ctx.fill();
      } else {
        ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
      }

      ctx.restore();
    }

    if (particles.length) {
      requestAnimationFrame(frame);
    } else {
      running = false;
      ctx.clearRect(0, 0, W, H);
    }
  }

  window.addEventListener("resize", resize);
  resize();

  /* ============ Fire confetti from the checkmark ============ */
  function burstFromCheckmark(count) {
    const el = document.querySelector(".check-circle");
    const r  = el.getBoundingClientRect();
    burst(r.left + r.width / 2, r.top + r.height / 2, count);
  }

  // Wait for the checkmark to finish drawing, then celebrate.
  setTimeout(() => burstFromCheckmark(110), 500);

  /* ============ UI wiring ============ */
  // Fill in today's date
  document.getElementById("paidDate").textContent =
    new Date().toLocaleDateString(undefined, {
      year: "numeric", month: "short", day: "numeric"
    });

  // Replay the celebration
  document.getElementById("againBtn").addEventListener("click", () => {
    burstFromCheckmark(90);
  });

  // Primary action — swap this for your real navigation.
  document.getElementById("continueBtn").addEventListener("click", () => {
    burstFromCheckmark(70);
    // e.g. window.location.href = "/dashboard";
  });
})();
</script>
</body>
</html>