<?php

namespace App\Filament\Resources\AgendaResource\Widgets;

use App\Models\Calon;
use App\Models\Suara;
use App\Models\Anggota;
use Filament\Widgets\ChartWidget;

class KumssiChart extends ChartWidget
{
    protected static ?string $heading = 'Suara PEMIRA KUMSSI';

    protected function getData(): array
    {
        $calon = Calon::where("agenda_id", 4)->get();
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
        return Anggota::where('ormawa_id', 4)->count() . ' Mahasiswa Hak Suara';
    }
}