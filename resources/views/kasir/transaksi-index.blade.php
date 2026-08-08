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

            <article class="kasir-card">
                <div class="kasir-card-head">
                    <h2 class="kasir-card-title">Transaksi</h2>
                    <span class="kasir-pill">{{ method_exists($transactions, 'total') ? $transactions->total() : $transactions->count() }} data</span>
                </div>
                @if($transactions->isNotEmpty())
                    <div class="kasir-table-wrap">
                        <table class="kasir-table">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    @php $status = $transaction->status_transaksi ?? 'Pending'; @endphp
                                    <tr>
                                        <td>TRX-{{ str_pad($transaction->id_transaksi, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="kasir-muted">{{ $transaction->tanggal_transaksi ? \Illuminate\Support\Carbon::parse($transaction->tanggal_transaksi)->format('d M Y') : '-' }}</td>
                                        <td>Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}</td>
                                        <td><span class="kasir-status {{ strtolower($status) === 'pending' ? 'warn' : '' }}">{{ $status }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="kasir-empty">Belum ada transaksi.</div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
