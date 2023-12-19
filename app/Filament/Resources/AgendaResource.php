<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use App\Models\Ormawa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgendaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Filament\Resources\AgendaResource\RelationManagers\CalonRelationManager;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $modelLabel = 'Agenda';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'agenda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ormawa_id')
                    ->label('Ormawa')
                    ->options(Ormawa::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                DatePicker::make('tanggal')->required(),
                TimePicker::make('jam_mulai')->label('Jam Mulai')->required(),
                TimePicker::make('jam_selesai')->label('Jam Selesai')->required(),
                Toggle::make('status')->label("Umum"),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("ormawa.name")->label('Ormawa')->sortable()->searchable(),
                TextColumn::make("tanggal")->label('Tanggal')->sortable()->searchable(),
                TextColumn::make("jam_mulai")->label('Jam Mulai')->sortable()->searchable(),
                TextColumn::make("jam_selesai")->label('Jam Selesai')->sortable()->searchable(),
                TextColumn::make("status")->label('Status')->sortable()->searchable()->formatStateUsing(function ($state) {
                    return ($state == 1) ? 'Umum' : 'Internal';
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CalonRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}