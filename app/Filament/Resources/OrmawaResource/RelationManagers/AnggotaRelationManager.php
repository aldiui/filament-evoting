<?php

namespace App\Filament\Resources\OrmawaResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class AnggotaRelationManager extends RelationManager
{
    
    protected static string $relationship = 'anggota';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Mahasiswa')
                    ->options(User::where('role', 0)->get()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('user.nim')->label('NIM')->sortable()->searchable(),
                TextColumn::make('user.name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('user.kelas')->label('Kelas')->sortable()->searchable(),
                TextColumn::make('jabatan')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->disableCreateAnother(),
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
}