<?php

namespace App\Filament\Resources\StokProduks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StokProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('produk.nama_produk')
                    ->label('Produk')
                    ->searchable(),

                TextColumn::make('jumlah_stok')
                    ->sortable(),

                TextColumn::make('tanggal_update')
                    ->dateTime(),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([


                Action::make('exportExcel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-chart-bar')
                    ->color('success')
                    ->url(route('export.stok.excel'))
                    ->openUrlInNewTab(),


                Action::make('exportPdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-text')
                    ->color('danger')
                    ->url(route('export.stok.pdf'))
                    ->openUrlInNewTab(),



                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}