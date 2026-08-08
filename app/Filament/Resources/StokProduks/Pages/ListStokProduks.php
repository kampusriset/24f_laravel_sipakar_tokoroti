<?php

namespace App\Filament\Resources\StokProduks\Pages;

use App\Filament\Resources\StokProduks\StokProdukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStokProduks extends ListRecords
{
    protected static string $resource = StokProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
