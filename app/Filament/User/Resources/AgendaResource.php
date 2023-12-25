<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\AgendaResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\User\Resources\AgendaResource\RelationManagers;
use App\Filament\User\Resources\AgendaResource\RelationManagers\CalonRelationManager;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $modelLabel = 'Agenda';

    protected static ?string $slug = 'agenda';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        SpatieMediaLibraryImageColumn::make('ormawa.image')->extraImgAttributes(['class' => "w-full"])->height("auto"),
                        TextColumn::make("ormawa.name")->label('Ormawa'),
                        TextColumn::make("tanggal")->label('Tanggal'),
                        TextColumn::make("jam_mulai")->label('Jam Mulai'),
                        TextColumn::make("jam_selesai")->label('Jam Selesai'),
                    ])
            ])
            ->contentGrid(["md" => 2, "xl" =>3])
            ->actions([
                Tables\Actions\ViewAction::make()->label("Detail Selengkapnya"),
            ])
            ->paginated(false);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('ormawa.name'),
                Infolists\Components\TextEntry::make('tanggal'),
                Infolists\Components\TextEntry::make('jam_mulai'),
                Infolists\Components\TextEntry::make('jam_selesai'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CalonRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'view' => Pages\ViewAgenda::route('/{record}'),
        ];
    }
}