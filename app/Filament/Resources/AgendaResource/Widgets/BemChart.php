<?php

namespace App\Filament\Resources\AgendaResource\Widgets;

use App\Models\User;
use App\Models\Calon;
use App\Models\Suara;
use Filament\Widgets\ChartWidget;

class BemChart extends ChartWidget
{
    protected static ?string $heading = 'Suara PEMIRA BEM';

    protected function getData(): array
    {
        $calon = Calon::where("agenda_id", 1)->get();
        $data = [];

        foreach ($calon as $row) {
            $data["Calon No " . $row->no_paslon] = Suara::where("calon_id", $row->id)->count();
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Assets',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#b91c1c',
                        '#1d4ed8', 
                    ],
                    'borderColor' => [
                        '#b91c1c',
                        '#1d4ed8', 
                    ],
                    'borderWidth' => 0.5,
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public function getDescription(): ?string
    {
        return User::where('role', 0)->count() . ' Mahasiswa Hak Suara';
    }
}