<?php

namespace App\Filament\User\Resources\AgendaResource\Pages;

use Filament\Actions;
use App\Models\Agenda;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\AgendaResource;

class ListAgendas extends ListRecords
{
    protected static string $resource = AgendaResource::class;

    protected function getTableQuery(): Builder
    {
        $user = Auth::user();
        $result = Agenda::where('status', 1)
            ->orWhere(function ($query) use ($user) {
            $query->whereIn('ormawa_id', function ($subquery) use ($user) {
                $subquery->select('ormawa_id')
                    ->from('anggotas')
                    ->where('user_id', $user->id);
            });
        });
        return $result;
    }

    protected function getTableContentGrid(): ?array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}