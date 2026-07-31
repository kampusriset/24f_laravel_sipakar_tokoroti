<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>

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

        .total{
            margin-top:20px;
            text-align:right;
            font-weight:bold;
        }

    </style>

</head>

<body>

<h2>LAPORAN PENJUALAN</h2>

<p>
Tanggal Cetak :
{{ now()->format('d-m-Y H:i') }}
</p>

<table>

<thead>

<tr>

<th>No</th>
<th>Tanggal</th>
<th>Kasir</th>
<th>Total</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($transaksi as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>

<td>{{ $item->pegawai->nama_pegawai ?? '-' }}</td>

<td>Rp {{ number_format($item->total_bayar,0,',','.') }}</td>

<td>{{ $item->status_transaksi }}</td>

</tr>

@endforeach

</tbody>

</table>

<div class="total">

Total Pendapatan :

Rp {{ number_format($totalPendapatan,0,',','.') }}

</div>

</body>

</html>