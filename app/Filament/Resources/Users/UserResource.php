<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

   protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

   protected static ?string $navigationLabel = 'User';

   protected static ?string $modelLabel = 'User';

   protected static ?string $pluralModelLabel = 'User';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
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
