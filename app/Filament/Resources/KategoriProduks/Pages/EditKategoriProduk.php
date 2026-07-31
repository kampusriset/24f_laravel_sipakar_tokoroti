<?php

namespace App\Filament\Resources\KategoriProduks\Pages;

use App\Filament\Resources\KategoriProduks\KategoriProdukResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriProduk extends EditRecord
{
    protected static string $resource = KategoriProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
