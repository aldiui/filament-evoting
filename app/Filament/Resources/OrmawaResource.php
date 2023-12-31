<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ormawa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\OrmawaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\OrmawaResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\OrmawaResource\RelationManagers\AnggotaRelationManager;

class OrmawaResource extends Resource
{
    protected static ?string $model = Ormawa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Ormawa';

    protected static ?string $modelLabel = 'Ormawa';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?string $slug = 'ormawa';

    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')->label('Foto'),
                TextInput::make('name')->label('Nama')->required()->maxLength(255),
                MarkdownEditor::make('description')->label('Deskripsi')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')->label('Foto'),
                TextColumn::make("name")->label('Nama')->sortable()->searchable(),
                TextColumn::make("anggota_count")->counts('anggota')->label('Anggota')->sortable()->searchable(),
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
            ])
            ->paginated([50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            AnggotaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrmawas::route('/'),
            'edit' => Pages\EditOrmawa::route('/{record}/edit'),
        ];
    }
}