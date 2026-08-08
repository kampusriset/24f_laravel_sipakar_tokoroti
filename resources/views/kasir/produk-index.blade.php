<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Inventori</p>
                    <h1 class="kasir-title">Produk</h1>
                    <p class="kasir-subtitle">Etalase produk kasir dalam tampilan Breeze.</p>
                </div>
            </header>

            @if($products->isNotEmpty())
                <div class="kasir-grid">
                    @foreach($products as $product)
                        <article class="kasir-product">
                            <div style="display:flex;justify-content:space-between;gap:.75rem;">
                                <span class="kasir-product-mark">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</span>
                                <span class="kasir-status {{ ($product->stok?->jumlah_stok ?? 0) <= 10 ? 'danger' : '' }}">Stok {{ $product->stok?->jumlah_stok ?? 0 }}</span>
                            </div>
                            <h2 class="kasir-product-name">{{ $product->nama_produk }}</h2>
                            <p class="kasir-muted">{{ $product->kategori?->nama_kategori ?? 'Tanpa kategori' }}</p>
                            <strong class="kasir-product-price">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</strong>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="kasir-card"><div class="kasir-empty">Belum ada produk.</div></div>
            @endif
        </div>
    </div>
</x-app-layout>
