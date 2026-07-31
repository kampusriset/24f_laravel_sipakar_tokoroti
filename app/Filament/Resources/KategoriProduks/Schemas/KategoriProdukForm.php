<?php

namespace App\Filament\Resources\KategoriProduks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KategoriProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->placeholder('Contoh: Roti Manis')
                    ->required()
                    ->maxLength(100),

                Textarea::make('deskripsi_kategori')
                    ->label('Deskripsi')
                    ->placeholder('Masukkan deskripsi kategori...')
                    ->rows(4)
                    ->maxLength(255)
                    ->columnSpanFull(),

            ]);
    }
}