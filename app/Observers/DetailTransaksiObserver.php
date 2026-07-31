<?php

namespace App\Observers;

use App\Models\DetailTransaksi;

class DetailTransaksiObserver
{
    /**
     * Menghitung ulang total transaksi.
     */
    private function updateTotal(DetailTransaksi $detailTransaksi): void
    {
        $transaksi = $detailTransaksi->transaksi;

        if (!$transaksi) {
            return;
        }

        $total = $transaksi->detailTransaksi()->sum('subtotal');

        $transaksi->update([
            'total_bayar' => $total,
        ]);
    }

    /**
     * Setelah detail dibuat.
     */
    public function created(DetailTransaksi $detailTransaksi): void
    {
        $this->updateTotal($detailTransaksi);
    }

    /**
     * Setelah detail diubah.
     */
    public function updated(DetailTransaksi $detailTransaksi): void
    {
        $this->updateTotal($detailTransaksi);
    }

    /**
     * Setelah detail dihapus.
     */
    public function deleted(DetailTransaksi $detailTransaksi): void
    {
        $this->updateTotal($detailTransaksi);
    }

    public function restored(DetailTransaksi $detailTransaksi): void
    {
        $this->updateTotal($detailTransaksi);
    }

    public function forceDeleted(DetailTransaksi $detailTransaksi): void
    {
        $this->updateTotal($detailTransaksi);
    }
}