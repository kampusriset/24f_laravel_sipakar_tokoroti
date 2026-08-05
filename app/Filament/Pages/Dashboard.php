<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\KategoriChart;
use App\Filament\Widgets\PenjualanChart;
use App\Filament\Widgets\TopProdukTerlarisChart;
use App\Filament\Widgets\TrendPendapatanChart;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard Floure Bakery';

    // HAPUS baris ini karena menyebabkan error:
    // protected static string $view = 'filament.pages.dashboard';

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

    // Method untuk mendapatkan nama user yang login
    public function getUserName(): string
    {
        $user = Auth::user();
        
        if (!$user) {
            return 'Admin';
        }

        // Coba ambil nama dari berbagai field yang mungkin ada
        $name = $user->name ?? $user->username ?? $user->email ?? 'Admin';
        
        return $name;
    }

    // Method untuk mendapatkan avatar user (opsional)
    public function getUserAvatar(): ?string
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }

        // Jika ada field avatar_url atau photo
        return $user->avatar_url ?? $user->photo ?? null;
    }
}