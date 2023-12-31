<?php

namespace App\Filament\User\Resources\AgendaResource\RelationManagers;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Calon;
use App\Models\Suara;
use App\Models\Agenda;
use App\Models\Ormawa;
use App\Models\Anggota;
use Filament\Tables\Table;
use Filament\Tables\Actions\Button;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Layout\Grid;
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
                        SpatieMediaLibraryImageColumn::make('image')->extraImgAttributes(['class' => 'w-full'])->height('auto'),
                        TextColumn::make('no_paslon')->weight(FontWeight::Bold),
                        TextColumn::make('ketua.name')->weight(FontWeight::Bold),
                        TextColumn::make('wakil.name')->weight(FontWeight::Bold),
                        TextColumn::make('visi'),
                        TextColumn::make('misi')->wrap(),
                    ])
            ])
            ->contentGrid(['md' => 2])
            ->actions([
                Tables\Actions\Action::make('Pilih')
                    ->label('Pilih')
                    ->button()
                    ->extraAttributes(['class' => 'block w-full'])
                    ->action(function ($record) {
                        $calonId = $record->getModel()->getKey();
                        $userId = Auth::id();
                        $cekCalon = Calon::find($calonId);

                        if ($cekCalon) {
                            $cekAgenda = Agenda::find($cekCalon->agenda_id);

                            if (!Carbon::parse($cekAgenda->tanggal)->isSameDay(now()) ){
                                return Notification::make()
                                    ->title('Maaf, Anda belum waktunya untuk memilih')
                                    ->danger()
                                    ->send();
                            }
                            
                            if (!Carbon::now()->isBetween($cekAgenda->jam_mulai, $cekAgenda->jam_selesai)){
                                return Notification::make()
                                    ->title('Maaf, Anda berada di luar jam untuk memilih')
                                    ->danger()
                                    ->send();
                            }

                            if ($cekAgenda->status == 1) {
                                $cekSuara = Suara::where(['user_id' => $userId])->get();
                                if ($cekSuara->isEmpty()) {
                                        $user = new Suara();
                                        $user->user_id = $userId;
                                        $user->calon_id = $calonId;
                                        $user->save();

                                        return Notification::make()
                                        ->title('Anda berhasil memilih')
                                        ->success()
                                        ->send();
                                } else {
                                    foreach ($cekSuara as $suara) {
                                        $cekPilihan = Calon::find($suara->calon_id);
                                        
                                        if ($cekAgenda->id != $cekPilihan->agenda->id) {
                                            $cekFinal = Suara::where(['user_id' => $userId, "calon_id" => $calonId])->first();
                                            if(!$cekFinal){
                                                $user = new Suara();
                                                $user->user_id = $userId;
                                                $user->calon_id = $calonId;
                                                $user->save();

                                                return Notification::make()
                                                ->title('Anda berhasil memilih')
                                                ->success()
                                                ->send();
                                            }
                                        }
                                    }
                                }

                                return Notification::make()
                                    ->title('Maaf anda sudah memilih')
                                    ->danger()
                                    ->send();
                            } else {
                                $cekOrmawa = Ormawa::find($cekAgenda->ormawa_id);
                                $cekAnggota = Anggota::where(['ormawa_id' => $cekAgenda->ormawa_id, 'user_id' => $userId])->first();

                                if ($cekAnggota) {
                                    $cekSuara = Suara::where(['user_id' => $userId])->get();

                                    if ($cekSuara->isEmpty()) {
                                        $user = new Suara();
                                        $user->user_id = $userId;
                                        $user->calon_id = $calonId;
                                        $user->save();

                                        return Notification::make()
                                            ->title('Anda berhasil memilih')
                                            ->success()
                                            ->send();
                                    } else {
                                        foreach ($cekSuara as $suara) {
                                            $cekPilihan = Calon::find($suara->calon_id);

                                            if ($cekAgenda->id != $cekPilihan->agenda->id) {
                                                $cekFinal = Suara::where(['user_id' => $userId, "calon_id" => $calonId])->first();
                                                if(!$cekFinal){
                                                    $user = new Suara();
                                                    $user->user_id = $userId;
                                                    $user->calon_id = $calonId;
                                                    $user->save();

                                                    return Notification::make()
                                                        ->title('Anda berhasil memilih')
                                                        ->success()
                                                        ->send();
                                                }
                                            }
                                        }
                                    }

                                    
                                    return Notification::make()
                                        ->title('Maaf anda sudah memilih')
                                        ->danger()
                                        ->send();
                                }
                            }
                        }
                    }),
            ])
            ->paginated(false);
    }
}