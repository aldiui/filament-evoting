<?php

namespace App\Filament\Resources\OrmawaResource\Pages;

use App\Filament\Resources\OrmawaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrmawa extends CreateRecord
{
    protected static string $resource = OrmawaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}