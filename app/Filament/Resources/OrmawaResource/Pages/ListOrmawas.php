<?php

namespace App\Filament\Resources\OrmawaResource\Pages;

use App\Filament\Resources\OrmawaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrmawas extends ListRecords
{
    protected static string $resource = OrmawaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->disableCreateAnother(),
        ];
    }
}