<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SuaraResource\Pages;
use App\Filament\User\Resources\SuaraResource\RelationManagers;
use App\Models\Suara;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuaraResource extends Resource
{
    protected static ?string $model = Suara::class;

    protected static ?string $navigationIcon = 'heroicon-o-speaker-wave';

    protected static ?string $navigationLabel = 'Suara';

    protected static ?string $modelLabel = 'Suara';

    protected static ?string $slug = 'suara';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
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
            'index' => Pages\ListSuaras::route('/'),
            'create' => Pages\CreateSuara::route('/create'),
        ];
    }
}