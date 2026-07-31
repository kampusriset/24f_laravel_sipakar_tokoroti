<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class TrendPendapatanChart extends ChartWidget
{
    protected ?string $heading = '📈 Tren Pendapatan Bulanan';

    protected ?string $description = 'Pergerakan pendapatan toko setiap bulan.';

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $bulan = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ];

        $pendapatan = [];

        for ($i = 1; $i <= 12; $i++) {

            $pendapatan[] = Transaksi::whereMonth(
                'tanggal_transaksi',
                $i
            )->sum('total_bayar');
        }

        return [

            'datasets' => [

                [

                    'label' => 'Pendapatan',

                    'data' => $pendapatan,

                    'borderColor' => '#F59E0B',

                    'backgroundColor' => 'rgba(245,158,11,0.2)',

                    'fill' => true,

                    'tension' => 0.35,

                    'pointRadius' => 5,

                    'pointHoverRadius' => 7,

                ],

            ],

            'labels' => $bulan,

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [

            'maintainAspectRatio' => false,

            'plugins' => [

                'legend' => [
                    'display' => false,
                ],

            ],

            'scales' => [

                'y' => [

                    'beginAtZero' => true,

                    'grid' => [

                        'color' => 'rgba(156,163,175,0.15)',

                    ],

                ],

                'x' => [

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

    protected int|string|array $columnSpan = 1;
}