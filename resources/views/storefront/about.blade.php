@extends('layouts.storefront')

@section('content')
<main>
    <section class="page-head">
        <div class="container">
            <span class="eyebrow">Cerita kami</span>
            <h1>Dibuat untuk menghangatkan hari.</h1>
            <p>Floure Bakery hadir untuk membawa rasa rumahan yang sederhana, hangat, dan selalu berkesan.</p>
        </div>
    </section>

    <section class="section">
        <div class="container two-col">
            <img
                class="feature-img"
                src="https://images.unsplash.com/photo-1517433367423-c7e5b0f35086?auto=format&fit=crop&w=1000&q=85"
                alt="Baker menata roti segar di dapur bakery"
            >

            <div>
                <span class="eyebrow">Sejak pagi hingga sore</span>
                <h2>Dipanggang dengan sepenuh hati.</h2>
                <p class="copy">
                    Kami percaya roti terbaik bukan hanya soal rasa, tetapi juga tentang momen.
                    Karena itu, kami menjaga proses dari pemilihan bahan hingga roti tiba di tangan pelanggan.
                </p>

                <div class="info-card" style="margin-top:24px">
                    <h3>Janji Floure</h3>
                    <p class="copy" style="margin:0">Bahan pilihan, produk fresh setiap hari, dan pelayanan yang ramah.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container two-col">
            <div>
                <span class="eyebrow">Dapur kami</span>
                <h2>Setiap adonan punya waktunya sendiri.</h2>
                <p class="copy">
                    Roti difermentasi dengan cukup, pastry dilipat dengan teliti, dan cake dibuat dalam batch kecil
                    supaya kualitasnya tetap konsisten.
                </p>
            </div>

            <img
                class="page-visual"
                src="https://images.unsplash.com/photo-1608198093002-ad4e005484ec?auto=format&fit=crop&w=1000&q=85"
                alt="Proses pembuatan roti di meja kerja bakery"
            >
        </div>
    </section>
</main>
@endsection
