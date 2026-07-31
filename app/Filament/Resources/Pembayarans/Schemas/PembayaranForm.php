<?php

namespace App\Filament\Resources\Pembayarans\Schemas;

use App\Models\Transaksi;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('id_transaksi')
                    ->label('Transaksi')
                    ->relationship('transaksi', 'id_transaksi')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {

                         $transaksi = Transaksi::find($state);

                         if ($transaksi) {

                            $set('jumlah_dibayar', $transaksi->total_bayar);

                         }

                    }),

                Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'QRIS' => 'QRIS',
                        'Debit' => 'Debit',
                        'Transfer' => 'Transfer',
                    ])
                    ->required(),

                TextInput::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($get, $state, callable $set) {

                        $transaksi = Transaksi::find($get('id_transaksi'));

                        if ($transaksi) {

                            $set(
                                'jumlah_kembalian',
                                max(0, $state - $transaksi->total_bayar)
                            );

                        }
                    }),

                TextInput::make('jumlah_kembalian')
                    ->label('Jumlah Kembalian')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(),

                DateTimePicker::make('tanggal_pembayaran')
                    ->label('Tanggal Pembayaran')
                    ->required()
                    ->default(now()),

            ]);
    }
}