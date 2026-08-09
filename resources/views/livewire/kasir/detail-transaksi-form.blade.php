<div>
    @if (session()->has('status'))
        <div style="margin-bottom:1rem; padding:.75rem 1rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:.65rem; color:#166534; font-size:.875rem; font-weight:700;">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="create">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">

            {{-- Transaksi --}}
            <div>
                <label style="display:block; font-size:.875rem; font-weight:700; color:#374151; margin-bottom:.4rem;">
                    Transaksi <span style="color:#ef4444;">*</span>
                </label>
                <select wire:model.live="id_transaksi" style="width:100%; padding:.6rem .85rem; border:1px solid #d1d5db; border-radius:.5rem; background:#fff; color:#111827; font-size:.9rem; outline:none;" required>
                    <option value="">— Select an option —</option>
                    @foreach($transaksis as $t)
                        <option value="{{ $t->id_transaksi }}">
                            TRX-{{ str_pad($t->id_transaksi, 4, '0', STR_PAD_LEFT) }}
                            ({{ $t->status_transaksi }})
                        </option>
                    @endforeach
                </select>
                @error('id_transaksi')<p style="color:#ef4444; font-size:.8rem; margin-top:.25rem;">{{ $message }}</p>@enderror
            </div>

            {{-- Produk --}}
            <div>
                <label style="display:block; font-size:.875rem; font-weight:700; color:#374151; margin-bottom:.4rem;">
                    Produk <span style="color:#ef4444;">*</span>
                </label>
                <select wire:model.live="id_produk" style="width:100%; padding:.6rem .85rem; border:1px solid #d1d5db; border-radius:.5rem; background:#fff; color:#111827; font-size:.9rem; outline:none;" required>
                    <option value="">— Select an option —</option>
                    @foreach($produks as $p)
                        <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                    @endforeach
                </select>
                @error('id_produk')<p style="color:#ef4444; font-size:.8rem; margin-top:.25rem;">{{ $message }}</p>@enderror
            </div>

            {{-- Jumlah --}}
            <div>
                <label style="display:block; font-size:.875rem; font-weight:700; color:#374151; margin-bottom:.4rem;">
                    Jumlah <span style="color:#ef4444;">*</span>
                </label>
                <input type="number" wire:model.live="jumlah" min="1" style="width:100%; padding:.6rem .85rem; border:1px solid #d1d5db; border-radius:.5rem; font-size:.9rem; outline:none;" required>
                @error('jumlah')<p style="color:#ef4444; font-size:.8rem; margin-top:.25rem;">{{ $message }}</p>@enderror
            </div>

            {{-- Harga Satuan --}}
            <div>
                <label style="display:block; font-size:.875rem; font-weight:700; color:#374151; margin-bottom:.4rem;">Harga Satuan</label>
                <div style="display:flex; align-items:center; border:1px solid #d1d5db; border-radius:.5rem; overflow:hidden; background:#f9fafb;">
                    <span style="padding:.6rem .75rem; background:#f3f4f6; color:#6b7280; font-size:.875rem; border-right:1px solid #d1d5db;">Rp</span>
                    <input type="number" wire:model="harga_satuan" readonly style="width:100%; padding:.6rem .85rem; border:0; background:#f9fafb; color:#6b7280; font-size:.9rem; outline:none;">
                </div>
            </div>

            {{-- Subtotal --}}
            <div>
                <label style="display:block; font-size:.875rem; font-weight:700; color:#374151; margin-bottom:.4rem;">Subtotal</label>
                <div style="display:flex; align-items:center; border:1px solid #d1d5db; border-radius:.5rem; overflow:hidden; background:#f9fafb;">
                    <span style="padding:.6rem .75rem; background:#f3f4f6; color:#6b7280; font-size:.875rem; border-right:1px solid #d1d5db;">Rp</span>
                    <input type="number" wire:model="subtotal" readonly style="width:100%; padding:.6rem .85rem; border:0; background:#f9fafb; color:#6b7280; font-size:.9rem; outline:none;">
                </div>
            </div>

        </div>

        <div style="display:flex; gap:.75rem; margin-top:1.75rem; align-items:center;">
            <button type="submit" style="padding:.6rem 1.4rem; background:#e6a818; color:#fff; border:0; border-radius:.5rem; font-size:.9rem; font-weight:800; cursor:pointer;">
                Create
            </button>
            <button type="button" wire:click="create" style="padding:.6rem 1.25rem; background:#f3f4f6; color:#374151; border:1px solid #d1d5db; border-radius:.5rem; font-size:.9rem; font-weight:700; cursor:pointer;">
                Create &amp; create another
            </button>
            <a href="{{ route('kasir.transaksi.index') }}" style="padding:.6rem 1rem; color:#6b7280; font-size:.9rem; font-weight:700; text-decoration:none;">
                Cancel
            </a>
        </div>
    </form>
</div>
