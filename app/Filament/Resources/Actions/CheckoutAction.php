<?php

namespace App\Filament\Actions;

use App\Models\Pembayaran;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class CheckoutAction
{
    public static function make(): Action
    {
        return Action::make('checkout')
            ->label('Checkout')
            ->icon('heroicon-o-shopping-cart')
            ->color('success')

            ->modalHeading('Checkout')

            ->modalSubmitActionLabel('Bayar')

            ->form([

                Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'QRIS' => 'QRIS',
                        'Debit' => 'Debit',
                        'Transfer' => 'Transfer',
                    ])
                    ->required(),

                TextInput::make('total_bayar')
                    ->label('Total Belanja')
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(false)
                    ->default(fn ($record) => $record->total_bayar),

                TextInput::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set, $record) {

                        $set(
                            'jumlah_kembalian',
                            max(0, $state - $record->total_bayar)
                        );
                    }),

                TextInput::make('jumlah_kembalian')
                    ->label('Kembalian')
                     ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(),

            ])

            ->action(function (array $data, $record) {

                if ($data['jumlah_dibayar'] < $record->total_bayar) {

                    Notification::make()
                        ->title('Pembayaran gagal')
                        ->body('Jumlah pembayaran kurang dari total belanja.')
                        ->danger()
                        ->send();

                    return;
                }

                Pembayaran::create([

                    'id_transaksi' => $record->id_transaksi,

                    'metode_pembayaran' => $data['metode_pembayaran'],

                    'jumlah_dibayar' => $data['jumlah_dibayar'],

                    'jumlah_kembalian' =>
                        max(0, $data['jumlah_dibayar'] - $record->total_bayar),

                    'tanggal_pembayaran' => now(),

                ]);

                Notification::make()
                    ->title('Pembayaran berhasil')
                    ->success()
                    ->send();

            });
    }
}