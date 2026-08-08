<?php

namespace App\Filament\Resources\DetailTransaksis\Pages;

use App\Filament\Resources\DetailTransaksis\DetailTransaksiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDetailTransaksis extends ListRecords
{
    protected static string $resource = DetailTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
