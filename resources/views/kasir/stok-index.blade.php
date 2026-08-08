<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Inventori</p>
                    <h1 class="kasir-title">Stok Produk</h1>
                    <p class="kasir-subtitle">Pantau stok dari halaman Breeze tanpa masuk Filament.</p>
                </div>
            </header>

            <article class="kasir-card">
                <div class="kasir-card-head">
                    <h2 class="kasir-card-title">Daftar Stok</h2>
                    <span class="kasir-pill">{{ method_exists($stocks, 'total') ? $stocks->total() : $stocks->count() }} data</span>
                </div>
                @if($stocks->isNotEmpty())
                    <div class="kasir-table-wrap">
                        <table class="kasir-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                    @php $isLow = $stock->jumlah_stok <= 10; @endphp
                                    <tr>
                                        <td>{{ $stock->produk?->nama_produk ?? 'Produk dihapus' }}</td>
                                        <td>{{ number_format($stock->jumlah_stok) }}</td>
                                        <td><span class="kasir-status {{ $isLow ? 'danger' : '' }}">{{ $isLow ? 'Menipis' : 'Aman' }}</span></td>
                                        <td class="kasir-muted">{{ $stock->tanggal_update ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="kasir-empty">Belum ada stok produk.</div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
