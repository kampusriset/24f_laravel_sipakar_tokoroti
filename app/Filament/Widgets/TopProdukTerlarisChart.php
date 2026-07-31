<?php

namespace App\Filament\Widgets;

use App\Models\DetailTransaksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopProdukTerlarisChart extends ChartWidget
{
    protected ?string $heading = '🏆 Top 5 Produk Terlaris';

    protected ?string $description = 'Produk yang paling banyak terjual berdasarkan jumlah transaksi.';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = DetailTransaksi::select(
                'id_produk',
                DB::raw('SUM(jumlah) as total')
            )
            ->with('produk')
            ->groupBy('id_produk')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual',

                    'data' => $data->pluck('total')->toArray(),

                    'backgroundColor' => [
                        '#F59E0B',
                        '#10B981',
                        '#3B82F6',
                        '#EF4444',
                        '#8B5CF6',
                    ],

                    'borderColor' => [
                        '#D97706',
                        '#059669',
                        '#2563EB',
                        '#DC2626',
                        '#7C3AED',
                    ],

                    'borderWidth' => 2,

                    'borderRadius' => 8,

                    'borderSkipped' => false,

                    'barThickness' => 35,
                ],
            ],

            'labels' => $data->map(fn ($item) => $item->produk->nama_produk)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [

            'maintainAspectRatio' => false,

            'indexAxis' => 'y',

            'plugins' => [

                'legend' => [
                    'display' => false,
                ],

            ],

            'scales' => [

                'x' => [

                    'beginAtZero' => true,

                    'grid' => [
                        'color' => 'rgba(156,163,175,0.15)',
                    ],

                ],

                'y' => [

                    'grid' => [
                        'display' => false,
                    ],

                ],

            ],

            'animation' => [
                'duration' => 1200,
            ],

        ];
    }

    protected function getMaxHeight(): ?string
    {
        return '360px';
    }
}