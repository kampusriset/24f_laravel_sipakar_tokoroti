<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(150),

                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('harga_jual')
                    ->label('Harga Jual')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(0)
                    ->step(100),

                Select::make('tingkat_manis')
                    ->label('Tingkat Manis')
                    ->options([
                        1 => '1 - Sangat Rendah',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5 - Sedang',
                        6 => '6',
                        7 => '7',
                        8 => '8',
                        9 => '9',
                        10 => '10 - Sangat Manis',
                    ])
                    ->required(),

                Select::make('alergi')
                    ->label('Alergi')
                    ->options([
                        'Tidak Ada' => 'Tidak Ada',
                        'Gluten' => 'Gluten',
                        'Susu' => 'Susu',
                        'Kacang' => 'Kacang',
                        'Telur' => 'Telur',
                    ])
                    ->searchable()
                    ->required(),

                Select::make('keperluan')
                    ->label('Keperluan')
                    ->options([
                        'Sarapan' => 'Sarapan',
                        'Cemilan' => 'Cemilan',
                        'Oleh-oleh' => 'Oleh-oleh',
                        'Hadiah' => 'Hadiah',
                        'Acara' => 'Acara',
                    ])
                    ->searchable()
                    ->required(),

                FileUpload::make('gambar')
                    ->label('Foto Produk')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->directory('produk')
                    ->disk('public'),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(500)
                    ->columnSpanFull(),

            ]);
    }
}