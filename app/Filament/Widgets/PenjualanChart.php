<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;

class PenjualanChart extends ChartWidget
{
    protected ?string $heading = '📈 Grafik Penjualan Bulanan';

    protected ?string $description = 'Total pendapatan toko setiap bulan.';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $bulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
        ];

        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $total = Transaksi::whereMonth('tanggal_transaksi', $i)
                ->sum('total_bayar');

            $data[] = $total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan (Rp)',
                    'data' => $data,

                    'backgroundColor' => [
                                '#F59E0B',
                                '#D97706',
                                '#EF4444',
                                '#8B5CF6',
                                '#22C55E',
                                '#3B82F6',
                                '#06B6D4',
                    ],
                       
                    'borderColor' => [
                                '#F59E0B',
                                '#D97706',
                                '#EF4444',
                                '#8B5CF6',
                                '#22C55E',
                                '#3B82F6',
                                '#06B6D4',
                    ],

                    'borderWidth' => 2,
                    'borderRadius' => 8,
                    'borderSkipped' => false,

                    'barPercentage' => 0.95,
                    'categoryPercentage' => 0.95,
                    'maxBarThickness' => 55,
                ],
            ],

            'labels' => $bulan,
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
}