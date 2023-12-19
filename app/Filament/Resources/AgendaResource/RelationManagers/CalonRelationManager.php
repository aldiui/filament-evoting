<?php

namespace App\Filament\Resources\AgendaResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Anggota;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CalonRelationManager extends RelationManager
{
    protected static string $relationship = 'calon';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ketua_id')
                    ->label('Ketua')
                    ->options(Anggota::with("user", "ormawa")->get()->pluck('user.name', 'user.id'))
                    ->searchable()
                    ->required(),
                Select::make('wakil_id')
                    ->label('Wakil Ketua')
                    ->options(Anggota::with("user", "ormawa")->get()->pluck('user.name', 'user.id'))
                    ->searchable()
                    ->required(),
                TextInput::make('no_paslon')->label("Nomor Paslon")->numeric()->required(),
                TextInput::make('visi')->required()->maxLength(255),
                MarkdownEditor::make('misi')->required(),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_paslon')
            ->columns([
                TextColumn::make('no_paslon')->label('Nomor Paslon')->sortable()->searchable(),
                TextColumn::make('ketua.name')->label('Ketua')->sortable()->searchable(),
                TextColumn::make('wakil.name')->label('Wakil Ketua')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}