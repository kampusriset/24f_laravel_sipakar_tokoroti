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

            @if ($errors->any())
                <div class="kasir-alert kasir-alert-error">{{ $errors->first() }}</div>
            @endif

                <article class="kasir-card" style="padding: 2rem;">
                    <div style="margin-bottom: 2rem;">
                        <h2 class="kasir-card-title text-2xl font-bold">Create Detail Transaksi</h2>
                    </div>
                    @livewire('kasir.detail-transaksi-form')
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
