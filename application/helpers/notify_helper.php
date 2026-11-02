<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Notify Popup
|--------------------------------------------------------------------------
*/

if (!function_exists('notify_popup')) {

    function notify_popup(
        $type = 'info',
        $message = '',
        $heading = null,
        $options = []
    ) {

        $defaults = [
            'autoClose'   => 5000,
            'confirmText' => 'Got it',
            'cancelText'  => 'Later',
            'showCancel'  => false,
        ];

        $options = array_merge($defaults, $options);

        $headingDefaults = [
            'success' => 'Success!',
            'error'   => 'Something broke',
            'warning' => 'Heads up',
            'info'    => 'For your info',
        ];

        if ($heading === null) {
            $heading = $headingDefaults[$type] ?? 'Message';
        }

        $notify = [
            'type'        => $type,
            'heading'     => $heading,
            'message'     => $message,
            'autoClose'   => $options['autoClose'],
            'confirmText' => $options['confirmText'],
            'cancelText'  => $options['cancelText'],
            'showCancel'  => $options['showCancel'],
        ];

        /*
        |--------------------------------------------------------------------------
        | Normal Request
        |--------------------------------------------------------------------------
        */

        $CI =& get_instance();

        $CI->session->set_flashdata(
            'notify_popup',
            $notify
        );

        /*
        |--------------------------------------------------------------------------
        | AJAX Request ke liye HTML return
        |--------------------------------------------------------------------------
        */

        return notify_popup_html($notify);
    }
}



if (!function_exists('notify_popup_html')) {

    function notify_popup_html($notify)
    {
        ob_start();
        ?>

        <div id="notifyOverlay" class="notify-overlay">

            <div class="notify-tilt" id="notifyTilt">

                <div
                    class="notify-card"
                    id="notifyCard"
                    data-type="<?= html_escape($notify['type']); ?>"
                >

                    <div class="notify-aurora">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="notify-shine"></div>

                    <div class="notify-content">

                        <div class="notify-icon-wrap">

                            <div
                                class="notify-icon"
                                id="notifyIcon"
                            ></div>

                        </div>

                        <h2 class="notify-title">
                            <?= html_escape($notify['heading']); ?>
                        </h2>

                        <p class="notify-msg">
                            <?= html_escape($notify['message']); ?>
                        </p>

                        <div class="notify-actions">

                            <?php if ($notify['showCancel']): ?>

                                <button
                                    type="button"
                                    class="notify-btn notify-ghost"
                                    onclick="closeNotify()"
                                >
                                    <?= html_escape($notify['cancelText']); ?>
                                </button>

                            <?php endif; ?>

                            <button
                                type="button"
                                class="notify-btn notify-primary"
                                onclick="closeNotify()"
                            >
                                <?= html_escape($notify['confirmText']); ?>
                            </button>

                        </div>

                    </div>

                    <span
                        class="notify-progress"
                        id="notifyProgress"
                    ></span>

                </div>

            </div>

        </div>

        <?php

        return ob_get_clean();
    }
}

/*
|--------------------------------------------------------------------------
| Success
|--------------------------------------------------------------------------
*/

if (!function_exists('notify_success')) {

    function notify_success($message, $heading = 'Success!', $options = [])
    {
       return notify_popup(
            'success',
            $message,
            $heading,
            $options
        );
    }
}


/*
|--------------------------------------------------------------------------
| Error
|--------------------------------------------------------------------------
*/

if (!function_exists('notify_error')) {

    function notify_error($message, $heading = 'Something broke', $options = [])
    {
       return notify_popup(
            'error',
            $message,
            $heading,
            $options
        );
    }
}


/*
|--------------------------------------------------------------------------
| Warning
|--------------------------------------------------------------------------
*/

if (!function_exists('notify_warning')) {

    function notify_warning($message, $heading = 'Heads up', $options = [])
    {
      return  notify_popup(
            'warning',
            $message,
            $heading,
            $options
        );
    }
}


/*
|--------------------------------------------------------------------------
| Info
|--------------------------------------------------------------------------
*/

if (!function_exists('notify_info')) {

    function notify_info($message, $heading = 'For your info', $options = [])
    {
       return notify_popup(
            'info',
            $message,
            $heading,
            $options
        );
    }
}


/*
|--------------------------------------------------------------------------
| Render Popup
|--------------------------------------------------------------------------
|
| Is function ko common footer/view mein ek baar call karein.
|
*/

if (!function_exists('notify_render')) {

    function notify_render()
    {
        $CI =& get_instance();

        $notify = $CI->session->flashdata('notify_popup');

        if (empty($notify)) {
            return;
        }

        ?>
        
        <div id="notifyOverlay" class="notify-overlay">

            <div class="notify-tilt" id="notifyTilt">

                <div
                    class="notify-card"
                    id="notifyCard"
                    data-type="<?= html_escape($notify['type']); ?>"
                    role="alertdialog"
                    aria-modal="true"
                >

                    <div class="notify-aurora">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="notify-shine"></div>

                    <div class="notify-content">

                        <div class="notify-icon-wrap" id="notifyIconWrap">

                            <div
                                class="notify-icon"
                                id="notifyIcon"
                            ></div>

                        </div>

                        <h2
                            class="notify-title"
                            id="notifyTitle"
                        >
                            <?= html_escape($notify['heading']); ?>
                        </h2>

                        <p
                            class="notify-msg"
                            id="notifyMessage"
                        >
                            <?= html_escape($notify['message']); ?>
                        </p>

                        <div class="notify-actions">

                            <?php if ($notify['showCancel']): ?>

                                <button
                                    type="button"
                                    class="notify-btn notify-ghost"
                                    id="notifyCancel"
                                >
                                    <?= html_escape($notify['cancelText']); ?>
                                </button>

                            <?php endif; ?>

                            <button
                                type="button"
                                class="notify-btn notify-primary"
                                id="notifyOk"
                            >
                                <?= html_escape($notify['confirmText']); ?>
                            </button>

                        </div>

                    </div>

                    <span
                        class="notify-progress"
                        id="notifyProgress"
                    ></span>

                </div>

            </div>

        </div>


        <style>

        .notify-overlay{
            position:fixed;
            inset:0;
            z-index:99999;
            display:grid;
            place-items:center;
            background:rgba(5,5,14,.6);
            backdrop-filter:blur(14px) saturate(150%);
            -webkit-backdrop-filter:blur(14px) saturate(150%);
            opacity:0;
            pointer-events:none;
            transition:opacity .4s ease;
        }

        .notify-overlay.open{
            opacity:1;
            pointer-events:auto;
        }

        .notify-overlay.closing{
            opacity:0;
        }

        .notify-tilt{
            perspective:1300px;
            transform-style:preserve-3d;
            transition:transform .2s ease-out;
        }

        .notify-card{

            --a1:#7c5cff;
            --a2:#00e0ff;
            --a3:#ff4ecd;

            position:relative;

            width:min(440px,92vw);

            padding:30px 30px 24px;

            border-radius:24px;

            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,.10),
                    rgba(255,255,255,.028)
                );

            border:1px solid rgba(255,255,255,.13);

            box-shadow:
                0 40px 100px -24px rgba(0,0,0,.9),
                0 0 0 1px rgba(255,255,255,.03),
                inset 0 1px 0 rgba(255,255,255,.16);

            overflow:hidden;

            transform:translateY(44px) scale(.88);

            opacity:0;

            transition:
                transform .6s cubic-bezier(.16,1.15,.3,1),
                opacity .38s ease;
        }

        .notify-overlay.open .notify-card{
            transform:translateY(0) scale(1);
            opacity:1;
        }

        .notify-overlay.closing .notify-card{
            transform:translateY(16px) scale(.94);
            opacity:0;
            transition-duration:.22s;
        }

        .notify-card[data-type="success"]{
            --a1:#0fc98e;
            --a2:#5cffc4;
            --a3:#00c2ff;
        }

        .notify-card[data-type="error"]{
            --a1:#ff3d63;
            --a2:#ff8a5b;
            --a3:#ff2e9a;
        }

        .notify-card[data-type="warning"]{
            --a1:#ffa722;
            --a2:#ffd76a;
            --a3:#ff7a45;
        }

        .notify-card[data-type="info"]{
            --a1:#4a8dff;
            --a2:#7ce7ff;
            --a3:#9b7bff;
        }

        .notify-card::before{
            content:"";
            position:absolute;
            inset:-1px;
            z-index:3;
            border-radius:inherit;
            padding:1.4px;

            background:
                conic-gradient(
                    from var(--ang,0deg),
                    var(--a1),
                    var(--a2),
                    var(--a3),
                    var(--a1)
                );

            -webkit-mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);

            -webkit-mask-composite:xor;
            mask-composite:exclude;

            animation:notifySpin 7s linear infinite;

            opacity:.85;

            pointer-events:none;
        }

        @property --ang{
            syntax:"<angle>";
            initial-value:0deg;
            inherits:false;
        }

        @keyframes notifySpin{
            to{
                --ang:360deg;
            }
        }

        .notify-card::after{
            content:"";
            position:absolute;
            inset:0;
            z-index:2;
            border-radius:inherit;
            box-shadow:inset 0 0 60px -20px var(--a1);
            pointer-events:none;
        }

        .notify-aurora{
            position:absolute;
            inset:0;
            z-index:0;
            overflow:hidden;
            border-radius:inherit;
        }

        .notify-aurora span{
            position:absolute;
            border-radius:50%;
            filter:blur(46px);
            opacity:.55;
        }

        .notify-aurora span:nth-child(1){
            width:260px;
            height:260px;
            top:-120px;
            right:-80px;
            background:var(--a1);
            animation:notifyFloat1 9s ease-in-out infinite alternate;
        }

        .notify-aurora span:nth-child(2){
            width:220px;
            height:220px;
            bottom:-130px;
            left:-70px;
            background:var(--a2);
            opacity:.4;
            animation:notifyFloat2 11s ease-in-out infinite alternate;
        }

        .notify-aurora span:nth-child(3){
            width:180px;
            height:180px;
            top:40%;
            left:55%;
            background:var(--a3);
            opacity:.28;
            animation:notifyFloat3 13s ease-in-out infinite alternate;
        }

        @keyframes notifyFloat1{
            to{
                transform:translate3d(-40px,30px,0) scale(1.15);
            }
        }

        @keyframes notifyFloat2{
            to{
                transform:translate3d(40px,-24px,0) scale(1.2);
            }
        }

        @keyframes notifyFloat3{
            to{
                transform:translate3d(-30px,-36px,0) scale(1.1);
            }
        }

        .notify-shine{
            position:absolute;
            inset:0;
            z-index:2;

            background:
                linear-gradient(
                    115deg,
                    transparent 32%,
                    rgba(255,255,255,.10) 44%,
                    rgba(255,255,255,.30) 50%,
                    rgba(255,255,255,.10) 56%,
                    transparent 68%
                );

            transform:translateX(-130%);

            pointer-events:none;
        }

        .notify-overlay.open .notify-shine{
            animation:
                notifySweep
                1.15s
                .12s
                cubic-bezier(.3,.7,.25,1)
                forwards;
        }

        @keyframes notifySweep{
            to{
                transform:translateX(130%);
            }
        }

        .notify-content{
            position:relative;
            z-index:4;
        }

        .notify-icon-wrap{
            position:relative;
            width:64px;
            height:64px;
            margin-bottom:18px;
        }

        .notify-icon{
            position:relative;
            width:64px;
            height:64px;

            display:grid;
            place-items:center;

            border-radius:20px;

            background:
                linear-gradient(
                    145deg,
                    var(--a1),
                    var(--a2)
                );

            border:1px solid rgba(255,255,255,.30);

            box-shadow:
                0 16px 34px -14px var(--a1),
                inset 0 1.5px 0 rgba(255,255,255,.45);

        }

        .notify-icon svg{
            width:32px;
            height:32px;
        }

        .notify-icon svg path,
        .notify-icon svg line,
        .notify-icon svg polyline,
        .notify-icon svg circle{

            stroke:#07111c;
            stroke-width:2.7;

            stroke-linecap:round;
            stroke-linejoin:round;

            fill:none;

            stroke-dasharray:90;
            stroke-dashoffset:90;
        }

        .notify-overlay.open .notify-icon svg path,
        .notify-overlay.open .notify-icon svg line,
        .notify-overlay.open .notify-icon svg polyline,
        .notify-overlay.open .notify-icon svg circle{

            animation:
                notifyDraw
                .75s
                cubic-bezier(.5,0,.2,1)
                forwards;
        }

        @keyframes notifyDraw{
            to{
                stroke-dashoffset:0;
            }
        }

        .notify-title{

            margin:0 0 8px;

            font-size:21px;

            font-weight:800;

            letter-spacing:-.2px;

            line-height:1.25;

            color:#fff;
        }

        .notify-msg{

            margin:0 0 24px;

            font-size:14.5px;

            line-height:1.62;

            color:#9aa3c7;
        }

        .notify-actions{

            display:flex;

            gap:11px;

            justify-content:flex-end;
        }

        .notify-btn{

            position:relative;
            overflow:hidden;

            padding:12px 22px;

            font:600 13.5px/1 system-ui,sans-serif;

            border-radius:13px;

            cursor:pointer;
        }

        .notify-ghost{

            background:rgba(255,255,255,.04);

            color:#9aa3c7;

            border:1px solid rgba(255,255,255,.14);
        }

        .notify-primary{

            color:#06101a;

            border:0;

            background:
                linear-gradient(
                    135deg,
                    var(--a2),
                    var(--a1)
                );

            box-shadow:
                0 14px 30px -14px var(--a1);
        }

        .notify-progress{

            position:absolute;

            left:0;
            bottom:0;

            z-index:5;

            height:3px;

            width:100%;

            background:
                linear-gradient(
                    90deg,
                    var(--a1),
                    var(--a2),
                    var(--a3)
                );

            transform-origin:left;

            transform:scaleX(1);
        }

        @keyframes notifyFill{

            from{
                transform:scaleX(1);
            }

            to{
                transform:scaleX(0);
            }

        }

        </style>


        <script>

        const NOTIFY_ICONS = {

            success: `
                <svg viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            `,

            error: `
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            `,

            warning: `
                <svg viewBox="0 0 24 24">
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13.5"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            `,

            info: `
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="11"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
            `
        };


        const notifyOverlay = document.getElementById('notifyOverlay');

        const notifyCard =
            document.getElementById('notifyCard');

        const notifyTilt =
            document.getElementById('notifyTilt');

        const notifyIcon =
            document.getElementById('notifyIcon');

        const notifyProgress =
            document.getElementById('notifyProgress');

        const notifyOk =
            document.getElementById('notifyOk');

        const notifyCancel =
            document.getElementById('notifyCancel');


        const notifyType =
            notifyCard.dataset.type;


        notifyIcon.innerHTML =
            NOTIFY_ICONS[notifyType] ||
            NOTIFY_ICONS.info;


        /*
        |--------------------------------------------------------------------------
        | Open
        |--------------------------------------------------------------------------
        */

        setTimeout(function(){

            notifyOverlay.classList.add('open');

        }, 50);


        /*
        |--------------------------------------------------------------------------
        | Progress
        |--------------------------------------------------------------------------
        */

        const notifyAutoClose =
            <?= (int)$notify['autoClose']; ?>;


        if(notifyAutoClose){

            notifyProgress.style.animation =
                'notifyFill ' +
                notifyAutoClose +
                'ms linear forwards';

            setTimeout(
                closeNotify,
                notifyAutoClose
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Close
        |--------------------------------------------------------------------------
        */

        function closeNotify(){

            if(
                !notifyOverlay.classList.contains('open') ||
                notifyOverlay.classList.contains('closing')
            ){
                return;
            }

            notifyOverlay.classList.add('closing');

            setTimeout(function(){

                notifyOverlay.classList.remove(
                    'open',
                    'closing'
                );

            },240);

        }


        /*
        |--------------------------------------------------------------------------
        | OK
        |--------------------------------------------------------------------------
        */

        notifyOk.addEventListener(
            'click',
            closeNotify
        );


        /*
        |--------------------------------------------------------------------------
        | Cancel
        |--------------------------------------------------------------------------
        */

        if(notifyCancel){

            notifyCancel.addEventListener(
                'click',
                closeNotify
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Overlay click
        |--------------------------------------------------------------------------
        */

        notifyOverlay.addEventListener(
            'click',
            function(e){

                if(e.target === notifyOverlay){

                    closeNotify();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESC
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function(e){

                if(e.key === 'Escape'){

                    closeNotify();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | 3D Tilt
        |--------------------------------------------------------------------------
        */

        if(
            window.matchMedia(
                '(hover:hover) and (pointer:fine)'
            ).matches
        ){

            notifyOverlay.addEventListener(
                'mousemove',
                function(e){

                    if(
                        !notifyOverlay.classList.contains('open')
                    ){
                        return;
                    }

                    const r =
                        notifyCard.getBoundingClientRect();

                    const cx =
                        r.left + r.width / 2;

                    const cy =
                        r.top + r.height / 2;

                    const rx =
                        ((e.clientY - cy) / r.height) * -7;

                    const ry =
                        ((e.clientX - cx) / r.width) * 7;

                    notifyTilt.style.transform =
                        `rotateX(${rx}deg) rotateY(${ry}deg)`;

                }
            );

            notifyOverlay.addEventListener(
                'mouseleave',
                function(){

                    notifyTilt.style.transform = '';

                }
            );

        }

        </script>

        <?php
    }
}
