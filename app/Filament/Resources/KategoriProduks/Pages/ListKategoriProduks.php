<?php

namespace App\Filament\Resources\KategoriProduks\Pages;

use App\Filament\Resources\KategoriProduks\KategoriProdukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriProduks extends ListRecords
{
    protected static string $resource = KategoriProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
