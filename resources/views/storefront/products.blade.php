@extends('layouts.storefront')

@section('content')
<main>
    <section class="page-head">
        <div class="container">
            <span class="eyebrow">Menu pilihan</span>
            <h1>Roti untuk setiap suasana</h1>
            <p>Temukan rasa klasik dan kreasi baru yang dibuat hangat setiap hari.</p>
        </div>
    </section>

    <section class="section">
        <div class="container two-col">
            <div>
                <span class="eyebrow">Fresh from oven</span>
                <h2>Menu dibuat dengan bahan pilihan dan dipanggang harian.</h2>
                <p class="copy">
                    Pilih roti, pastry, atau cake favoritmu. Setiap produk bisa dibuka untuk melihat detail,
                    harga, dan langsung dimasukkan ke keranjang.
                </p>
            </div>
            <img
                class="page-visual"
                src="https://images.unsplash.com/photo-1519682577862-22b62b24e493?auto=format&fit=crop&w=1100&q=85"
                alt="Etalase bakery dengan berbagai roti dan pastry"
            >
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Menu unggulan</span>
                    <h2>Pilihan yang selalu cepat habis.</h2>
                </div>
                <p class="copy">
                    Dari roti sarapan sampai kue untuk hadiah, semuanya dibuat dengan tekstur
                    yang lembut dan rasa yang seimbang.
                </p>
            </div>

            <div class="products">
                @php $products = config('storefront_products'); @endphp

                @foreach ($products as $product)
                    <article
                        class="product"
                        data-id="{{ $product['id'] }}"
                        data-name="{{ $product['name'] }}"
                        data-price="{{ $product['price'] }}"
                        data-image="{{ asset($product['image']) }}"
                        data-description="{{ $product['description'] }}"
                        data-detail="{{ $product['detail'] }}"
                        data-category="{{ $product['category'] }}"
                        data-stock="Tersedia"
                        data-serving="{{ $product['serving'] }}"
                    >
                        <button class="product-detail-trigger" type="button" data-action="detail" aria-label="Lihat detail {{ $product['name'] }}">
                            <img class="product-img" src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                            <div class="product-body">
                                <h3>{{ $product['name'] }}</h3>
                                <small>{{ $product['description'] }}</small>
                            </div>
                        </button>
                        <div class="product-body">
                            <footer>
                                <span>{{ $product['priceLabel'] }}</span>
                                <button class="product-add" type="button" data-action="add" aria-label="Tambah {{ $product['name'] }} ke keranjang">+</button>
                            </footer>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="shop-actions">
                <button class="btn btn-primary cart-button" type="button" id="open-cart">
                    Keranjang
                    <span class="cart-count" id="cart-count">0</span>
                </button>
            </div>
        </div>
    </section>
</main>

<div class="modal-backdrop" id="product-modal" aria-hidden="true">
    <div class="product-modal" role="dialog" aria-modal="true" aria-labelledby="modal-product-name">
        <div class="product-modal-grid">
            <img class="product-modal-img" id="modal-product-image" src="" alt="">
            <div class="modal-body">
                <div class="modal-top">
                    <div>
                        <span class="eyebrow" id="modal-product-category"></span>
                        <h2 id="modal-product-name"></h2>
                    </div>
                    <button class="close-button" type="button" data-close-modal aria-label="Tutup detail produk">&times;</button>
                </div>

                <p class="copy" id="modal-product-detail"></p>
                <div class="detail-price" id="modal-product-price"></div>

                <ul class="detail-list">
                    <li><span>Sajian</span><b id="modal-product-serving"></b></li>
                    <li><span>Status</span><b id="modal-product-stock"></b></li>
                    <li><span>Catatan</span><b>Fresh harian</b></li>
                </ul>

                <button class="btn btn-primary" type="button" id="modal-add-cart">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop cart-backdrop" id="cart-modal" aria-hidden="true">
    <aside class="cart-drawer" role="dialog" aria-modal="true" aria-labelledby="cart-title">
        <div class="modal-body">
            <div class="modal-top">
                <div>
                    <span class="eyebrow">Pesanan kamu</span>
                    <h2 id="cart-title">Keranjang</h2>
                </div>
                <button class="close-button" type="button" data-close-cart aria-label="Tutup keranjang">&times;</button>
            </div>

            <div class="cart-items" id="cart-items"></div>

            <div class="cart-summary">
                <div><span>Subtotal</span><b id="cart-subtotal">Rp 0</b></div>
                <div><span>Estimasi biaya layanan</span><b id="cart-service">Rp 0</b></div>
                <div class="total"><span>Total</span><span id="cart-total">Rp 0</span></div>
            </div>

            <button class="btn btn-primary" type="button" id="checkout-button" style="width: 100%; margin-top: 22px;">Checkout</button>
        </div>
    </aside>
</div>

<div class="modal-backdrop" id="checkout-modal" aria-hidden="true">
    <div class="product-modal" role="dialog" aria-modal="true" aria-labelledby="checkout-title">
        <div class="modal-body">
            <div class="modal-top">
                <div>
                    <span class="eyebrow">Checkout</span>
                    <h2 id="checkout-title">Lengkapi Pesanan</h2>
                </div>
                <button class="close-button" type="button" data-close-checkout aria-label="Tutup checkout">&times;</button>
            </div>

            <form class="checkout-form" id="checkout-form">
                <div class="checkout-review" id="checkout-review"></div>

                <div class="checkout-grid">
                    <div class="field">
                        <label for="customer-name">Nama</label>
                        <input id="customer-name" name="name" type="text" placeholder="Nama pemesan" required>
                    </div>
                    <div class="field">
                        <label for="customer-phone">Nomor Telepon</label>
                        <input id="customer-phone" name="phone" type="tel" placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <div class="checkout-grid">
                    <div class="field">
                        <label for="order-method">Metode</label>
                        <select id="order-method" name="method" required>
                            <option value="Ambil di toko">Ambil di toko</option>
                            <option value="Delivery">Delivery</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="pickup-time">Jam Ambil/Kirim</label>
                        <input id="pickup-time" name="time" type="text" placeholder="Contoh: Hari ini 16.00" required>
                    </div>
                </div>

                <div class="field">
                    <label for="customer-address">Alamat/Catatan</label>
                    <textarea id="customer-address" name="address" placeholder="Alamat jika delivery, atau catatan tambahan."></textarea>
                </div>

                <button class="btn btn-primary" type="submit">Buat Pesanan</button>
            </form>
        </div>
    </div>
</div>

<div class="modal-backdrop" id="order-success-modal" aria-hidden="true">
    <div class="product-modal" role="dialog" aria-modal="true" aria-labelledby="order-success-title">
        <div class="modal-body">
            <div class="modal-top">
                <div>
                    <span class="eyebrow">Pesanan diterima</span>
                    <h2 id="order-success-title">Checkout Berhasil</h2>
                </div>
                <button class="close-button" type="button" data-close-success aria-label="Tutup konfirmasi pesanan">&times;</button>
            </div>

            <div class="checkout-review" id="order-success-content"></div>

            <button class="btn btn-primary" type="button" data-close-success style="width: 100%; margin-top: 18px;">Selesai</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const storageKey = 'floure-cart';
        const ordersKey = 'floure-orders';
        const rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        });

        const products = [...document.querySelectorAll('.product')];
        const productModal = document.getElementById('product-modal');
        const cartModal = document.getElementById('cart-modal');
        const checkoutModal = document.getElementById('checkout-modal');
        const orderSuccessModal = document.getElementById('order-success-modal');
        const cartItems = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');
        const cartSubtotal = document.getElementById('cart-subtotal');
        const cartService = document.getElementById('cart-service');
        const cartTotal = document.getElementById('cart-total');
        const modalAddCart = document.getElementById('modal-add-cart');
        const checkoutReview = document.getElementById('checkout-review');
        const checkoutButton = document.getElementById('checkout-button');
        const checkoutForm = document.getElementById('checkout-form');
        const orderSuccessContent = document.getElementById('order-success-content');
        let activeProduct = null;

        const readCart = () => JSON.parse(localStorage.getItem(storageKey) || '{}');
        const writeCart = (cart) => localStorage.setItem(storageKey, JSON.stringify(cart));
        const readOrders = () => JSON.parse(localStorage.getItem(ordersKey) || '[]');
        const writeOrders = (orders) => localStorage.setItem(ordersKey, JSON.stringify(orders));
        const formatPrice = (value) => rupiah.format(value).replace(/\u00a0/g, ' ');
        const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (char) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;',
        }[char]));

        const productFromCard = (card) => ({
            id: card.dataset.id,
            name: card.dataset.name,
            price: Number(card.dataset.price),
            image: card.dataset.image,
            description: card.dataset.description,
            detail: card.dataset.detail,
            category: card.dataset.category,
            stock: card.dataset.stock,
            serving: card.dataset.serving,
        });

        const addToCart = (product) => {
            const cart = readCart();
            const current = cart[product.id] || { ...product, qty: 0 };
            cart[product.id] = { ...current, qty: current.qty + 1 };
            writeCart(cart);
            renderCart();
        };

        const updateQty = (id, change) => {
            const cart = readCart();
            if (!cart[id]) return;

            cart[id].qty += change;
            if (cart[id].qty <= 0) delete cart[id];

            writeCart(cart);
            renderCart();
        };

        const cartTotals = () => {
            const cart = Object.values(readCart());
            const subtotal = cart.reduce((total, item) => total + item.price * item.qty, 0);
            const service = subtotal > 0 ? 2000 : 0;

            return {
                cart,
                itemCount: cart.reduce((total, item) => total + item.qty, 0),
                subtotal,
                service,
                total: subtotal + service,
            };
        };

        const renderCart = () => {
            const { cart, itemCount, subtotal, service, total } = cartTotals();

            cartCount.textContent = itemCount;
            cartSubtotal.textContent = formatPrice(subtotal);
            cartService.textContent = formatPrice(service);
            cartTotal.textContent = formatPrice(total);
            checkoutButton.disabled = itemCount === 0;
            checkoutButton.style.opacity = itemCount === 0 ? '.55' : '1';
            checkoutButton.style.cursor = itemCount === 0 ? 'not-allowed' : 'pointer';

            if (!cart.length) {
                cartItems.innerHTML = '<div class="cart-empty">Keranjang masih kosong.</div>';
                return;
            }

            cartItems.innerHTML = cart.map((item) => `
                <article class="cart-item">
                    <img src="${escapeHtml(item.image)}" alt="${escapeHtml(item.name)}">
                    <div>
                        <h3>${escapeHtml(item.name)}</h3>
                        <small>${formatPrice(item.price)} x ${item.qty}</small>
                        <div class="cart-controls">
                            <b>${formatPrice(item.price * item.qty)}</b>
                            <div class="qty-controls" aria-label="Jumlah ${escapeHtml(item.name)}">
                                <button type="button" data-qty="${escapeHtml(item.id)}" data-change="-1">-</button>
                                <span>${item.qty}</span>
                                <button type="button" data-qty="${escapeHtml(item.id)}" data-change="1">+</button>
                            </div>
                        </div>
                    </div>
                </article>
            `).join('');
        };

        const renderCheckoutReview = () => {
            const { cart, service, total } = cartTotals();

            checkoutReview.innerHTML = [
                ...cart.map((item) => `
                    <div class="checkout-review-item">
                        <span>${escapeHtml(item.name)} x ${item.qty}</span>
                        <b>${formatPrice(item.price * item.qty)}</b>
                    </div>
                `),
                `<div class="checkout-review-item"><span>Biaya layanan</span><b>${formatPrice(service)}</b></div>`,
                `<div class="checkout-review-total"><span>Total</span><span>${formatPrice(total)}</span></div>`,
            ].join('');
        };

        const renderOrderSuccess = (order) => {
            orderSuccessContent.innerHTML = `
                <div class="checkout-review-total"><span>No. Pesanan</span><span>${escapeHtml(order.id)}</span></div>
                <div class="checkout-review-item"><span>Nama</span><b>${escapeHtml(order.customer.name)}</b></div>
                <div class="checkout-review-item"><span>Metode</span><b>${escapeHtml(order.customer.method)}</b></div>
                <div class="checkout-review-item"><span>Jam</span><b>${escapeHtml(order.customer.time)}</b></div>
                <div class="checkout-review-total"><span>Total</span><span>${formatPrice(order.total)}</span></div>
                <p class="copy" style="margin: 8px 0 0;">Pesanan disimpan di browser ini. Admin toko bisa memproses pesanan ini dari nomor pesanan yang ditampilkan.</p>
            `;
        };

        const openModal = (modal) => {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
        };

        const closeModal = (modal) => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
        };

        const openProductModal = (product) => {
            activeProduct = product;
            document.getElementById('modal-product-image').src = product.image;
            document.getElementById('modal-product-image').alt = product.name;
            document.getElementById('modal-product-category').textContent = product.category;
            document.getElementById('modal-product-name').textContent = product.name;
            document.getElementById('modal-product-detail').textContent = product.detail;
            document.getElementById('modal-product-price').textContent = formatPrice(product.price);
            document.getElementById('modal-product-serving').textContent = product.serving;
            document.getElementById('modal-product-stock').textContent = product.stock;
            openModal(productModal);
        };

        products.forEach((card) => {
            card.querySelector('[data-action="detail"]').addEventListener('click', () => openProductModal(productFromCard(card)));
            card.querySelector('[data-action="add"]').addEventListener('click', () => addToCart(productFromCard(card)));
        });

        modalAddCart.addEventListener('click', () => {
            if (activeProduct) addToCart(activeProduct);
            closeModal(productModal);
            openModal(cartModal);
        });

        document.getElementById('open-cart').addEventListener('click', () => {
            renderCart();
            openModal(cartModal);
        });

        checkoutButton.addEventListener('click', () => {
            const { itemCount } = cartTotals();
            if (itemCount === 0) return;

            renderCheckoutReview();
            closeModal(cartModal);
            openModal(checkoutModal);
        });

        document.querySelector('[data-close-modal]').addEventListener('click', () => closeModal(productModal));
        document.querySelector('[data-close-cart]').addEventListener('click', () => closeModal(cartModal));
        document.querySelector('[data-close-checkout]').addEventListener('click', () => closeModal(checkoutModal));
        document.querySelectorAll('[data-close-success]').forEach((button) => {
            button.addEventListener('click', () => closeModal(orderSuccessModal));
        });

        [productModal, cartModal, checkoutModal, orderSuccessModal].forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) closeModal(modal);
            });
        });

        checkoutForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const { cart, subtotal, service, total } = cartTotals();
            if (!cart.length) return;

            const form = new FormData(checkoutForm);
            const order = {
                id: `FLR-${Date.now().toString().slice(-8)}`,
                items: cart,
                subtotal,
                service,
                total,
                customer: {
                    name: form.get('name'),
                    phone: form.get('phone'),
                    method: form.get('method'),
                    time: form.get('time'),
                    address: form.get('address') || '-',
                },
                status: 'Menunggu konfirmasi toko',
                createdAt: new Date().toISOString(),
            };

            writeOrders([order, ...readOrders()]);
            writeCart({});
            checkoutForm.reset();
            renderCart();
            renderOrderSuccess(order);
            closeModal(checkoutModal);
            openModal(orderSuccessModal);
        });

        cartItems.addEventListener('click', (event) => {
            const button = event.target.closest('[data-qty]');
            if (!button) return;
            updateQty(button.dataset.qty, Number(button.dataset.change));
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            closeModal(productModal);
            closeModal(cartModal);
            closeModal(checkoutModal);
            closeModal(orderSuccessModal);
        });

        renderCart();
    })();
</script>
@endpush
