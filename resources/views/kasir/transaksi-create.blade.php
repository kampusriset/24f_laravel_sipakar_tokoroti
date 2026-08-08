<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Point of Sale</p>
                    <h1 class="kasir-title">Buat Transaksi</h1>
                    <p class="kasir-subtitle">Pilih produk dari etalase kasir. Halaman ini sudah di Breeze dan tidak membuka Filament.</p>
                </div>
                <a href="{{ route('kasir.transaksi.index') }}" class="kasir-action">Riwayat Transaksi</a>
            </header>

            <section class="pos-layout">
                <article class="kasir-card">
                    <div class="kasir-card-head">
                        <h2 class="kasir-card-title">Pilih Produk</h2>
                        <span class="kasir-pill">{{ $products->count() }} item</span>
                    </div>

                    @if($products->isNotEmpty())
                        <div class="kasir-grid" style="padding: 1rem;">
                            @foreach($products as $product)
                                <div class="kasir-product">
                                    <div style="display:flex;justify-content:space-between;gap:.75rem;">
                                        <span class="kasir-product-mark">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</span>
                                        <span class="kasir-status {{ ($product->stok?->jumlah_stok ?? 0) <= 10 ? 'danger' : '' }}">Stok {{ $product->stok?->jumlah_stok ?? 0 }}</span>
                                    </div>
                                    <h3 class="kasir-product-name">{{ $product->nama_produk }}</h3>
                                    <div class="kasir-muted">{{ $product->kategori?->nama_kategori ?? 'Tanpa kategori' }}</div>
                                    <div class="kasir-product-price">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="kasir-empty">Belum ada produk untuk dipilih.</div>
                    @endif
                </article>

                <aside class="kasir-card">
                    <div class="kasir-card-head">
                        <h2 class="kasir-card-title">Keranjang</h2>
                        <span class="kasir-pill">Draft</span>
                    </div>
                    <div class="order-box">
                        <p class="kasir-muted">Keranjang visual siap dipakai untuk alur kasir Breeze. Integrasi simpan transaksi bisa ditambahkan berikutnya.</p>
                        <div class="order-total">
                            <span>Total</span>
                            <span>Rp 0</span>
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </div>
</x-app-layout>
