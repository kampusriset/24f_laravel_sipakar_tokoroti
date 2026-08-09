<?php

namespace App\Filament\Resources\KategoriProduks\Pages;

use App\Filament\Resources\KategoriProduks\KategoriProdukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListKategoriProduks extends ListRecords
{
    protected static string $resource = KategoriProdukResource::class;

    protected function getHeaderActions(): array
{
    return [
        CreateAction::make()
            ->label('Tambah Kategori Produk')
            ->icon(Heroicon::OutlinedTag),
    ];
}
}
