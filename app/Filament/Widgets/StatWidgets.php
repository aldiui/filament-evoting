<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Ormawa;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatWidgets extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Ormawa', Ormawa::count()),
            Card::make('Mahasiswa', User::where('role', 0)->count()),
            Card::make('Agenda', Agenda::count()),
        ];
    }
}