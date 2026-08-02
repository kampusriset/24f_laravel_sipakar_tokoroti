<?php

namespace App\Filament\Resources\Transaksis\Tables;

use App\Filament\Resources\Actions\CheckoutAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id_transaksi')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('pegawai.nama_pegawai')
                    ->label('Kasir')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_bayar')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('status_transaksi')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Selesai' => 'success',
                        'Batal' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('status_transaksi')
                    ->label('Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Selesai' => 'Selesai',
                        'Batal' => 'Batal',
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
                                    $query->whereDate('tanggal_transaksi', '>=', $date),
                            )
                            ->when(
                                $data['sampai'],
                                fn (Builder $query, $date) =>
                                    $query->whereDate('tanggal_transaksi', '<=', $date),
                            );

                    }),

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