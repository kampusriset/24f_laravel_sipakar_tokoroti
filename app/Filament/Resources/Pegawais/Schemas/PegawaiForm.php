<?php

namespace App\Filament\Resources\Pegawais\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PegawaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nama_pegawai')
                    ->label('Nama Pegawai')
                    ->required()
                    ->maxLength(100),

                Select::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'Admin' => 'Admin',
                        'Kasir' => 'Kasir',
                    ])
                    ->required(),

                TextInput::make('no_telepon')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->minLength(10)
                    ->maxLength(15),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(4)
                    ->maxLength(255)
                    ->columnSpanFull(),

            ]);
    }
}