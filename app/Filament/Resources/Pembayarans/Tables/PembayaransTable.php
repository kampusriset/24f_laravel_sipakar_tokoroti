<?php

namespace App\Filament\Resources\Pembayarans\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('transaksi.id_transaksi')
                    ->label('Transaksi'),

                TextColumn::make('metode_pembayaran')
                    ->badge(),

                TextColumn::make('jumlah_dibayar')
                    ->money('IDR'),

                TextColumn::make('jumlah_kembalian')
                    ->money('IDR'),

                TextColumn::make('tanggal_pembayaran')
                    ->dateTime(),

            ])
            ->recordActions([
                EditAction::make()
                    ->visible(false),
            ])
            ->toolbarActions([]);
    }
}