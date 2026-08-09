<x-app-layout>
    @include('kasir.partials.styles')

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Inventori</p>
                    <h1 class="kasir-title">CRUD Produk</h1>
                    <p class="kasir-subtitle">Tambah, ubah, dan hapus produk langsung dari halaman kasir.</p>
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
                    <h2 class="kasir-card-title">Tambah Produk</h2>
                    <span class="kasir-pill">{{ $categories->count() }} kategori</span>
                </div>

                <form method="POST" action="{{ route('kasir.produk.store') }}" class="kasir-form">
                    @csrf
                    <div class="kasir-form-grid">
                        <div class="kasir-field span-2">
                            <label for="nama_produk">Nama Produk</label>
                            <input id="nama_produk" class="kasir-input" name="nama_produk" value="{{ old('nama_produk') }}" required>
                        </div>

                        <div class="kasir-field">
                            <label for="id_kategori">Kategori</label>
                            <select id="id_kategori" class="kasir-select" name="id_kategori" required>
                                <option value="">Pilih kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_kategori }}" @selected(old('id_kategori') == $category->id_kategori)>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="kasir-field">
                            <label for="harga_jual">Harga</label>
                            <input id="harga_jual" class="kasir-input" type="number" min="0" step="100" name="harga_jual" value="{{ old('harga_jual') }}" required>
                        </div>

                        <div class="kasir-field">
                            <label for="jumlah_stok">Stok Awal</label>
                            <input id="jumlah_stok" class="kasir-input" type="number" min="0" name="jumlah_stok" value="{{ old('jumlah_stok', 0) }}">
                        </div>

                        <div class="kasir-field">
                            <label for="tingkat_manis">Tingkat Manis</label>
                            <select id="tingkat_manis" class="kasir-select" name="tingkat_manis" required>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" @selected(old('tingkat_manis', 5) == $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="kasir-field">
                            <label for="alergi">Alergi</label>
                            <select id="alergi" class="kasir-select" name="alergi" required>
                                @foreach(['Tidak Ada', 'Gluten', 'Susu', 'Kacang', 'Telur'] as $option)
                                    <option value="{{ $option }}" @selected(old('alergi', 'Tidak Ada') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="kasir-field">
                            <label for="keperluan">Keperluan</label>
                            <select id="keperluan" class="kasir-select" name="keperluan" required>
                                @foreach(['Sarapan', 'Cemilan', 'Oleh-oleh', 'Hadiah', 'Acara'] as $option)
                                    <option value="{{ $option }}" @selected(old('keperluan', 'Sarapan') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="kasir-field">
                            <label for="gambar">Link Gambar</label>
                            <input id="gambar" class="kasir-input" name="gambar" value="{{ old('gambar') }}" placeholder="https://...">
                        </div>

                        <div class="kasir-field full">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" class="kasir-textarea" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    <div class="kasir-form-actions">
                        <button type="submit" class="kasir-button">Simpan Produk</button>
                    </div>
                </form>
            </article>

            @if($products->isNotEmpty())
                <div class="kasir-grid">
                    @foreach($products as $product)
                        <article class="kasir-product">
                            <div style="display:flex;justify-content:space-between;gap:.75rem;">
                                <span class="kasir-product-mark">{{ strtoupper(substr($product->nama_produk, 0, 1)) }}</span>
                                <span class="kasir-status {{ ($product->stok?->jumlah_stok ?? 0) <= 10 ? 'danger' : '' }}">Stok {{ $product->stok?->jumlah_stok ?? 0 }}</span>
                            </div>
                            <h2 class="kasir-product-name">{{ $product->nama_produk }}</h2>
                            <p class="kasir-muted">{{ $product->kategori?->nama_kategori ?? 'Tanpa kategori' }}</p>
                            <strong class="kasir-product-price">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</strong>

                            <div class="kasir-row-actions">
                                <details style="width:100%;">
                                    <summary class="kasir-button secondary" style="list-style:none;">Edit</summary>
                                    <form method="POST" action="{{ route('kasir.produk.update', $product) }}" class="kasir-inline-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="kasir-form-grid" style="grid-template-columns:1fr;">
                                            <div class="kasir-field">
                                                <label>Nama Produk</label>
                                                <input class="kasir-input" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Kategori</label>
                                                <select class="kasir-select" name="id_kategori" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id_kategori }}" @selected(old('id_kategori', $product->id_kategori) == $category->id_kategori)>{{ $category->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Harga</label>
                                                <input class="kasir-input" type="number" min="0" step="100" name="harga_jual" value="{{ old('harga_jual', $product->harga_jual) }}" required>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Tingkat Manis</label>
                                                <select class="kasir-select" name="tingkat_manis" required>
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" @selected(old('tingkat_manis', $product->tingkat_manis) == $i)>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Alergi</label>
                                                <select class="kasir-select" name="alergi" required>
                                                    @foreach(['Tidak Ada', 'Gluten', 'Susu', 'Kacang', 'Telur'] as $option)
                                                        <option value="{{ $option }}" @selected(old('alergi', $product->alergi) === $option)>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Keperluan</label>
                                                <select class="kasir-select" name="keperluan" required>
                                                    @foreach(['Sarapan', 'Cemilan', 'Oleh-oleh', 'Hadiah', 'Acara'] as $option)
                                                        <option value="{{ $option }}" @selected(old('keperluan', $product->keperluan) === $option)>{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="kasir-field">
                                                <label>Link Gambar</label>
                                                <input class="kasir-input" name="gambar" value="{{ old('gambar', $product->gambar) }}">
                                            </div>
                                            <div class="kasir-field">
                                                <label>Deskripsi</label>
                                                <textarea class="kasir-textarea" name="deskripsi">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="kasir-form-actions" style="margin-top:.75rem;">
                                            <button type="submit" class="kasir-button">Update</button>
                                        </div>
                                    </form>
                                </details>

                                <form method="POST" action="{{ route('kasir.produk.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="kasir-button danger">Hapus</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="kasir-card"><div class="kasir-empty">Belum ada produk.</div></div>
            @endif
        </div>
    </div>
</x-app-layout>
