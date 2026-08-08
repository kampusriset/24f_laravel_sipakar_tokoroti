<style>
    .app-shell {
        min-height: 100vh;
        background: #fbf6ef;
        color: #2f2117;
    }

    .app-main {
        min-height: 100vh;
        margin-left: 18rem;
    }

    .content-navbar {
        position: sticky;
        top: 0;
        z-index: 35;
        display: flex;
        min-height: 4.75rem;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: .85rem 1.75rem;
        border-bottom: 1px solid rgba(133, 91, 58, .16);
        background: rgba(255, 252, 247, .9);
        backdrop-filter: blur(16px);
    }

    .content-navbar-kicker {
        margin: 0 0 .15rem;
        color: #9a6b45;
        font-size: .72rem;
        font-weight: 950;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .content-navbar-title {
        margin: 0;
        color: #2f2117;
        font-size: 1.2rem;
        font-weight: 950;
        line-height: 1.1;
    }

    .content-navbar-actions {
        display: flex;
        align-items: center;
        gap: .7rem;
    }

    .profile-menu {
        position: relative;
    }

    .profile-trigger {
        display: inline-flex;
        align-items: center;
        gap: .7rem;
        min-height: 2.8rem;
        padding: .35rem .55rem .35rem .4rem;
        border: 1px solid #ead8c4;
        border-radius: .95rem;
        background: #fff;
        color: #2f2117;
        cursor: pointer;
        font: inherit;
        box-shadow: 0 8px 18px rgba(91, 54, 28, .06);
        transition: border-color .16s ease, box-shadow .16s ease, transform .16s ease;
    }

    .profile-trigger:hover {
        border-color: #d8b996;
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(91, 54, 28, .1);
    }

    .profile-avatar {
        display: grid;
        width: 2.1rem;
        height: 2.1rem;
        place-items: center;
        border-radius: .75rem;
        background: linear-gradient(135deg, #fff1d7, #e89a4c);
        color: #4b260f;
        font-size: .78rem;
        font-weight: 950;
    }

    .profile-avatar.large {
        width: 2.65rem;
        height: 2.65rem;
        border-radius: .9rem;
        font-size: .9rem;
    }

    .profile-text {
        display: grid;
        min-width: 7rem;
        text-align: left;
    }

    .profile-name {
        max-width: 9rem;
        overflow: hidden;
        color: #2f2117;
        font-size: .84rem;
        font-weight: 950;
        line-height: 1.15;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .profile-role {
        color: #8b7868;
        font-size: .7rem;
        font-weight: 750;
    }

    .profile-chevron {
        width: 1rem;
        height: 1rem;
        color: #8b7868;
        transition: transform .16s ease;
    }

    .profile-chevron.is-open {
        transform: rotate(180deg);
    }

    .profile-dropdown {
        position: absolute;
        top: calc(100% + .65rem);
        right: 0;
        width: 17rem;
        overflow: hidden;
        border: 1px solid rgba(133, 91, 58, .16);
        border-radius: 1rem;
        background: rgba(255, 255, 255, .96);
        box-shadow: 0 24px 55px rgba(91, 54, 28, .18);
        backdrop-filter: blur(16px);
    }

    .profile-dropdown-head {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .95rem;
        border-bottom: 1px solid rgba(133, 91, 58, .12);
        background: linear-gradient(180deg, #fffdf9, #fff8ed);
    }

    .profile-dropdown-head strong,
    .profile-dropdown-head small {
        display: block;
        max-width: 12rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .profile-dropdown-head strong {
        color: #2f2117;
        font-size: .9rem;
        font-weight: 950;
    }

    .profile-dropdown-head small {
        margin-top: .15rem;
        color: #8b7868;
        font-size: .74rem;
        font-weight: 700;
    }

    .profile-dropdown-item {
        display: flex;
        width: 100%;
        align-items: center;
        min-height: 2.75rem;
        padding: .75rem .95rem;
        border: 0;
        border-bottom: 1px solid rgba(133, 91, 58, .08);
        background: transparent;
        color: #4f4035;
        cursor: pointer;
        font: inherit;
        font-size: .86rem;
        font-weight: 900;
        text-align: left;
        text-decoration: none;
        transition: background .16s ease, color .16s ease;
    }

    .profile-dropdown-item:hover {
        background: #fff8ed;
        color: #633116;
    }

    .profile-dropdown-item.danger {
        color: #be123c;
        border-bottom: 0;
    }

    .profile-dropdown-item.danger:hover {
        background: #fff1f2;
        color: #9f1239;
    }

    .cashier-sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 50;
        display: flex;
        width: 18rem;
        flex-direction: column;
        border-right: 1px solid rgba(133, 91, 58, .16);
        background:
            linear-gradient(180deg, rgba(255, 252, 247, .98), rgba(249, 235, 216, .96)),
            #fff8ed;
        box-shadow: 18px 0 45px rgba(91, 54, 28, .1);
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: .85rem;
        padding: 1.25rem 1.15rem;
        color: inherit;
        text-decoration: none;
    }

    .sidebar-logo {
        display: grid;
        width: 2.8rem;
        height: 2.8rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .95rem;
        background: linear-gradient(135deg, #fff1d7, #e89a4c);
        color: #4b260f;
        font-size: 1rem;
        font-weight: 950;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8), 0 12px 24px rgba(142, 76, 30, .16);
    }

    .sidebar-title {
        display: block;
        color: #2f2117;
        font-size: 1rem;
        font-weight: 950;
        line-height: 1.15;
    }

    .sidebar-subtitle {
        display: block;
        margin-top: .16rem;
        color: #8b7868;
        font-size: .76rem;
        font-weight: 750;
    }

    .sidebar-section {
        padding: .75rem 1rem;
    }

    .sidebar-label {
        margin: .75rem .35rem .5rem;
        color: #9a8676;
        font-size: .7rem;
        font-weight: 900;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .sidebar-nav {
        display: grid;
        gap: .28rem;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: .75rem;
        min-height: 2.75rem;
        padding: .7rem .8rem;
        border-radius: .9rem;
        color: #5f4b3d;
        font-size: .9rem;
        font-weight: 850;
        text-decoration: none;
        transition: background .16s ease, color .16s ease, transform .16s ease, box-shadow .16s ease;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, .82);
        color: #633116;
        transform: translateX(2px);
        box-shadow: 0 8px 18px rgba(92, 56, 33, .07);
    }

    .sidebar-link.active {
        background: linear-gradient(135deg, #fff3df, #f6d1a3);
        color: #633116;
        box-shadow: 0 12px 25px rgba(165, 91, 35, .14);
    }

    .sidebar-icon {
        display: grid;
        width: 2rem;
        height: 2rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .7rem;
        background: rgba(255, 255, 255, .7);
        font-size: .95rem;
    }

    .sidebar-card {
        margin: .5rem 1rem;
        padding: .9rem;
        border: 1px solid rgba(133, 91, 58, .14);
        border-radius: 1rem;
        background: rgba(255, 255, 255, .66);
    }

    .sidebar-card-title {
        margin: 0;
        color: #2f2117;
        font-size: .85rem;
        font-weight: 950;
    }

    .sidebar-card-copy {
        margin: .25rem 0 .75rem;
        color: #8b7868;
        font-size: .76rem;
        line-height: 1.45;
    }

    .sidebar-button {
        display: inline-flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        min-height: 2.45rem;
        border-radius: .8rem;
        background: linear-gradient(135deg, #6a3517, #3f210f);
        color: #fff8ed;
        font-size: .82rem;
        font-weight: 950;
        text-decoration: none;
    }

    .sidebar-footer {
        margin-top: auto;
        padding: 1rem;
        border-top: 1px solid rgba(133, 91, 58, .12);
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: .8rem;
        padding: .75rem;
        border-radius: .95rem;
        background: rgba(255, 255, 255, .7);
    }

    .sidebar-avatar {
        display: grid;
        width: 2.35rem;
        height: 2.35rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .8rem;
        background: #f7d7aa;
        color: #633116;
        font-size: .78rem;
        font-weight: 950;
    }

    .sidebar-user-name {
        margin: 0;
        color: #2f2117;
        font-size: .86rem;
        font-weight: 950;
        line-height: 1.2;
    }

    .sidebar-user-email {
        max-width: 10rem;
        margin: .12rem 0 0;
        overflow: hidden;
        color: #8b7868;
        font-size: .72rem;
        font-weight: 650;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .logout-button {
        width: 100%;
        min-height: 2.55rem;
        border: 1px solid #f3c6d0;
        border-radius: .8rem;
        background: #fff1f2;
        color: #be123c;
        cursor: pointer;
        font: inherit;
        font-size: .82rem;
        font-weight: 950;
    }

    .mobile-topbar {
        display: none;
    }

    @media (max-width: 900px) {
        .app-main {
            margin-left: 0;
            padding-top: 4.25rem;
        }

        .cashier-sidebar {
            display: none;
        }

        .mobile-topbar {
            position: fixed;
            inset: 0 0 auto;
            z-index: 50;
            display: flex;
            height: 4.25rem;
            align-items: center;
            justify-content: space-between;
            padding: .75rem 1rem;
            border-bottom: 1px solid rgba(133, 91, 58, .16);
            background: rgba(255, 252, 247, .92);
            backdrop-filter: blur(14px);
        }

        .content-navbar {
            top: 4.25rem;
            min-height: 4.2rem;
            padding: .7rem 1rem;
        }

        .profile-role,
        .profile-text {
            display: none;
        }

        .profile-dropdown {
            right: 0;
            width: min(17rem, calc(100vw - 2rem));
        }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: .7rem;
            color: #2f2117;
            font-weight: 950;
            text-decoration: none;
        }

        .mobile-menu {
            display: flex;
            gap: .45rem;
        }

        .mobile-menu a,
        .mobile-menu button {
            min-height: 2.4rem;
            padding: .55rem .7rem;
            border: 1px solid #ead8c4;
            border-radius: .75rem;
            background: #fff;
            color: #633116;
            font: inherit;
            font-size: .76rem;
            font-weight: 900;
            text-decoration: none;
        }
    }
</style>

<aside class="cashier-sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <span class="sidebar-logo">F</span>
        <span>
            <span class="sidebar-title">Floure Bakery</span>
            <span class="sidebar-subtitle">Kasir & Operasional</span>
        </span>
    </a>

    <div class="sidebar-section">
        <div class="sidebar-label">Menu Kasir</div>
        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">⌂</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('kasir.transaksi.create') }}" class="sidebar-link {{ request()->routeIs('kasir.transaksi.create') ? 'active' : '' }}">
                <span class="sidebar-icon">＋</span>
                <span>Buat Transaksi</span>
            </a>
            <a href="{{ route('kasir.transaksi.index') }}" class="sidebar-link {{ request()->routeIs('kasir.transaksi.index') ? 'active' : '' }}">
                <span class="sidebar-icon">▤</span>
                <span>Riwayat Transaksi</span>
            </a>
            <a href="{{ route('kasir.pembayaran.index') }}" class="sidebar-link {{ request()->routeIs('kasir.pembayaran.index') ? 'active' : '' }}">
                <span class="sidebar-icon">▣</span>
                <span>Pembayaran</span>
            </a>
        </nav>

        <div class="sidebar-label">Inventori</div>
        <nav class="sidebar-nav">
            <a href="{{ route('kasir.produk.index') }}" class="sidebar-link {{ request()->routeIs('kasir.produk.index') ? 'active' : '' }}">
                <span class="sidebar-icon">◈</span>
                <span>Produk</span>
            </a>
            <a href="{{ route('kasir.stok.index') }}" class="sidebar-link {{ request()->routeIs('kasir.stok.index') ? 'active' : '' }}">
                <span class="sidebar-icon">□</span>
                <span>Stok Produk</span>
            </a>
        </nav>

        <div class="sidebar-label">Artificial Intelligence</div>
        <nav class="sidebar-nav">
            <a href="{{ route('kasir.ai-rekomendasi') }}" class="sidebar-link {{ request()->routeIs('kasir.ai-rekomendasi') ? 'active' : '' }}">
                <span class="sidebar-icon">✦</span>
                <span>AI Rekomendasi</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-card">
        <p class="sidebar-card-title">Mode Breeze</p>
        <p class="sidebar-card-copy">Semua menu kasir ini memakai halaman Breeze, bukan Filament.</p>
        <a href="{{ route('kasir.transaksi.create') }}" class="sidebar-button">Mulai Transaksi</a>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <span class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}</span>
            <span>
                <p class="sidebar-user-name">{{ Auth::user()->name }}</p>
                <p class="sidebar-user-email">{{ Auth::user()->email }}</p>
            </span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Keluar</button>
        </form>
    </div>
</aside>

<header class="mobile-topbar">
    <a href="{{ route('dashboard') }}" class="mobile-brand">
        <span class="sidebar-logo" style="width:2.35rem;height:2.35rem;border-radius:.8rem;">F</span>
        <span>Floure Bakery</span>
    </a>

    <div class="mobile-menu">
        <a href="{{ route('kasir.transaksi.create') }}">Transaksi</a>
        <a href="{{ route('kasir.ai-rekomendasi') }}">AI</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Keluar</button>
        </form>
    </div>
</header>
