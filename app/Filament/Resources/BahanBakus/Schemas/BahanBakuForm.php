<?php

namespace App\Filament\Resources\BahanBakus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BahanBakuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->required()
                    ->maxLength(100),

                TextInput::make('satuan')
                    ->label('Satuan')
                    ->required()
                    ->maxLength(30),

                TextInput::make('stok_saat_ini')
                    ->label('Stok Saat Ini')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('stok_minimum')
                    ->label('Stok Minimum')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                TextInput::make('harga_per_satuan')
                    ->label('Harga per Satuan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->minValue(1),

            ]);
    }
}