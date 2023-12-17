<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ormawa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\OrmawaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrmawaResource\RelationManagers;

class OrmawaResource extends Resource
{
    protected static ?string $model = Ormawa::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Ormawa';

    protected static ?string $modelLabel = 'Ormawa';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'ormawa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        FileUpload::make('image')->label('Foto')->image()->imageEditor(),
                        TextInput::make('name')->label('Nama')->required(),
                        MarkdownEditor::make('description')->label('Deskripsi')->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Foto'),
                TextColumn::make("name")->label('Nama')->sortable()->searchable(),
                TextColumn::make("description")->label('Deskripsi')->sortable()->searchable()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrmawas::route('/'),
            'create' => Pages\CreateOrmawa::route('/create'),
            'edit' => Pages\EditOrmawa::route('/{record}/edit'),
        ];
    }
}