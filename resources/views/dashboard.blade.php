@php
    $topMax = max(1, (int) ($topProducts->max('total_terjual') ?? 1));
    $categoryTotal = max(1, (int) $categories->sum('produk_count'));
    $chartColors = ['#f59e0b', '#3b82f6', '#22c55e', '#ef4444', '#8b5cf6', '#ec4899', '#06b6d4'];
    $trendPoints = $monthlySales->values()->map(function ($value, $index) use ($monthlyMax) {
        $x = 36 + ($index * 76);
        $y = 220 - (((float) $value / $monthlyMax) * 170);
        return $x . ',' . $y;
    })->implode(' ');
@endphp

<x-app-layout>
    <style>
        .dashboard-page {
            min-height: calc(100vh - 4.75rem);
            padding: 1.75rem;
            background:
                radial-gradient(circle at 8% 8%, rgba(230, 148, 69, .14), transparent 20rem),
                linear-gradient(135deg, #fffaf3 0%, #f8efe4 52%, #f6eadc 100%);
            color: #2f2117;
        }

        .dashboard-wrap {
            width: min(100%, 1380px);
            margin: 0 auto;
        }

        .dashboard-head {
            margin-bottom: 1.25rem;
        }

        .dashboard-kicker {
            margin: 0 0 .35rem;
            color: #9a6b45;
            font-size: .78rem;
            font-weight: 950;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .dashboard-title {
            margin: 0;
            color: #2f2117;
            font-size: clamp(1.9rem, 3vw, 2.8rem);
            font-weight: 950;
            line-height: 1;
        }

        .dashboard-subtitle {
            margin: .45rem 0 0;
            color: #806d5f;
            font-weight: 650;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-card,
        .widget-card {
            border: 1px solid rgba(133, 91, 58, .16);
            border-radius: 1rem;
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 18px 45px rgba(91, 54, 28, .1);
            overflow: hidden;
        }

        .stat-card {
            position: relative;
            min-height: 8.75rem;
            padding: 1.15rem;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            inset-inline: 1rem;
            bottom: 0;
            height: .22rem;
            border-radius: 999px 999px 0 0;
            background: linear-gradient(90deg, #d9843a, #663214);
        }

        .stat-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin: 0;
            color: #79685c;
            font-size: .82rem;
            font-weight: 850;
        }

        .stat-icon {
            display: grid;
            width: 2rem;
            height: 2rem;
            place-items: center;
            border-radius: .7rem;
            background: #fff1d7;
        }

        .stat-value {
            margin: .75rem 0 .25rem;
            color: #1f150f;
            font-size: clamp(1.65rem, 2.4vw, 2.25rem);
            font-weight: 950;
            line-height: 1;
        }

        .stat-help {
            margin: 0;
            color: #8b7868;
            font-size: .82rem;
            font-weight: 650;
        }

        .widget-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .widget-card.full {
            grid-column: 1 / -1;
        }

        .widget-head {
            padding: 1rem 1.15rem;
            border-bottom: 1px solid rgba(133, 91, 58, .12);
            background: linear-gradient(180deg, #fffdf9, #fff8ed);
        }

        .widget-title {
            margin: 0;
            color: #2f2117;
            font-size: 1rem;
            font-weight: 950;
        }

        .widget-desc {
            margin: .25rem 0 0;
            color: #806d5f;
            font-size: .84rem;
            font-weight: 650;
        }

        .widget-body {
            padding: 1rem 1.15rem 1.25rem;
        }

        .bar-list {
            display: grid;
            gap: .95rem;
        }

        .bar-row {
            display: grid;
            gap: .45rem;
        }

        .bar-head {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            color: #2f2117;
            font-size: .88rem;
            font-weight: 900;
        }

        .bar-track {
            height: .72rem;
            overflow: hidden;
            border-radius: 999px;
            background: #f1e2d1;
        }

        .bar-fill {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #f59e0b, #633116);
        }

        .monthly-chart {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: .55rem;
            align-items: end;
            min-height: 18rem;
            padding-top: 1rem;
        }

        .month-bar {
            display: grid;
            gap: .45rem;
            align-items: end;
            height: 100%;
            min-width: 0;
        }

        .month-fill {
            min-height: .35rem;
            border-radius: .65rem .65rem .2rem .2rem;
            background: linear-gradient(180deg, #f59e0b, #9a4f1f);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.45);
        }

        .month-label {
            color: #806d5f;
            font-size: .72rem;
            font-weight: 850;
            text-align: center;
        }

        .category-layout {
            display: grid;
            grid-template-columns: minmax(180px, .65fr) minmax(0, 1fr);
            gap: 1.25rem;
            align-items: center;
        }

        .donut {
            --p1: 0%;
            width: min(100%, 15rem);
            aspect-ratio: 1;
            margin: 0 auto;
            border-radius: 999px;
            background: conic-gradient(#f59e0b var(--p1), #3b82f6 0 100%);
            display: grid;
            place-items: center;
        }

        .donut::after {
            content: "";
            width: 58%;
            aspect-ratio: 1;
            border-radius: inherit;
            background: #fffdf9;
            box-shadow: inset 0 0 0 1px rgba(133, 91, 58, .12);
        }

        .legend {
            display: grid;
            gap: .7rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            color: #2f2117;
            font-size: .86rem;
            font-weight: 850;
        }

        .legend-name {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            min-width: 0;
        }

        .dot {
            width: .72rem;
            height: .72rem;
            flex: 0 0 auto;
            border-radius: 999px;
        }

        .trend-svg {
            width: 100%;
            min-height: 19rem;
            overflow: visible;
        }

        .empty-state {
            padding: 3rem 1rem;
            color: #8b7868;
            text-align: center;
            font-weight: 800;
        }

        @media (max-width: 1180px) {
            .stats-grid,
            .widget-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {
            .dashboard-page {
                padding: 1rem;
            }

            .stats-grid,
            .widget-grid,
            .category-layout {
                grid-template-columns: 1fr;
            }

            .monthly-chart {
                overflow-x: auto;
                grid-template-columns: repeat(12, 3rem);
            }
        }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-wrap">
            <header class="dashboard-head">
                <p class="dashboard-kicker">Dashboard Floure Bakery</p>
                <h1 class="dashboard-title">Ringkasan Operasional</h1>
                <p class="dashboard-subtitle">Isi dashboard mengikuti widget Filament: statistik, top produk, kategori, penjualan, dan tren pendapatan.</p>
            </header>

            <section class="stats-grid">
                <article class="stat-card">
                    <p class="stat-label"><span class="stat-icon">📦</span>Total Produk</p>
                    <h2 class="stat-value">{{ number_format($stats['total_produk']) }} Produk</h2>
                    <p class="stat-help">Jumlah seluruh produk yang tersedia</p>
                </article>
                <article class="stat-card">
                    <p class="stat-label"><span class="stat-icon">🛒</span>Total Transaksi</p>
                    <h2 class="stat-value">{{ number_format($stats['total_transaksi']) }} Transaksi</h2>
                    <p class="stat-help">Transaksi yang telah tercatat</p>
                </article>
                <article class="stat-card">
                    <p class="stat-label"><span class="stat-icon">💰</span>Total Pendapatan</p>
                    <h2 class="stat-value">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h2>
                    <p class="stat-help">Akumulasi pendapatan toko</p>
                </article>
                <article class="stat-card">
                    <p class="stat-label"><span class="stat-icon">⚠</span>Stok Menipis</p>
                    <h2 class="stat-value">{{ number_format($stats['stok_menipis']) }} Produk</h2>
                    <p class="stat-help">Produk dengan stok ≤ 10</p>
                </article>
            </section>

            <section class="widget-grid">
                <article class="widget-card full">
                    <div class="widget-head">
                        <h2 class="widget-title">🏆 Top 5 Produk Terlaris</h2>
                        <p class="widget-desc">Produk yang paling banyak terjual berdasarkan jumlah transaksi.</p>
                    </div>
                    <div class="widget-body">
                        @if($topProducts->isNotEmpty())
                            <div class="bar-list">
                                @foreach($topProducts as $item)
                                    @php $percent = min(100, ((int) $item->total_terjual / $topMax) * 100); @endphp
                                    <div class="bar-row">
                                        <div class="bar-head">
                                            <span>{{ $item->produk?->nama_produk ?? 'Produk dihapus' }}</span>
                                            <strong>{{ number_format($item->total_terjual) }} terjual</strong>
                                        </div>
                                        <div class="bar-track"><span class="bar-fill" style="width: {{ $percent }}%"></span></div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">Belum ada data produk terlaris.</div>
                        @endif
                    </div>
                </article>

                <article class="widget-card full">
                    <div class="widget-head">
                        <h2 class="widget-title">🥧 Distribusi Produk Berdasarkan Kategori</h2>
                        <p class="widget-desc">Persentase jumlah produk pada setiap kategori.</p>
                    </div>
                    <div class="widget-body">
                        @if($categories->isNotEmpty())
                            @php
                                $firstPercent = (($categories->first()->produk_count ?? 0) / $categoryTotal) * 100;
                            @endphp
                            <div class="category-layout">
                                <div class="donut" style="--p1: {{ $firstPercent }}%;"></div>
                                <div class="legend">
                                    @foreach($categories as $index => $category)
                                        @php
                                            $percent = ($category->produk_count / $categoryTotal) * 100;
                                            $color = $chartColors[$index % count($chartColors)];
                                        @endphp
                                        <div class="legend-item">
                                            <span class="legend-name"><span class="dot" style="background: {{ $color }}"></span>{{ $category->nama_kategori }}</span>
                                            <strong>{{ $category->produk_count }} produk · {{ number_format($percent, 1) }}%</strong>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="empty-state">Belum ada kategori produk.</div>
                        @endif
                    </div>
                </article>

                <article class="widget-card">
                    <div class="widget-head">
                        <h2 class="widget-title">📈 Grafik Penjualan Bulanan</h2>
                        <p class="widget-desc">Total pendapatan toko setiap bulan.</p>
                    </div>
                    <div class="widget-body">
                        <div class="monthly-chart">
                            @foreach($months as $index => $month)
                                @php
                                    $value = (float) $monthlySales[$index];
                                    $height = max(2, ($value / $monthlyMax) * 100);
                                @endphp
                                <div class="month-bar">
                                    <div class="month-fill" title="Rp {{ number_format($value, 0, ',', '.') }}" style="height: {{ $height }}%"></div>
                                    <span class="month-label">{{ $month }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>

                <article class="widget-card">
                    <div class="widget-head">
                        <h2 class="widget-title">📈 Tren Pendapatan Bulanan</h2>
                        <p class="widget-desc">Pergerakan pendapatan toko setiap bulan.</p>
                    </div>
                    <div class="widget-body">
                        <svg class="trend-svg" viewBox="0 0 900 260" preserveAspectRatio="none" role="img" aria-label="Tren pendapatan bulanan">
                            <defs>
                                <linearGradient id="trendFill" x1="0" x2="0" y1="0" y2="1">
                                    <stop offset="0%" stop-color="#f59e0b" stop-opacity=".28" />
                                    <stop offset="100%" stop-color="#f59e0b" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <path d="M36,220 L{{ $trendPoints }} L872,220 Z" fill="url(#trendFill)" />
                            <polyline points="{{ $trendPoints }}" fill="none" stroke="#f59e0b" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                            @foreach($monthlySales as $index => $value)
                                @php
                                    $x = 36 + ($index * 76);
                                    $y = 220 - (((float) $value / $monthlyMax) * 170);
                                @endphp
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="6" fill="#633116" />
                            @endforeach
                        </svg>
                    </div>
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
