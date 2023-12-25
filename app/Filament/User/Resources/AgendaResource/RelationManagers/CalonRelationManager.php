<?php

namespace App\Filament\User\Resources\AgendaResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CalonRelationManager extends RelationManager
{
    protected static string $relationship = 'calon';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_paslon')
            ->columns([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        SpatieMediaLibraryImageColumn::make('image')->extraImgAttributes(['class' => "w-full"])->height("auto"),
                        TextColumn::make('no_paslon')->label('Nomor Paslon'),
                        TextColumn::make('ketua.name')->label('Ketua'),
                        TextColumn::make('wakil.name')->label('Wakil Ketua'),
                        TextColumn::make('visi'),
                        TextColumn::make('misi'),
                    ])
            ])
            ->contentGrid(["md" => 2,])
            ->paginated(false);
    }
}