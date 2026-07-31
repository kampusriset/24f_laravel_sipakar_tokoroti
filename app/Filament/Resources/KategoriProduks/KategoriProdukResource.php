<?php

namespace App\Filament\Resources\KategoriProduks;

use App\Filament\Resources\KategoriProduks\Pages\CreateKategoriProduk;
use App\Filament\Resources\KategoriProduks\Pages\EditKategoriProduk;
use App\Filament\Resources\KategoriProduks\Pages\ListKategoriProduks;
use App\Filament\Resources\KategoriProduks\Schemas\KategoriProdukForm;
use App\Filament\Resources\KategoriProduks\Tables\KategoriProduksTable;
use App\Models\KategoriProduk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class KategoriProdukResource extends Resource
{
    protected static ?string $model = KategoriProduk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_kategori';

    public static function form(Schema $schema): Schema
    {
        return KategoriProdukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriProduksTable::configure($table);
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
            'index' => ListKategoriProduks::route('/'),
            'create' => CreateKategoriProduk::route('/create'),
            'edit' => EditKategoriProduk::route('/{record}/edit'),
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
