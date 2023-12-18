<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getTableQuery(): Builder
    {
        return User::where('role', 0);
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()->label('Import')
                ->fields([
                    ImportField::make('nim')->label("NIM")->required(),
                    ImportField::make('name')->label("Nama")->required(),
                    ImportField::make('email')->label("Email")->required(),
                    ImportField::make('kelas')->label("Kelas")->required(),
                ])->handleRecordCreation(function (array $data) {
                    $existingUser = User::where('nim', $data['nim'])->orWhere('email', $data['email'])->first();

                    if (!$existingUser) {
                        $user = new User();
                        $user->nim = $data['nim'];
                        $user->name = $data['name'];
                        $user->email = $data['email'];
                        $user->kelas = $data['kelas'];
                        $user->password = bcrypt($data['nim']);
                        $user->save();

                        return $user; 
                    }
                }),

        ];
    }
}