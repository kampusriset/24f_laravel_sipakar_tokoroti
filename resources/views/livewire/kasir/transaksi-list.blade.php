<div>
    {{-- Flash messages --}}
    @if (session()->has('status'))
        <div style="margin-bottom:1rem; padding:.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:.65rem; color:#166534; font-size:.875rem; font-weight:700;">
            {{ session('status') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div style="margin-bottom:1rem; padding:.75rem 1rem; background:#fef2f2; border:1px solid #fecaca; border-radius:.65rem; color:#991b1b; font-size:.875rem; font-weight:700;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Toolbar --}}
    <div style="display:flex; flex-wrap:wrap; align-items:center; gap:.75rem; margin-bottom:1.25rem;">
        {{-- Export buttons --}}
        <a href="{{ route('export.transaksi.excel') }}" target="_blank"
           style="display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; background:#16a34a; color:#fff; border-radius:.5rem; font-size:.82rem; font-weight:800; text-decoration:none;">
            📊 Export Excel
        </a>
        <a href="{{ route('export.transaksi.pdf') }}" target="_blank"
           style="display:inline-flex; align-items:center; gap:.4rem; padding:.5rem 1rem; background:#dc2626; color:#fff; border-radius:.5rem; font-size:.82rem; font-weight:800; text-decoration:none;">
            📄 Export PDF
        </a>

        <div style="margin-left:auto; display:flex; align-items:center; gap:.65rem;">
            {{-- Status filter --}}
            <select wire:model.live="statusFilter"
                    style="padding:.5rem .85rem; border:1px solid #d1d5db; border-radius:.5rem; font-size:.85rem; background:#fff; outline:none;">
                <option value="">Semua Status</option>
                <option value="Pending">Pending</option>
                <option value="Selesai">Selesai</option>
                <option value="Batal">Batal</option>
            </select>

            {{-- Search --}}
            <div style="position:relative;">
                <input wire:model.live.debounce.300ms="search"
                       type="text"
                       placeholder="🔍  Cari ID..."
                       style="padding:.5rem .85rem .5rem 1rem; border:1px solid #d1d5db; border-radius:.5rem; font-size:.85rem; outline:none; width:13rem;">
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div style="overflow-x:auto; border:1px solid #e5e7eb; border-radius:.75rem;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="text-align:left; padding:.75rem 1rem; font-weight:700; color:#374151;">ID ↕</th>
                    <th style="text-align:left; padding:.75rem 1rem; font-weight:700; color:#374151;">Tanggal ↕</th>
                    <th style="text-align:left; padding:.75rem 1rem; font-weight:700; color:#374151;">Kasir</th>
                    <th style="text-align:left; padding:.75rem 1rem; font-weight:700; color:#374151;">Total Bayar ↕</th>
                    <th style="text-align:left; padding:.75rem 1rem; font-weight:700; color:#374151;">Status ↕</th>
                    <th style="text-align:right; padding:.75rem 1rem; font-weight:700; color:#374151;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    @php $status = $transaction->status_transaksi ?? 'Pending'; @endphp
                    <tr style="border-bottom:1px solid #f3f4f6; transition:background .1s ease;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">
                        <td style="padding:.75rem 1rem; color:#6b7280;">{{ $transaction->id_transaksi }}</td>
                        <td style="padding:.75rem 1rem; color:#6b7280;">
                            {{ $transaction->tanggal_transaksi ? \Illuminate\Support\Carbon::parse($transaction->tanggal_transaksi)->format('d M Y H:i') : '-' }}
                        </td>
                        <td style="padding:.75rem 1rem; color:#111827;">{{ $transaction->pegawai?->nama_pegawai ?? '-' }}</td>
                        <td style="padding:.75rem 1rem;">
                            <span style="display:inline-block; padding:.2rem .7rem; background:#dcfce7; color:#166534; border-radius:9999px; font-size:.8rem; font-weight:700;">
                                Rp {{ number_format($transaction->total_bayar, 0, ',', '.') }}
                            </span>
                        </td>
                        <td style="padding:.75rem 1rem;">
                            @php
                                $statusColor = match($status) {
                                    'Selesai' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                    'Batal' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                    default => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                };
                            @endphp
                            <span style="display:inline-block; padding:.2rem .7rem; background:{{ $statusColor['bg'] }}; color:{{ $statusColor['text'] }}; border-radius:9999px; font-size:.8rem; font-weight:700;">
                                {{ $status }}
                            </span>
                        </td>
                        <td style="padding:.75rem 1rem; text-align:right;">
                            <div style="display:flex; gap:.4rem; justify-content:flex-end; align-items:center;">
                                @if(strtolower($status) === 'pending')
                                    <a href="{{ route('kasir.transaksi.edit', $transaction->id_transaksi) }}"
                                       style="padding:.35rem .75rem; background:#3b82f6; color:#fff; border-radius:.4rem; font-size:.78rem; font-weight:700; text-decoration:none;">
                                        Edit
                                    </a>
                                    <button onclick="confirm('Hapus transaksi ini?') && $wire.delete({{ $transaction->id_transaksi }})"
                                            style="padding:.35rem .75rem; background:#ef4444; color:#fff; border:0; border-radius:.4rem; font-size:.78rem; font-weight:700; cursor:pointer;">
                                        Hapus
                                    </button>
                                @endif
                                <a href="{{ route('export.transaksi.pdf') }}" target="_blank"
                                   style="padding:.35rem .75rem; background:#6366f1; color:#fff; border-radius:.4rem; font-size:.78rem; font-weight:700; text-decoration:none;">
                                    Cetak PDF
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:3rem 1rem; text-align:center; color:#9ca3af;">
                            <div style="font-size:1.5rem; margin-bottom:.5rem;">✕</div>
                            <div>No transaksis</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
        <div style="margin-top:1rem;">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
