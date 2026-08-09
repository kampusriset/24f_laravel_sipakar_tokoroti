<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Point of Sale</p>
                    <h1 class="kasir-title">Edit Transaksi TRX-{{ str_pad($transaksi->id_transaksi, 4, '0', STR_PAD_LEFT) }}</h1>
                    <p class="kasir-subtitle">Edit pesanan pelanggan. Mengubah jumlah produk dari etalase kasir.</p>
                </div>
                <a href="{{ route('kasir.transaksi.index') }}" class="kasir-action">Batal & Kembali</a>
            </header>

            @if ($errors->any())
                <div class="kasir-alert kasir-alert-error">{{ $errors->first() }}</div>
            @endif

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
                                    <button
                                        type="button"
                                        class="kasir-button add-product"
                                        data-id="{{ $product->id_produk }}"
                                        data-name="{{ e($product->nama_produk) }}"
                                        data-price="{{ $product->harga_jual }}"
                                        data-stock="{{ $product->stok?->jumlah_stok ?? 0 }}"
                                        @disabled(($product->stok?->jumlah_stok ?? 0) < 1)
                                    >{{ ($product->stok?->jumlah_stok ?? 0) < 1 ? 'Stok Habis' : 'Tambah' }}</button>
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
                        <span class="kasir-pill">Edit Draft</span>
                    </div>
                    <form method="POST" action="{{ route('kasir.transaksi.update', $transaksi->id_transaksi) }}" class="order-box" id="transaction-form">
                        @csrf
                        @method('PUT')
                        <div id="cart-items" class="cart-items">
                            <p class="kasir-muted" id="cart-empty">Belum ada produk di keranjang.</p>
                        </div>
                        <div class="order-total">
                            <span>Total</span>
                            <span id="cart-total">Rp 0</span>
                        </div>
                        <button type="submit" class="kasir-button checkout-button" id="save-transaction" disabled>Simpan Perubahan</button>
                    </form>
                </aside>
            </section>
        </div>
    </div>

    @php
        $initialCart = $transactionItems->map(fn($item) => [
            'id' => $item->id_produk,
            'name' => $item->produk->nama_produk,
            'price' => (float) $item->harga_satuan,
            'stock' => $item->produk->stok?->jumlah_stok ?? 0,
            'quantity' => $item->jumlah,
        ]);
    @endphp

    <script>
        (() => {
            const initialData = @json($initialCart);
            const cart = new Map();
            initialData.forEach(item => cart.set(item.id, item));

            const formatRupiah = new Intl.NumberFormat('id-ID');
            const items = document.getElementById('cart-items');
            const total = document.getElementById('cart-total');
            const saveButton = document.getElementById('save-transaction');

            document.querySelectorAll('.add-product').forEach((button) => {
                button.addEventListener('click', () => {
                    const product = {
                        id: Number(button.dataset.id), name: button.dataset.name,
                        price: Number(button.dataset.price), stock: Number(button.dataset.stock), quantity: 0,
                    };
                    const current = cart.get(product.id) || product;
                    if (current.quantity < current.stock) {
                        current.quantity++;
                        cart.set(current.id, current);
                        render();
                    }
                });
            });

            function render() {
                const products = [...cart.values()];
                saveButton.disabled = products.length === 0;
                total.textContent = `Rp ${formatRupiah.format(products.reduce((sum, product) => sum + product.price * product.quantity, 0))}`;
                items.innerHTML = products.length ? products.map((product) => `
                    <div class="cart-line">
                        <div><strong>${product.name}</strong><span>Rp ${formatRupiah.format(product.price)} × ${product.quantity}</span></div>
                        <div class="cart-controls">
                            <button type="button" data-action="decrease" data-id="${product.id}" aria-label="Kurangi ${product.name}">−</button>
                            <span>${product.quantity}</span>
                            <button type="button" data-action="increase" data-id="${product.id}" ${product.quantity >= product.stock ? 'disabled' : ''} aria-label="Tambah ${product.name}">+</button>
                        </div>
                        <input type="hidden" name="items[${product.id}][id_produk]" value="${product.id}">
                        <input type="hidden" name="items[${product.id}][jumlah]" value="${product.quantity}">
                    </div>`).join('') : '<p class="kasir-muted">Belum ada produk di keranjang.</p>';
            }

            items.addEventListener('click', (event) => {
                const button = event.target.closest('button[data-action]');
                if (!button) return;
                const product = cart.get(Number(button.dataset.id));
                if (button.dataset.action === 'increase' && product.quantity < product.stock) product.quantity++;
                if (button.dataset.action === 'decrease' && --product.quantity === 0) cart.delete(product.id);
                render();
            });

            render(); // Initialize first render
        })();
    </script>
</x-app-layout>
