<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Floure Bakery' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #24211f;
            --muted: #6f6a64;
            --paper: #fffaf3;
            --surface: #ffffff;
            --line: #eadfce;
            --gold: #e89a4c;
            --green: #633116;
            --rose: #9a6b45;
            --primary-dark: #3f210f;
            --primary-soft: #fff3df;
            --charcoal: #2f3430;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font-family: 'DM Sans', system-ui, sans-serif;
            overflow-x: hidden;
        }

        img { display: block; max-width: 100%; }
        a { color: inherit; text-decoration: none; }
        .container { width: min(1160px, calc(100% - 40px)); margin: 0 auto; }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 20;
            border-bottom: 1px solid rgba(234, 223, 206, .8);
            background: rgba(255, 250, 243, .9);
            backdrop-filter: blur(18px);
        }

        nav {
            min-height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: 800;
            white-space: nowrap;
            flex: 0 0 auto;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #fff;
            background: linear-gradient(135deg, #fff1d7, #e89a4c);
            color: #4b260f;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8), 0 12px 24px rgba(142, 76, 30, .16);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 26px;
            color: #514c47;
            font-size: 14px;
            font-weight: 700;
            flex: 0 1 auto;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--rose); }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 14px;
            font-weight: 700;
            flex: 0 0 auto;
        }

        .staff-login {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 11px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fffdf9;
            color: #633116;
            white-space: nowrap;
        }

        .staff-login small {
            color: #9a6b45;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .staff-login .short-label { display: none; }

        button {
            font: inherit;
            color: inherit;
        }

        .btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            transition: .2s ease;
            border: 0;
            cursor: pointer;
        }

        .btn-primary {
            color: #fff8ed;
            background: linear-gradient(135deg, #6a3517, #3f210f);
            box-shadow: 0 14px 28px rgba(82, 42, 18, .18);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #7a3e1b, #4b260f);
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(82, 42, 18, .24);
        }
        .btn-light { border: 1px solid var(--line); background: var(--surface); }
        .btn-light:hover { border-color: #d8b996; color: #633116; background: #fff8ed; }

        .hero {
            min-height: calc(100vh - 74px);
            display: grid;
            align-items: center;
            padding: 44px 0 34px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(360px, 1.08fr);
            gap: 48px;
            align-items: center;
        }

        .eyebrow {
            color: var(--rose);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        h1, h2, h3 { margin: 0; }
        h1, h2 { font-family: 'Playfair Display', Georgia, serif; }
        h1 {
            max-width: 720px;
            margin-top: 14px;
            font-size: clamp(46px, 6vw, 76px);
            line-height: .98;
        }

        h2 {
            font-size: clamp(34px, 4vw, 50px);
            line-height: 1.05;
        }

        .lead,
        .copy {
            color: var(--muted);
            line-height: 1.75;
        }

        .lead {
            max-width: 590px;
            margin: 24px 0 0;
            font-size: 18px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 30px;
        }

        .hero-note {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 34px;
            max-width: 560px;
        }

        .hero-note span {
            padding: 14px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fffdf9;
            font-size: 13px;
            font-weight: 800;
            color: #4b260f;
        }

        .hero-media {
            position: relative;
            min-height: 560px;
        }

        .hero-media img {
            width: 100%;
            height: 560px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 30px 70px rgba(70, 56, 40, .2);
        }

        .floating-panel {
            position: absolute;
            right: 24px;
            bottom: 24px;
            width: min(310px, calc(100% - 48px));
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, .65);
            border-radius: 8px;
            background: rgba(255, 250, 243, .92);
            box-shadow: 0 20px 45px rgba(36, 33, 31, .16);
        }

        .floating-panel b { display: block; font-size: 18px; }
        .floating-panel p { margin: 8px 0 0; color: var(--muted); line-height: 1.55; }

        .section { padding: 82px 0; }
        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 28px;
            margin-bottom: 30px;
        }

        .section-heading p { max-width: 460px; margin: 0; }
        .products { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }

        .product {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--surface);
            transition: .2s ease;
        }

        .product:hover {
            border-color: rgba(133, 91, 58, .28);
            box-shadow: 0 18px 38px rgba(70, 56, 40, .12);
            transform: translateY(-2px);
        }

        .product-img {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            background: #eee1d0;
        }

        div.product-img {
            display: grid;
            place-items: center;
            font-size: 72px;
        }

        .product-body { padding: 16px; }
        .product h3 { font-size: 17px; }
        .product small { display: block; margin-top: 6px; color: var(--muted); line-height: 1.5; }
        .product footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 14px;
            color: var(--green);
            font-weight: 800;
        }

        .product-detail-trigger {
            width: 100%;
            padding: 0;
            border: 0;
            background: transparent;
            text-align: left;
            cursor: pointer;
        }

        .product-add {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(133, 91, 58, .18);
            border-radius: 8px;
            background: #fff8ed;
            color: #633116;
            font-size: 20px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .product-add:hover {
            color: #fff8ed;
            background: linear-gradient(135deg, #6a3517, #3f210f);
        }

        .shop-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .cart-button {
            position: relative;
        }

        .cart-count {
            min-width: 22px;
            height: 22px;
            display: grid;
            place-items: center;
            padding: 0 6px;
            border-radius: 999px;
            color: #4b260f;
            background: linear-gradient(135deg, #fff1d7, #e89a4c);
            font-size: 12px;
            font-weight: 950;
            line-height: 1;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 40;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 22px;
            background: rgba(36, 33, 31, .48);
        }

        .modal-backdrop.is-open { display: flex; }

        .product-modal,
        .cart-drawer {
            width: min(920px, 100%);
            max-height: min(760px, calc(100vh - 44px));
            overflow: auto;
            border-radius: 8px;
            background: var(--surface);
            box-shadow: 0 30px 80px rgba(36, 33, 31, .28);
        }

        .product-modal-grid {
            display: grid;
            grid-template-columns: .95fr 1.05fr;
        }

        .product-modal-img {
            width: 100%;
            height: 100%;
            min-height: 430px;
            object-fit: cover;
            background: #eee1d0;
        }

        .modal-body {
            padding: 28px;
        }

        .modal-top {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .close-button {
            width: 38px;
            height: 38px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            font-size: 22px;
            line-height: 1;
        }

        .detail-price {
            margin: 14px 0;
            color: #633116;
            font-size: 26px;
            font-weight: 800;
        }

        .detail-list {
            display: grid;
            gap: 10px;
            margin: 22px 0;
            padding: 0;
            list-style: none;
            color: var(--muted);
        }

        .detail-list li {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1e8dc;
        }

        .detail-list b { color: var(--ink); }

        .cart-drawer {
            width: min(520px, 100%);
            margin-left: auto;
            border-radius: 8px 0 0 8px;
        }

        .cart-backdrop {
            align-items: stretch;
            justify-content: flex-end;
            padding: 0;
        }

        .cart-items {
            display: grid;
            gap: 14px;
            margin: 20px 0;
        }

        .cart-empty {
            padding: 22px;
            border: 1px dashed var(--line);
            border-radius: 8px;
            color: var(--muted);
            text-align: center;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 74px 1fr;
            gap: 12px;
            padding: 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
        }

        .cart-item img {
            width: 74px;
            height: 74px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item h3 { font-size: 16px; }
        .cart-item small { color: var(--muted); }

        .cart-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 10px;
        }

        .qty-controls {
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow: hidden;
        }

        .qty-controls button {
            width: 32px;
            height: 32px;
            border: 0;
            background: #fff8ef;
            color: #633116;
            cursor: pointer;
            font-weight: 800;
        }

        .qty-controls button:hover {
            background: #f6d1a3;
        }

        .qty-controls span {
            min-width: 34px;
            text-align: center;
            font-weight: 800;
        }

        .cart-summary {
            display: grid;
            gap: 10px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
        }

        .cart-summary div {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .cart-summary .total {
            color: #633116;
            font-size: 20px;
            font-weight: 800;
        }

        .checkout-form {
            display: grid;
            gap: 14px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field {
            display: grid;
            gap: 7px;
        }

        .field label {
            color: var(--ink);
            font-size: 13px;
            font-weight: 800;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            min-height: 44px;
            padding: 11px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            font: inherit;
        }

        .field textarea {
            min-height: 96px;
            resize: vertical;
        }

        .checkout-review {
            display: grid;
            gap: 10px;
            padding: 16px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fffaf3;
        }

        .checkout-review-item,
        .checkout-review-total {
            display: flex;
            justify-content: space-between;
            gap: 18px;
        }

        .checkout-review-item {
            color: var(--muted);
            font-size: 14px;
        }

        .checkout-review-total {
            padding-top: 10px;
            border-top: 1px solid var(--line);
            color: #633116;
            font-weight: 800;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 54px;
            align-items: center;
        }

        .feature-img {
            width: 100%;
            height: 430px;
            object-fit: cover;
            border-radius: 8px;
        }

        .page-visual {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 24px 55px rgba(70, 56, 40, .16);
        }

        .contact-hero {
            display: grid;
            grid-template-columns: 1fr .92fr;
            gap: 42px;
            align-items: center;
        }

        .illustration {
            min-height: 360px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #efe1d0;
            font-size: 130px;
        }

        .info-card,
        .contact-card {
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--surface);
        }

        .info-card h3,
        .contact-card h3 { margin-bottom: 8px; font-size: 19px; }

        .page-head {
            padding: 78px 0 52px;
            text-align: center;
            background: #f6ecdf;
        }

        .page-head h1 {
            margin-left: auto;
            margin-right: auto;
            font-size: clamp(40px, 5vw, 62px);
        }

        .page-head p {
            max-width: 640px;
            margin: 18px auto 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .contact-card b { font-size: 24px; }
        .site-footer {
            padding: 30px 0;
            border-top: 1px solid var(--line);
            color: #6f6a64;
            font-size: 13px;
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        @media (max-width: 1040px) {
            .nav-links { gap: 16px; font-size: 13px; }
            .staff-login { padding-inline: 10px; }
            .staff-login .full-label { display: none; }
            .staff-login .short-label { display: inline; }
        }

        @media (max-width: 920px) {
            .hero-grid,
            .two-col { grid-template-columns: 1fr; }
            .hero-media { min-height: auto; }
            .hero-media img { height: min(68vw, 520px); }
            .products { grid-template-columns: repeat(2, 1fr); }
            .section-heading { align-items: start; flex-direction: column; }
            .product-modal-grid { grid-template-columns: 1fr; }
            .product-modal-img { min-height: 280px; height: 320px; }
            .checkout-grid { grid-template-columns: 1fr; }
            .contact-hero { grid-template-columns: 1fr; }
        }

        @media (max-width: 820px) {
            .nav-links { display: none; }
            .hero { min-height: auto; padding-top: 36px; }
            .hero-note { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .footer-inner { flex-direction: column; }
        }

        @media (max-width: 520px) {
            .container { width: min(100% - 28px, 1160px); }
            .brand { font-size: 18px; }
            .brand-mark { width: 32px; height: 32px; }
            .btn { width: 100%; }
            .nav-actions .btn { width: auto; padding-inline: 12px; }
            .staff-login { padding: 9px 10px; }
            .hero-media img { height: 350px; }
            .products { grid-template-columns: 1fr; }
            .section { padding: 58px 0; }
            .modal-body { padding: 20px; }
            .cart-drawer { border-radius: 0; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <nav class="container">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">F</span>
                Floure Bakery
            </a>

            <div class="nav-links">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('storefront.products') ? 'active' : '' }}" href="{{ route('storefront.products') }}">Produk</a>
                <a class="{{ request()->routeIs('storefront.about') ? 'active' : '' }}" href="{{ route('storefront.about') }}">Tentang Kami</a>
                <a class="{{ request()->routeIs('storefront.contact') ? 'active' : '' }}" href="{{ route('storefront.contact') }}">Kontak</a>
            </div>

            <div class="nav-actions">
                <a class="staff-login" href="{{ route('login') }}">
                    <small class="full-label">Kasir/Admin</small>
                    <small class="short-label">Staff</small>
                    Masuk
                </a>
                <a class="btn btn-primary" href="{{ route('storefront.products') }}">Pesan</a>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="site-footer">
        <div class="container footer-inner">
            <span>&copy; {{ date('Y') }} Floure Bakery</span>
            <span>Fresh baked daily. Dibuat hangat untuk setiap momen.</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
