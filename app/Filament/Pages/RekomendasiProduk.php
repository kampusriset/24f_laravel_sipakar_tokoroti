<?php

namespace App\Filament\Pages;

use App\Models\Produk;
use App\Services\FuzzyTsukamotoService;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class RekomendasiProduk extends Page
{
    protected string $view = 'filament.pages.rekomendasi-produk';

    protected static ?string $navigationLabel = 'AI Rekomendasi';

    protected static ?string $title = 'AI Rekomendasi Produk';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static string|\UnitEnum|null $navigationGroup = 'Artificial Intelligence';

    public ?array $data = [];

    public array $hasil = [];

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->statePath('data')
            ->components([

                TextInput::make('budget')
                    ->label('Budget')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('tingkat_manis')
                    ->label('Tingkat Manis')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7',
                        8 => '8',
                        9 => '9',
                        10 => '10',
                    ])
                    ->required(),

                Select::make('alergi')
                    ->label('Alergi')
                    ->options([
                        'Tidak Ada' => 'Tidak Ada',
                        'Gluten' => 'Gluten',
                        'Susu' => 'Susu',
                        'Telur' => 'Telur',
                    ])
                    ->required(),

                Select::make('keperluan')
                    ->label('Keperluan')
                    ->options([
                        'Sarapan' => 'Sarapan',
                        'Cemilan' => 'Cemilan',
                        'Oleh-oleh' => 'Oleh-oleh',
                        'Hadiah' => 'Hadiah',
                    ])
                    ->required(),

            ]);
    }

    public function cariRekomendasi(): void
    {
        $service = new FuzzyTsukamotoService();

        $ranking = $service->proses(
            (float) $this->data['budget'],
            (int) $this->data['tingkat_manis'],
            $this->data['alergi'],
            $this->data['keperluan']
        );

        $this->hasil = [];

        foreach ($ranking as $item) {

            $produk = Produk::where('nama_produk', $item['produk'])->first();

            $this->hasil[] = [
                'produk'     => $item['produk'],
                'nilai'      => $item['nilai'],
                'harga'      => $produk?->harga_jual,
                'gambar'     => $produk?->gambar,
                'deskripsi'  => $produk?->deskripsi,
            ];
        }
    }
}