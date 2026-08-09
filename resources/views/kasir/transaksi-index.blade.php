<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Kasir</p>
                    <h1 class="kasir-title">Riwayat Transaksi</h1>
                    <p class="kasir-subtitle">Daftar transaksi dari database, ditampilkan lewat Breeze.</p>
                </div>
                <a href="{{ route('kasir.transaksi.create') }}" class="kasir-action">Buat Transaksi</a>
            </header>

            <article class="kasir-card" style="padding: 1rem;">
                <div style="margin-bottom: 2rem;">
                    <h2 class="kasir-card-title text-2xl font-bold">Transaksis</h2>
                </div>
                @livewire('kasir.transaksi-list')
            </article>
        </div>
    </div>
</x-app-layout>
