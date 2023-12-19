<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Mahasiswa';

    protected static ?string $modelLabel = 'Mahasiswa';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'mahasiswa';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nim')->label('NIM')->required()->maxLength(255),
                TextInput::make('name')->label('Nama')->required()->maxLength(255),
                TextInput::make('email')->email()->label('Email')->required()->maxLength(255),
                Select::make('kelas')
                    ->label('Kelas')
                    ->options([
                        "19.1A.17" => "19.1A.17",
                        "19.1B.17" => "19.1B.17",
                        "19.1C.17" => "19.1C.17",
                        "12.3A.17" => "12.3A.17",
                        "12.3B.17" => "12.3B.17",
                        "12.3C.17" => "12.3C.17",
                        "12.5A.17" => "12.5A.17",
                        "12.5B.17" => "12.5B.17",
                        "12.5D.17" => "12.5D.17",
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('password')->password()->label('Password')->dehydrateStateUsing(fn ($state) => bycyptr($state))
                ->dehydrated(fn ($state) => filled($state))->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nim")->label('NIM')->sortable()->searchable(),
                TextColumn::make("name")->label('Nama')->sortable()->searchable(),
                TextColumn::make("email")->label('Email')->sortable()->searchable(),
                TextColumn::make("kelas")->label('Kelas')->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('kelas')->label('Kelas')->options([
                    "19.1A.17" => "19.1A.17",
                    "19.1B.17" => "19.1B.17",
                    "19.1C.17" => "19.1C.17",
                    "12.3A.17" => "12.3A.17",
                    "12.3B.17" => "12.3B.17",
                    "12.3C.17" => "12.3C.17",
                    "12.5A.17" => "12.5A.17",
                    "12.5B.17" => "12.5B.17",
                    "12.5D.17" => "12.5D.17",
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([50, 100, 'all']);
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
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}