<?php

namespace App\Filament\Resources\DetailTransaksis;

use App\Filament\Resources\DetailTransaksis\Pages\CreateDetailTransaksi;
use App\Filament\Resources\DetailTransaksis\Pages\EditDetailTransaksi;
use App\Filament\Resources\DetailTransaksis\Pages\ListDetailTransaksis;
use App\Filament\Resources\DetailTransaksis\Schemas\DetailTransaksiForm;
use App\Filament\Resources\DetailTransaksis\Tables\DetailTransaksisTable;
use App\Models\DetailTransaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiResource extends Resource
{
    protected static ?string $model = DetailTransaksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Detail Transaksi';

    protected static ?string $modelLabel = 'Detail Transaksi';

    protected static ?string $pluralModelLabel = 'Detail Transaksi';

    protected static ?string $recordTitleAttribute = 'id_detail';

    public static function form(Schema $schema): Schema
    {
        return DetailTransaksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DetailTransaksisTable::configure($table);
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
            'index' => ListDetailTransaksis::route('/'),
            'create' => CreateDetailTransaksi::route('/create'),
            'edit' => EditDetailTransaksi::route('/{record}/edit'),
        ];
    }

    // ===========================
    // HAK AKSES YAH BANH
    // ===========================

     public static function canViewAny(): bool
     {
        return in_array(Auth::user()?->role, ['admin', 'kasir']);
     }

      public static function canCreate(): bool
      {
        return in_array(Auth::user()?->role, ['admin', 'kasir']);
      }

      public static function canEdit($record): bool
      {
        return in_array(Auth::user()?->role, ['admin', 'kasir'])
        && $record->transaksi?->status_transaksi === 'Pending';
      }

      public static function canDelete($record): bool
      {
        return in_array(Auth::user()?->role, ['admin', 'kasir'])
        && $record->transaksi?->status_transaksi === 'Pending';
      }
}
