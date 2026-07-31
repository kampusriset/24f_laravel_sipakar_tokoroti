<?php

namespace App\Filament\Resources\DetailTransaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DetailTransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('transaksi.id_transaksi')
                    ->label('Transaksi'),

                TextColumn::make('produk.nama_produk')
                    ->label('Produk'),

                TextColumn::make('jumlah'),

                TextColumn::make('harga_satuan')
                    ->money('IDR'),

                TextColumn::make('subtotal')
                    ->money('IDR'),

            ])
            ->recordActions([
                EditAction::make()
                ->visible(fn ($record) => $record->transaksi?->status_transaksi === 'Pending'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->visible(fn () => false),
                ]),
            ]);
    }
}