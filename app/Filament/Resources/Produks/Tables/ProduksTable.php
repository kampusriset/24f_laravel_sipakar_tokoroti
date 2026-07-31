<?php

namespace App\Filament\Resources\Produks\Tables;

use App\Models\KategoriProduk;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id_produk')
                    ->label('ID')
                    ->sortable(),

                ImageColumn::make('gambar')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('harga_jual')
                    ->label('Harga')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(40),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori'),

                Filter::make('harga')
                    ->label('Harga')
                    ->form([
                        Select::make('range')
                            ->label('Rentang Harga')
                            ->options([
                                'murah' => '≤ Rp20.000',
                                'sedang' => 'Rp20.001 - Rp40.000',
                                'mahal' => '> Rp40.000',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {

                        return match ($data['range'] ?? null) {

                            'murah' =>
                                $query->where('harga_jual', '<=', 20000),

                            'sedang' =>
                                $query->whereBetween('harga_jual', [20001, 40000]),

                            'mahal' =>
                                $query->where('harga_jual', '>', 40000),

                            default => $query,

                        };
                    }),

            ])

            ->recordActions([
                EditAction::make()
                    ->visible(fn () => Auth::user()?->role === 'admin'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn () => Auth::user()?->role === 'admin'),
                ]),
            ]);
    }
}