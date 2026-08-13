<?php

namespace App\Filament\Resources\Actions;

use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use App\Models\Produk;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class CheckoutAction
{
    public static function make(): Action
    {
        return Action::make('checkout')
            ->label('Checkout')
            ->icon('heroicon-o-shopping-cart')
            ->color('success')

            ->modalHeading(
                fn ($record) =>
                    'Checkout Transaksi #' . $record->id_transaksi
            )

            ->modalSubmitActionLabel('Bayar')

            ->form([

                /*
                |--------------------------------------------------------------------------
                | DAFTAR PRODUK
                |--------------------------------------------------------------------------
                */

                Repeater::make('items')
                    ->label('Daftar Produk')
                    ->live()
                    ->schema([

                        /*
                        |--------------------------------------------------------------------------
                        | PRODUK
                        |--------------------------------------------------------------------------
                        */

                        Select::make('id_produk')
                            ->label('Produk')
                            ->options(function () {
                                return Produk::query()
                                    ->orderBy('nama_produk')
                                    ->pluck(
                                        'nama_produk',
                                        'id_produk'
                                    );
                            })
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required()
                            ->afterStateUpdated(function (
                                Get $get,
                                callable $set,
                                $state
                            ) {

                                if (!$state) {
                                    $set('harga_satuan', 0);
                                    $set('subtotal', 0);
                                    return;
                                }

                                $produk = Produk::find($state);

                                if (!$produk) {
                                    return;
                                }

                                $jumlah = (int) (
                                    $get('jumlah') ?? 1
                                );

                                $harga = (float) $produk->harga_jual;

                                $set(
                                    'harga_satuan',
                                    $harga
                                );

                                $set(
                                    'subtotal',
                                    $harga * $jumlah
                                );
                            }),

                        /*
                        |--------------------------------------------------------------------------
                        | JUMLAH
                        |--------------------------------------------------------------------------
                        */

                        TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->live()
                            ->required()
                            ->afterStateUpdated(function (
                                Get $get,
                                callable $set,
                                $state
                            ) {

                                $harga = (float) (
                                    $get('harga_satuan') ?? 0
                                );

                                $jumlah = (int) (
                                    $state ?? 0
                                );

                                $set(
                                    'subtotal',
                                    $harga * $jumlah
                                );
                            }),

                        /*
                        |--------------------------------------------------------------------------
                        | HARGA SATUAN
                        |--------------------------------------------------------------------------
                        */

                        TextInput::make('harga_satuan')
                            ->label('Harga Satuan')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->default(0),

                        /*
                        |--------------------------------------------------------------------------
                        | SUBTOTAL
                        |--------------------------------------------------------------------------
                        */

                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated()
                            ->default(0),

                    ])
                    ->columns(4)
                    ->defaultItems(1)
                    ->addActionLabel('Tambah Produk')
                    ->reorderable(false)
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | TOTAL BELANJA
                |--------------------------------------------------------------------------
                */

                Placeholder::make('total_belanja')
                    ->label('Total Belanja')
                    ->content(function (Get $get) {

                        $total = self::calculateTotal(
                            $get('items') ?? []
                        );

                        return 'Rp ' . number_format(
                            $total,
                            0,
                            ',',
                            '.'
                        );
                    }),

                /*
                |--------------------------------------------------------------------------
                | METODE PEMBAYARAN
                |--------------------------------------------------------------------------
                */

                Select::make('metode_pembayaran')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'QRIS' => 'QRIS',
                        'Debit' => 'Debit',
                        'Transfer' => 'Transfer',
                    ])
                    ->required(),

                /*
                |--------------------------------------------------------------------------
                | JUMLAH DIBAYAR
                |--------------------------------------------------------------------------
                */

                TextInput::make('jumlah_dibayar')
                    ->label('Jumlah Dibayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->live()
                    ->required()
                    ->afterStateUpdated(function (
                        Get $get,
                        callable $set,
                        $state
                    ) {

                        $total = self::calculateTotal(
                            $get('items') ?? []
                        );

                        $dibayar = (float) (
                            $state ?? 0
                        );

                        $set(
                            'jumlah_kembalian',
                            max(
                                0,
                                $dibayar - $total
                            )
                        );
                    }),

                /*
                |--------------------------------------------------------------------------
                | KEMBALIAN
                |--------------------------------------------------------------------------
                */

                TextInput::make('jumlah_kembalian')
                    ->label('Kembalian')
                    ->prefix('Rp')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false)
                    ->default(0),

            ])

            /*
            |--------------------------------------------------------------------------
            | PROSES CHECKOUT
            |--------------------------------------------------------------------------
            */

            ->action(function (array $data, $record) {

                $items = $data['items'] ?? [];

                /*
                |--------------------------------------------------------------------------
                | VALIDASI PRODUK
                |--------------------------------------------------------------------------
                */

                if (empty($items)) {

                    Notification::make()
                        ->title('Checkout gagal')
                        ->body(
                            'Belum ada produk yang dipilih.'
                        )
                        ->danger()
                        ->send();

                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | HITUNG TOTAL + CEK STOK
                |--------------------------------------------------------------------------
                */

                $total = 0;

                foreach ($items as $item) {

                    if (
                        empty($item['id_produk']) ||
                        empty($item['jumlah'])
                    ) {

                        Notification::make()
                            ->title('Checkout gagal')
                            ->body(
                                'Produk dan jumlah harus diisi.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    $produk = Produk::with('stok')
                        ->find($item['id_produk']);

                    if (!$produk) {

                        Notification::make()
                            ->title('Checkout gagal')
                            ->body(
                                'Produk tidak ditemukan.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    $jumlah = (int) $item['jumlah'];

                    /*
                    |--------------------------------------------------------------------------
                    | VALIDASI JUMLAH
                    |--------------------------------------------------------------------------
                    */

                    if ($jumlah < 1) {

                        Notification::make()
                            ->title('Checkout gagal')
                            ->body(
                                'Jumlah produk minimal 1.'
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | CEK STOK
                    |--------------------------------------------------------------------------
                    */

                    $stok = $produk->stok?->jumlah_stok ?? 0;

                    if ($jumlah > $stok) {

                        Notification::make()
                            ->title('Stok tidak mencukupi')
                            ->body(
                                "Stok {$produk->nama_produk} hanya tersedia {$stok}."
                            )
                            ->danger()
                            ->send();

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | HITUNG TOTAL
                    |--------------------------------------------------------------------------
                    */

                    $total +=
                        $produk->harga_jual * $jumlah;
                }

                /*
                |--------------------------------------------------------------------------
                | VALIDASI PEMBAYARAN
                |--------------------------------------------------------------------------
                */

                $jumlahDibayar = (float) (
                    $data['jumlah_dibayar'] ?? 0
                );

                if ($jumlahDibayar < $total) {

                    Notification::make()
                        ->title('Pembayaran gagal')
                        ->body(
                            'Jumlah pembayaran kurang dari total belanja.'
                        )
                        ->danger()
                        ->send();

                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | SIMPAN TRANSAKSI
                |--------------------------------------------------------------------------
                */

                DB::transaction(function () use (
                    $items,
                    $record,
                    $total,
                    $jumlahDibayar,
                    $data
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | DETAIL TRANSAKSI
                    |--------------------------------------------------------------------------
                    */

                    foreach ($items as $item) {

                        $produk = Produk::findOrFail(
                            $item['id_produk']
                        );

                        $jumlah = (int) $item['jumlah'];

                        DetailTransaksi::create([
                            'id_transaksi' =>
                                $record->id_transaksi,

                            'id_produk' =>
                                $produk->id_produk,

                            'jumlah' =>
                                $jumlah,

                            'harga_satuan' =>
                                $produk->harga_jual,

                            'subtotal' =>
                                $produk->harga_jual * $jumlah,
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE TOTAL TRANSAKSI
                    |--------------------------------------------------------------------------
                    */

                    $record->update([
                        'total_bayar' => $total,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN PEMBAYARAN
                    |--------------------------------------------------------------------------
                    */

                    Pembayaran::create([
                        'id_transaksi' =>
                            $record->id_transaksi,

                        'metode_pembayaran' =>
                            $data['metode_pembayaran'],

                        'jumlah_dibayar' =>
                            $jumlahDibayar,

                        'jumlah_kembalian' =>
                            max(
                                0,
                                $jumlahDibayar - $total
                            ),

                        'tanggal_pembayaran' =>
                            now(),
                    ]);
                });

                /*
                |--------------------------------------------------------------------------
                | NOTIFIKASI
                |--------------------------------------------------------------------------
                */

                Notification::make()
                    ->title('Checkout berhasil')
                    ->body(
                        'Pembayaran berhasil dan transaksi telah diselesaikan.'
                    )
                    ->success()
                    ->send();
            });
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL
    |--------------------------------------------------------------------------
    */

    private static function calculateTotal(
        array $items
    ): float {

        $total = 0;

        foreach ($items as $item) {

            $harga = (float) (
                $item['harga_satuan'] ?? 0
            );

            $jumlah = (int) (
                $item['jumlah'] ?? 0
            );

            $total +=
                $harga * $jumlah;
        }

        return $total;
    }
}