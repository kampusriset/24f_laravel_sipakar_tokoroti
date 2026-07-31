<?php

namespace App\Filament\Resources\StokProduks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_produk')
                    ->label('Produk')
                    ->relationship('produk', 'nama_produk')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('jumlah_stok')
                    ->label('Jumlah Stok')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                DateTimePicker::make('tanggal_update')
                    ->label('Tanggal Update')
                    ->required()
                    ->default(now()),

            ]);
    }
}