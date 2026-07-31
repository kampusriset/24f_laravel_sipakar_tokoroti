<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\KategoriChart;
use App\Filament\Widgets\PenjualanChart;
use App\Filament\Widgets\TopProdukTerlarisChart;
use App\Filament\Widgets\TrendPendapatanChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard Floure Bakery';
    
    public function getWidgets(): array
    {
        return [
            DashboardStats::class,

            TopProdukTerlarisChart::class,
            KategoriChart::class,
            
            PenjualanChart::class,
            TrendPendapatanChart::class,
        ];
    }
}