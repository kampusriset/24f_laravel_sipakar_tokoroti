<?php

namespace App\Filament\Resources\StokProduks\Pages;

use App\Filament\Resources\StokProduks\StokProdukResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStokProduk extends EditRecord
{
    protected static string $resource = StokProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
