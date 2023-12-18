<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserResource\Pages;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Mahasiswa';

    protected static ?string $modelLabel = 'Mahasiswa';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'mahasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
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
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}