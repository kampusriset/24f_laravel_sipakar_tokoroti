<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Kasir</p>
                    <h1 class="kasir-title">Pembayaran</h1>
                    <p class="kasir-subtitle">Monitoring pembayaran pelanggan dari halaman Breeze.</p>
                </div>
            </header>

            <article class="kasir-card">
                <div class="kasir-card-head">
                    <h2 class="kasir-card-title">Daftar Pembayaran</h2>
                    <span class="kasir-pill">{{ method_exists($payments, 'total') ? $payments->total() : $payments->count() }} data</span>
                </div>
                @if($payments->isNotEmpty())
                    <div class="kasir-table-wrap">
                        <table class="kasir-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Transaksi</th>
                                    <th>Metode</th>
                                    <th>Dibayar</th>
                                    <th>Kembalian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>PAY-{{ str_pad($payment->id_pembayaran, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>TRX-{{ str_pad($payment->id_transaksi, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $payment->metode_pembayaran }}</td>
                                        <td>Rp {{ number_format($payment->jumlah_dibayar, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($payment->jumlah_kembalian, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="kasir-empty">Belum ada pembayaran.</div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
