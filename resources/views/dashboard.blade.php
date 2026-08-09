<x-app-layout>
    <style>
        .dashboard-page {
            min-height: calc(100vh - 4.75rem);
            padding: 1.5rem 1.75rem;
            background: #ffffff;
            color: #111827;
            font-family: Arial, Helvetica, sans-serif;
        }

        .dashboard-wrap {
            max-width: 1180px;
            margin: 0;
        }

        .dashboard-title {
            margin: 0 0 1.35rem;
            color: #000;
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .stat-card,
        .widget-card {
            overflow: hidden;
            border: 1px solid #d9d9d9;
            border-radius: .7rem;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
        }

        .stat-card {
            min-height: 8.25rem;
            padding: 1.15rem 1.35rem;
        }

        .stat-label {
            margin: 0 0 .45rem;
            color: #5f6470;
            font-size: .72rem;
            font-weight: 600;
        }

        .stat-value {
            margin: 0;
            color: #000;
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.15;
        }

        .stat-help {
            margin: .45rem 0 0;
            font-size: .7rem;
            font-weight: 650;
        }

        .help-green { color: #00b050; }
        .help-orange { color: #f59e0b; }
        .help-red { color: #ef4444; }

        .widget-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .widget-card.full {
            grid-column: 1 / -1;
        }

        .widget-head {
            padding: .9rem 1.25rem;
            border-bottom: 1px solid #d9d9d9;
            background: #fff;
        }

        .widget-title {
            margin: 0;
            color: #000;
            font-size: .98rem;
            font-weight: 800;
        }

        .widget-desc {
            margin: .22rem 0 0;
            color: #667085;
            font-size: .7rem;
            font-weight: 500;
        }

        .chart-area {
            position: relative;
            height: 23rem;
            padding: 1rem 1.4rem 1.25rem;
            background: #fff;
        }

        .chart-area.large {
            height: 25rem;
        }

        .chart-grid {
            position: absolute;
            inset: 2.1rem 1.8rem 2.1rem 1.8rem;
            background-image:
                linear-gradient(to right, rgba(17, 24, 39, .06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(17, 24, 39, .06) 1px, transparent 1px);
            background-size: 10% 20%;
        }

        .axis-x {
            position: absolute;
            right: 1.8rem;
            bottom: .9rem;
            left: 1.8rem;
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            color: #697386;
            font-size: .62rem;
            text-align: center;
        }

        .axis-y {
            position: absolute;
            top: 1.5rem;
            bottom: 2.1rem;
            left: 1.05rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #697386;
            font-size: .62rem;
        }

        .trend-line {
            position: absolute;
            right: 2.3rem;
            bottom: 2.65rem;
            left: 2.3rem;
            height: .36rem;
            border-radius: 999px;
            background: #f59e0b;
        }

        .trend-dot {
            position: absolute;
            bottom: -.28rem;
            width: .72rem;
            height: .72rem;
            border-radius: 999px;
            background: #78350f;
            transform: translateX(-50%);
        }

        .bar-list {
            position: relative;
            z-index: 1;
            display: grid;
            gap: .7rem;
            padding: .75rem .25rem;
        }

        .bar-row {
            display: grid;
            grid-template-columns: 11rem 1fr 4rem;
            align-items: center;
            gap: .75rem;
            color: #111827;
            font-size: .75rem;
            font-weight: 700;
        }

        .bar-track {
            height: .6rem;
            overflow: hidden;
            border-radius: 999px;
            background: #f2f4f7;
        }

        .bar-fill {
            display: block;
            height: 100%;
            border-radius: inherit;
            background: #f59e0b;
        }

        .empty-note {
            position: relative;
            z-index: 1;
            display: grid;
            height: 100%;
            place-items: center;
            color: #8a6b4d;
            font-size: 1rem;
            font-weight: 700;
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
            .widget-grid {
                grid-template-columns: 1fr;
            }

            .bar-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-wrap">
            <h1 class="dashboard-title">Dashboard Floure Bakery</h1>

            <section class="stats-grid">
                <article class="stat-card">
                    <p class="stat-label">📦 Total Produk</p>
                    <h2 class="stat-value">{{ number_format($stats['total_produk']) }} Produk</h2>
                    <p class="stat-help help-green">Jumlah seluruh produk yang tersedia 🟢</p>
                </article>

                <article class="stat-card">
                    <p class="stat-label">🛒 Total Transaksi</p>
                    <h2 class="stat-value">{{ number_format($stats['total_transaksi']) }} Transaksi</h2>
                    <p class="stat-help help-orange">Transaksi yang telah tercatat 🛒</p>
                </article>

                <article class="stat-card">
                    <p class="stat-label">💰 Total Pendapatan</p>
                    <h2 class="stat-value">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h2>
                    <p class="stat-help help-orange">Akumulasi pendapatan toko 💵</p>
                </article>

                <article class="stat-card">
                    <p class="stat-label">⚠️ Stok Menipis</p>
                    <h2 class="stat-value">{{ number_format($stats['stok_menipis']) }} Produk</h2>
                    <p class="stat-help help-red">Produk dengan stok ≤ 10 ⚠️</p>
                </article>
            </section>

            <section class="widget-grid">
                <article class="widget-card full">
                    <div class="widget-head">
                        <h2 class="widget-title">🏆 Top 5 Produk Terlaris</h2>
                        <p class="widget-desc">Produk yang paling banyak terjual berdasarkan jumlah transaksi.</p>
                    </div>
                    <div class="chart-area large">
                        <div class="chart-grid"></div>
                        @if($topProducts->isNotEmpty())
                            @php $topMax = max(1, (int) ($topProducts->max('total_terjual') ?? 1)); @endphp
                            <div class="bar-list">
                                @foreach($topProducts as $item)
                                    @php $percent = min(100, ((int) $item->total_terjual / $topMax) * 100); @endphp
                                    <div class="bar-row">
                                        <span>{{ $item->produk?->nama_produk ?? 'Produk dihapus' }}</span>
                                        <span class="bar-track"><span class="bar-fill" style="width: {{ $percent }}%"></span></span>
                                        <strong>{{ number_format($item->total_terjual) }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="axis-x">
                            @foreach(['0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0',''] as $tick)
                                <span>{{ $tick }}</span>
                            @endforeach
                        </div>
                    </div>
                </article>

                <article class="widget-card full">
                    <div class="widget-head">
                        <h2 class="widget-title">🥧 Distribusi Produk Berdasarkan Kategori</h2>
                        <p class="widget-desc">Persentase jumlah produk pada setiap kategori.</p>
                    </div>
                    <div class="chart-area large">
                        <div class="chart-grid"></div>
                        @if($categories->isEmpty())
                            <div class="empty-note">Belum ada kategori produk.</div>
                        @endif
                    </div>
                </article>

                <article class="widget-card">
                    <div class="widget-head">
                        <h2 class="widget-title">📈 Grafik Penjualan Bulanan</h2>
                        <p class="widget-desc">Total pendapatan toko setiap bulan.</p>
                    </div>
                    <div class="chart-area">
                        <div class="chart-grid"></div>
                        <div class="axis-y">
                            @foreach(['1.0','0.9','0.8','0.7','0.6','0.5','0.4','0.3','0.2','0.1','0'] as $tick)
                                <span>{{ $tick }}</span>
                            @endforeach
                        </div>
                        <div class="axis-x">
                            @foreach($months as $month)
                                <span>{{ $month }}</span>
                            @endforeach
                        </div>
                    </div>
                </article>

                <article class="widget-card">
                    <div class="widget-head">
                        <h2 class="widget-title">📈 Tren Pendapatan Bulanan</h2>
                        <p class="widget-desc">Pergerakan pendapatan toko setiap bulan.</p>
                    </div>
                    <div class="chart-area">
                        <div class="chart-grid"></div>
                        <div class="axis-y">
                            @foreach(['1.0','0.9','0.8','0.7','0.6','0.5','0.4','0.3','0.2','0.1','0'] as $tick)
                                <span>{{ $tick }}</span>
                            @endforeach
                        </div>
                        <div class="trend-line">
                            @foreach($months as $index => $month)
                                <span class="trend-dot" style="left: {{ $index * (100 / 11) }}%;"></span>
                            @endforeach
                        </div>
                        <div class="axis-x">
                            @foreach($months as $month)
                                <span>{{ $month }}</span>
                            @endforeach
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
