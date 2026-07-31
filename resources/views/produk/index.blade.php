<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
    <h1>Data Produk Toko Roti</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Stok</th>
        </tr>
        @forelse($produks as $p)
        <tr>
            <td>{{ $p->id_produk }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>{{ $p->kategori->nama_kategori ?? '-' }}</td> {{-- ambil dari relasi --}}
            <td>Rp {{ number_format($p->harga_jual) }}</td>
            <td>{{ $p->stok->jumlah_stok ?? 0 }}</td> {{-- ambil dari relasi --}}
        </tr>
        @empty
        <tr><td colspan="5">Data produk kosong</td></tr>
        @endforelse
    </table>
</body>
</html>