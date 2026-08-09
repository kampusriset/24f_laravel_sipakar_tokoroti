@extends('layouts.storefront')

@section('content')
<main>
    <section class="page-head">
        <div class="container">
            <span class="eyebrow">Hubungi kami</span>
            <h1>Mari berbagi kehangatan.</h1>
            <p>Kunjungi toko kami atau hubungi kami untuk informasi produk dan pesanan.</p>
        </div>
    </section>

    <section class="section">
        <div class="container contact-hero">
            <div>
                <span class="eyebrow">Toko Floure</span>
                <h2>Datang langsung atau pesan untuk acara spesialmu.</h2>
                <p class="copy">
                    Tim kami siap membantu memilih menu roti, pastry, dan cake yang paling pas
                    untuk sarapan, hadiah, atau kebutuhan acara.
                </p>
            </div>

            <img
                class="page-visual"
                src="https://images.unsplash.com/photo-1568254183919-78a4f43a2877?auto=format&fit=crop&w=1000&q=85"
                alt="Etalase toko bakery dengan cake dan pastry"
            >
        </div>
    </section>

    <section class="section">
        <div class="container contact-grid">
            <article class="contact-card">
                <b>01</b>
                <h3>Kunjungi Toko</h3>
                <p class="copy" style="margin:0">Jl. Roti Hangat No. 24<br>Surakarta, Jawa Tengah</p>
            </article>

            <article class="contact-card">
                <b>02</b>
                <h3>Telepon</h3>
                <p class="copy" style="margin:0">+62 812 3456 7890<br>Setiap hari, 08.00-20.00</p>
            </article>

            <article class="contact-card">
                <b>03</b>
                <h3>Email</h3>
                <p class="copy" style="margin:0">halo@flourebakery.test<br>Kami siap membantu.</p>
            </article>
        </div>
    </section>
</main>
@endsection
