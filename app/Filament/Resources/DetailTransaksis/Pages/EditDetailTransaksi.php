<?php

namespace App\Filament\Resources\DetailTransaksis\Pages;

use App\Filament\Resources\DetailTransaksis\DetailTransaksiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDetailTransaksi extends EditRecord
{
    protected static string $resource = DetailTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
