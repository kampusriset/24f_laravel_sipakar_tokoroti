<?php

namespace App\Filament\Resources\StokProduks;

use App\Filament\Resources\StokProduks\Pages\CreateStokProduk;
use App\Filament\Resources\StokProduks\Pages\EditStokProduk;
use App\Filament\Resources\StokProduks\Pages\ListStokProduks;
use App\Filament\Resources\StokProduks\Schemas\StokProdukForm;
use App\Filament\Resources\StokProduks\Tables\StokProduksTable;
use App\Models\StokProduk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class StokProdukResource extends Resource
{
    protected static ?string $model = StokProduk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Stok Produk';

    public static function form(Schema $schema): Schema
    {
        return StokProdukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokProduksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStokProduks::route('/'),
            'create' => CreateStokProduk::route('/create'),
            'edit' => EditStokProduk::route('/{record}/edit'),
        ];
    }

    // ===========================
    // HAK AKSES YAH BANH
    // ===========================

     public static function canViewAny(): bool
     {
        return Auth::user()?->role === 'admin';
     }

      public static function canCreate(): bool
      {
        return Auth::user()?->role === 'admin';
      }

      public static function canEdit($record): bool
      {
        return Auth::user()?->role === 'admin';
      }

      public static function canDelete($record): bool
      {
        return Auth::user()?->role === 'admin';
      }
}
