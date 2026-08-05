<?php

namespace App\Filament\Resources\BahanBakus\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BahanBakusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_bahan')
                    ->searchable(),
                TextColumn::make('satuan')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('stok_saat_ini')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn ($record): string => 
                        $record->stok_saat_ini <= $record->stok_minimum 
                            ? 'danger' 
                            : 'success'
                    ),
                TextColumn::make('stok_minimum')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga_per_satuan')
                    ->numeric()
                    ->sortable()
                    ->money('IDR'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}