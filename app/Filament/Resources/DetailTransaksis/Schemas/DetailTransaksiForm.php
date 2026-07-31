<?php

namespace App\Filament\Resources\DetailTransaksis\Schemas;

use App\Models\Produk;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;

class DetailTransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_transaksi')
                    ->label('Transaksi')
                    ->relationship('transaksi','id_transaksi')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('id_produk')
                    ->label('Produk')
                    ->relationship('produk','nama_produk')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function (callable $set, callable $get, $state) {

                        $produk = Produk::find($state);

                        if ($produk) {

                           $set('harga_satuan', $produk->harga_jual);

                           $jumlah = $get('jumlah') ?? 0;
                           
                           $set('subtotal', $produk->harga_jual * $jumlah);

                        }
                    }),

                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->default(1)
                    ->live()
                    ->afterStateUpdated(function (callable $set, callable $get, $state) {

                        $harga = $get('harga_satuan') ?? 0;

                        $set('subtotal', $harga * $state);
                    }),

                TextInput::make('harga_satuan')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated()
                    ->default(0),

                TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated()
                    ->default(0),

            ]);
    }
}