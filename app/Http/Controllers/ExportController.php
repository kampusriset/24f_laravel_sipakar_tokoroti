<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Exports\StokProdukExport;
use App\Models\StokProduk;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function excel()
    {
        return Excel::download(
            new TransaksiExport,
            'laporan-penjualan.xlsx'
        );
    }

    public function pdf()
    {
        $transaksi = Transaksi::with('pegawai')
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        $totalPendapatan = $transaksi->sum('total_bayar');

        $pdf = Pdf::loadView('laporan.penjualan', [
            'transaksi' => $transaksi,
            'totalPendapatan' => $totalPendapatan,
        ]);

        return $pdf->download('laporan-penjualan.pdf');
    }

    public function stokExcel()
    {
        return Excel::download(
            new StokProdukExport,
            'laporan-stok-produk.xlsx'
        );
    }

    public function stokPdf()
    {
        $stokProduk = StokProduk::with('produk')
            ->orderBy('id_produk')
            ->get();

        $pdf = Pdf::loadView('laporan.stok-produk', [
            'stokProduk' => $stokProduk,
        ]);

        return $pdf->download('laporan-stok-produk.pdf');
    }
}