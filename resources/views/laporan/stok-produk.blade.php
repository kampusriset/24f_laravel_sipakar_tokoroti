<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Laporan Stok Produk</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
        }

        th{
            background:#eeeeee;
        }

    </style>

</head>

<body>

<h2>LAPORAN STOK PRODUK</h2>

<p>

Tanggal Cetak :
{{ now()->format('d-m-Y H:i') }}

</p>

<table>

<thead>

<tr>

<th>No</th>
<th>Nama Produk</th>
<th>Jumlah Stok</th>
<th>Tanggal Update</th>

</tr>

</thead>

<tbody>

@foreach($stokProduk as $stok)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $stok->produk->nama_produk ?? '-' }}</td>

<td>{{ $stok->jumlah_stok }}</td>

<td>{{ \Carbon\Carbon::parse($stok->tanggal_update)->format('d-m-Y H:i') }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>