<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            * { box-sizing: border-box; }
            body {
                margin: 0;
                min-height: 100vh;
                color: #2f241c;
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif;
                background: #fbf7f1;
            }
            .guest-page {
                position: relative;
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 2rem 1rem;
                overflow: hidden;
                background:
                    radial-gradient(circle at 18% 18%, rgba(238, 168, 86, .22) 0 160px, transparent 161px),
                    radial-gradient(circle at 88% 82%, rgba(83, 47, 24, .12) 0 190px, transparent 191px),
                    linear-gradient(135deg, #fffdf9 0%, #fbf1e5 52%, #f8efe5 100%);
            }
            .guest-page::before,
            .guest-page::after {
                content: "";
                position: absolute;
                pointer-events: none;
                border-radius: 999px;
                filter: blur(.2px);
            }
            .guest-page::before {
                width: 16rem;
                height: 16rem;
                left: -5rem;
                bottom: -4rem;
                background: rgba(109, 62, 31, .08);
            }
            .guest-page::after {
                width: 12rem;
                height: 12rem;
                right: -3rem;
                top: -3rem;
                background: rgba(232, 153, 74, .18);
            }
            .guest-card {
                position: relative;
                z-index: 1;
                width: min(100%, 27.5rem);
                padding: 2.25rem;
                background: rgba(255, 255, 255, .88);
                border: 1px solid rgba(126, 86, 56, .14);
                border-radius: 1.25rem;
                box-shadow: 0 24px 70px rgba(87, 58, 35, .18);
                backdrop-filter: blur(16px);
            }
            .auth-brand {
                display: grid;
                justify-items: center;
                gap: .55rem;
                margin-bottom: 1.55rem;
                text-align: center;
            }
            .auth-mark {
                display: grid;
                place-items: center;
                width: 3.15rem;
                height: 3.15rem;
                border-radius: 1rem;
                color: #5b2e14;
                background: linear-gradient(135deg, #fff2df, #f4b46e);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.7), 0 10px 24px rgba(129, 73, 30, .18);
                font-size: 1.45rem;
                font-weight: 900;
            }
            .auth-title {
                margin: 0;
                color: #3b2111;
                font-size: 1.35rem;
                font-weight: 900;
                line-height: 1.05;
            }
            .auth-title span { color: #d98238; }
            .auth-subtitle {
                margin: .25rem 0 0;
                color: #8b7a6e;
                font-size: .82rem;
                font-weight: 500;
            }
            .auth-alert {
                margin-bottom: 1rem;
                padding: .85rem .95rem;
                border: 1px solid #fecaca;
                border-radius: .75rem;
                background: #fff1f2;
                color: #991b1b;
                font-size: .85rem;
                font-weight: 600;
            }
            .auth-field { margin-top: 1rem; }
            .auth-card label,
            .guest-card label {
                display: block;
                margin-bottom: .45rem;
                color: #412514;
                font-size: .82rem;
                font-weight: 800;
            }
            .guest-card input[type="email"],
            .guest-card input[type="password"] {
                display: block;
                width: 100%;
                min-height: 3.15rem;
                padding: .85rem 1rem;
                border: 1px solid #eaded3;
                border-radius: .8rem;
                background: #fffdfa;
                color: #2f241c;
                font: inherit;
                font-size: .94rem;
                box-shadow: 0 1px 0 rgba(255,255,255,.8);
                transition: border-color .16s ease, box-shadow .16s ease, background .16s ease;
            }
            .guest-card input::placeholder { color: #9f9186; }
            .guest-card input:focus {
                outline: none;
                border-color: #d88943;
                background: #fff;
                box-shadow: 0 0 0 4px rgba(216, 137, 67, .16);
            }
            .auth-link-row {
                display: flex;
                justify-content: flex-end;
                margin-top: .65rem;
            }
            .auth-link {
                color: #7b3d18;
                font-size: .82rem;
                font-weight: 800;
                text-decoration: none;
            }
            .auth-link:hover { color: #c7712d; }
            .auth-button {
                width: 100%;
                min-height: 3rem;
                margin-top: 1.15rem;
                border: 0;
                border-radius: .85rem;
                background: linear-gradient(135deg, #5c2e14, #3f210f);
                color: #fff;
                cursor: pointer;
                font: inherit;
                font-size: .9rem;
                font-weight: 900;
                box-shadow: 0 12px 24px rgba(82, 42, 18, .22);
                transition: transform .16s ease, box-shadow .16s ease, filter .16s ease;
            }
            .auth-button:hover {
                transform: translateY(-1px);
                filter: brightness(1.04);
                box-shadow: 0 15px 28px rgba(82, 42, 18, .27);
            }
            .auth-note {
                margin: 1rem 0 0;
                color: #8f8177;
                text-align: center;
                font-size: .78rem;
                line-height: 1.5;
            }
            .auth-divider {
                display: flex;
                align-items: center;
                gap: .8rem;
                margin: 1.35rem 0 1rem;
                color: #b2a59b;
                font-size: .72rem;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
            }
            .auth-divider::before,
            .auth-divider::after {
                content: "";
                height: 1px;
                flex: 1;
                background: #efe5dc;
            }
            .google-button {
                display: inline-flex;
                width: 100%;
                min-height: 3rem;
                align-items: center;
                justify-content: center;
                gap: .65rem;
                border: 1px solid #eaded3;
                border-radius: .85rem;
                background: #fff;
                color: #3c3027;
                cursor: pointer;
                font: inherit;
                font-size: .86rem;
                font-weight: 900;
                transition: border-color .16s ease, background .16s ease, transform .16s ease;
            }
            .google-button:hover {
                border-color: #d9c9ba;
                background: #fffaf4;
                transform: translateY(-1px);
            }
            .google-icon {
                display: grid;
                place-items: center;
                width: 1.35rem;
                height: 1.35rem;
                border: 1px solid #eee5dd;
                border-radius: 999px;
                color: #4285f4;
                font-weight: 900;
            }
            .guest-card .text-red-600 {
                color: #b42318;
                font-size: .78rem;
                font-weight: 700;
            }
            @media (max-width: 480px) {
                .guest-page { padding: 1rem; }
                .guest-card {
                    width: 100%;
                    padding: 1.5rem;
                    border-radius: 1rem;
                }
                .auth-title { font-size: 1.2rem; }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="guest-page">
            <div class="guest-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
