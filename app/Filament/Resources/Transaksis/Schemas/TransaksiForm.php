<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                DateTimePicker::make('tanggal_transaksi')
                    ->label('Tanggal Transaksi')
                    ->required()
                    ->default(now()),

                Select::make('id_pegawai')
                    ->label('Kasir')
                    ->relationship('pegawai', 'nama_pegawai')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('status_transaksi')
                    ->label('Status Transaksi')
                    ->options([
                        'Pending' => 'Pending',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->required()
                    ->default('Pending'),

            ]);
    }
}