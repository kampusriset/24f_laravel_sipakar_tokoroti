<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Action;
use App\Filament\Actions\CheckoutAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('tanggal_transaksi')
                    ->dateTime(),

                TextColumn::make('pegawai.nama_pegawai')
                    ->label('Kasir')
                    ->searchable(),

                TextColumn::make('total_bayar')
                    ->money('IDR'),

                TextColumn::make('status_transaksi')
                    ->badge(),

            ])
            ->recordActions([
                EditAction::make()
                ->visible(fn ($record) => $record->status_transaksi === 'Pending'),

                CheckoutAction::make()
                ->visible(fn ($record) => $record->status_transaksi === 'Pending'),
            ])
            ->toolbarActions([


                Action::make('exportExcel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-chart-bar')
                    ->color('success')
                    ->url(route('export.transaksi.excel'))
                    ->openUrlInNewTab(),


                Action::make('exportPdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-text')
                    ->color('danger')
                    ->url(route('export.transaksi.pdf'))
                    ->openUrlInNewTab(),

                    
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->visible(fn () => false),
                ]),
            ]);
    }
}