<?php

namespace App\Filament\Resources\Pembayarans\Tables;

use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PembayaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('transaksi.id_transaksi')
                    ->label('ID Transaksi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('metode_pembayaran')
                    ->label('Metode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Cash' => 'success',
                        'QRIS' => 'info',
                        'Transfer' => 'warning',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->money('IDR')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('jumlah_kembalian')
                    ->label('Kembalian')
                    ->money('IDR')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('tanggal_pembayaran')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Cash' => 'Cash',
                        'QRIS' => 'QRIS',
                        'Transfer' => 'Transfer',
                    ]),

                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('dari')
                            ->label('Dari'),

                        DatePicker::make('sampai')
                            ->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {

                        return $query
                            ->when(
                                $data['dari'],
                                fn (Builder $query, $date) =>
                                    $query->whereDate('tanggal_pembayaran', '>=', $date),
                            )
                            ->when(
                                $data['sampai'],
                                fn (Builder $query, $date) =>
                                    $query->whereDate('tanggal_pembayaran', '<=', $date),
                            );

                    }),

            ])

            ->recordActions([
                EditAction::make()
                    ->visible(false),
            ])

            ->toolbarActions([]);
    }
}