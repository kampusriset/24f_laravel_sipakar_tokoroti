<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalProduk = Produk::count();

        $totalTransaksi = Transaksi::count();

        $totalPendapatan = Transaksi::sum('total_bayar');

        $stokMenipis = StokProduk::where('jumlah_stok', '<=', 10)->count();

        return [

            Stat::make('📦 Total Produk', $totalProduk . ' Produk')
                ->description('Jumlah seluruh produk yang tersedia')
                ->color('success'),

            Stat::make('🛒 Total Transaksi', $totalTransaksi . ' Transaksi')
                ->description('Transaksi yang telah tercatat')
                ->color('primary'),

            Stat::make(
                '💰 Total Pendapatan',
                'Rp ' . number_format($totalPendapatan, 0, ',', '.')
            )
                ->description('Akumulasi pendapatan toko')
                ->color('warning'),

            Stat::make('⚠️ Stok Menipis', $stokMenipis . ' Produk')
                ->description('Produk dengan stok ≤ 10')
                ->color('danger'),

        ];
    }
}
