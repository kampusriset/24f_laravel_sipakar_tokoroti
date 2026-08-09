<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Inventori</p>
                    <h1 class="kasir-title">CRUD Stok Produk</h1>
                    <p class="kasir-subtitle">Tambah, update, dan hapus data stok produk dari halaman kasir.</p>
                </div>
            </header>

            @if(session('status'))
                <div class="kasir-alert">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="kasir-alert" style="border-color:#f3c6d0;background:#fff1f2;color:#be123c;">
                    {{ $errors->first() }}
                </div>
            @endif

            <article class="kasir-card" style="margin-bottom:1rem;">
                <div class="kasir-card-head">
                    <h2 class="kasir-card-title">Tambah / Set Stok</h2>
                    <span class="kasir-pill">{{ $products->count() }} produk</span>
                </div>

                <form method="POST" action="{{ route('kasir.stok.store') }}" class="kasir-form">
                    @csrf
                    <div class="kasir-form-grid">
                        <div class="kasir-field span-2">
                            <label for="id_produk">Produk</label>
                            <select id="id_produk" class="kasir-select" name="id_produk" required>
                                <option value="">Pilih produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id_produk }}" @selected(old('id_produk') == $product->id_produk)>{{ $product->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="kasir-field">
                            <label for="jumlah_stok">Jumlah Stok</label>
                            <input id="jumlah_stok" class="kasir-input" type="number" min="0" name="jumlah_stok" value="{{ old('jumlah_stok', 0) }}" required>
                        </div>

                        <div class="kasir-field" style="align-self:end;">
                            <button type="submit" class="kasir-button">Simpan Stok</button>
                        </div>
                    </div>
                </form>
            </article>

            <article class="kasir-card">
                <div class="kasir-card-head">
                    <h2 class="kasir-card-title">Daftar Stok</h2>
                    <span class="kasir-pill">{{ method_exists($stocks, 'total') ? $stocks->total() : $stocks->count() }} data</span>
                </div>
                @if($stocks->isNotEmpty())
                    <div class="kasir-table-wrap">
                        <table class="kasir-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                    @php $isLow = $stock->jumlah_stok <= 10; @endphp
                                    <tr>
                                        <td>{{ $stock->produk?->nama_produk ?? 'Produk dihapus' }}</td>
                                        <td>{{ number_format($stock->jumlah_stok) }}</td>
                                        <td><span class="kasir-status {{ $isLow ? 'danger' : '' }}">{{ $isLow ? 'Menipis' : 'Aman' }}</span></td>
                                        <td class="kasir-muted">{{ $stock->tanggal_update ?? '-' }}</td>
                                        <td>
                                            <div class="kasir-row-actions">
                                                <form method="POST" action="{{ route('kasir.stok.update', $stock) }}" style="display:flex;gap:.45rem;align-items:center;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input class="kasir-input" style="width:6.5rem;min-height:2.35rem;" type="number" min="0" name="jumlah_stok" value="{{ $stock->jumlah_stok }}" required>
                                                    <button type="submit" class="kasir-button secondary">Update</button>
                                                </form>

                                                <form method="POST" action="{{ route('kasir.stok.destroy', $stock) }}" onsubmit="return confirm('Hapus data stok ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="kasir-button danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="kasir-empty">Belum ada stok produk.</div>
                @endif
            </article>
        </div>
    </div>
</x-app-layout>
