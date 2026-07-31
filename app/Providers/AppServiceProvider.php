<?php

namespace App\Providers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use App\Observers\TransaksiObserver;
use App\Observers\DetailTransaksiObserver;
use App\Observers\PembayaranObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Transaksi::observe(TransaksiObserver::class);
        Pembayaran::observe(PembayaranObserver::class);
        DetailTransaksi::observe(DetailTransaksiObserver::class);
    }
}
