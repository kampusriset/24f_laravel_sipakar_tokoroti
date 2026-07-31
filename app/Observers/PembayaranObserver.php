<?php

namespace App\Observers;

use App\Models\Pembayaran;
use App\Models\StokProduk;
use Illuminate\Support\Facades\DB;

class PembayaranObserver
{
    
    public function created(Pembayaran $pembayaran): void
    {
        $transaksi = $pembayaran->transaksi;

        if (! $transaksi) {
        return;
        }

        // ubah status transaksi
        $transaksi->status_transaksi = 'Selesai';
        $transaksi->save();

        foreach ($transaksi->detailTransaksi as $detail) {

            $stok = StokProduk::where(
                'id_produk',
                $detail->id_produk
            )->first();

            if ($stok) {

                $stok->jumlah_stok = max(
                    0,
                    $stok->jumlah_stok - $detail->jumlah
                );

                $stok->tanggal_update = now();

                $stok->save();
            }
        }
    }
}
