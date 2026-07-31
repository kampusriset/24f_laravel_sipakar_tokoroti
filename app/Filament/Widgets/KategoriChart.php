<?php

namespace App\Filament\Widgets;

use App\Models\KategoriProduk;
use Filament\Widgets\ChartWidget;

class KategoriChart extends ChartWidget
{
    protected ?string $heading = '🥧 Distribusi Produk Berdasarkan Kategori';

    protected ?string $description = 'Persentase jumlah produk pada setiap kategori.';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $kategori = KategoriProduk::withCount('produk')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',

                    'data' => $kategori->pluck('produk_count')->toArray(),

                    'backgroundColor' => [
                        '#F59E0B', // Amber
                        '#3B82F6', // Blue
                        '#22C55E', // Green
                        '#EF4444', // Red
                        '#8B5CF6', // Purple
                        '#EC4899', // Pink
                        '#06B6D4', // Cyan
                    ],

                    'borderColor' => '#ffffff',

                    'borderWidth' => 2,

                    'hoverOffset' => 15,
                ],
            ],

            'labels' => $kategori->pluck('nama_kategori')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [

            'maintainAspectRatio' => false,

            'plugins' => [

                'legend' => [

                    'position' => 'bottom',

                    'labels' => [
                        'padding' => 20,
                        'boxWidth' => 15,
                        'font' => [
                            'size' => 12,
                        ],
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