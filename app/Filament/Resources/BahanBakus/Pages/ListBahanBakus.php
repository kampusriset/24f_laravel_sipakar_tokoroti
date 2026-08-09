<?php

namespace App\Filament\Resources\BahanBakus\Pages;

use App\Filament\Resources\BahanBakus\BahanBakuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListBahanBakus extends ListRecords
{
    protected static string $resource = BahanBakuResource::class;

    protected function getHeaderActions(): array
{
    return [
        CreateAction::make()
            ->label('Tambah Bahan Baku')
            ->icon(Heroicon::OutlinedCube),
    ];
}
}
