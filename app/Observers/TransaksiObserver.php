<?php

namespace App\Observers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiObserver
{
    /**
     * Handle the Transaksi "creating" event.
     */
    public function creating(Transaksi $transaksi): void
    {
        if (Auth::check()) {
            $transaksi->id_pegawai = Auth::id();
        }
    }
}
