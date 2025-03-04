<?php

namespace App\Filament\Resources\AsistenciaBecarioResource\Pages;

use App\Filament\Resources\AsistenciaBecarioResource;
use App\Models\AsistenciaBecario;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAsistenciaBecarios extends ListRecords
{
    protected static string $resource = AsistenciaBecarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('ingreso')
            ->label('Marcar Entrada')
            ->color('success')
            ->action(function (){
                $user = Auth::user();
                $today = Carbon::now()->toDateString();

                                // Verificar si ya existe un registro de entrada para hoy
                                $existingEntry = AsistenciaBecario::where('user_id', $user->id)
                                ->whereDate('fecha', $today)
                                ->first();

                            if ($existingEntry) {
                                // Si ya existe un registro, mostrar una notificación
                                Notification::make()
                                    ->title('Entrada ya registrada')
                                    ->body('Ya has registrado tu entrada el día de hoy.')
                                    ->warning()
                                    ->send();
                                return;
                            }

                            // Si no existe, crear un nuevo registro
                            $asistenciaTrabajador = new AsistenciaBecario();
                            $asistenciaTrabajador->user_id = $user->id;
                            $asistenciaTrabajador->fecha = $today;
                            $asistenciaTrabajador->ingreso = Carbon::now()->toTimeString();
                            $asistenciaTrabajador->save();

                            // Opcional: Mostrar una notificación de éxito
                            Notification::make()
                                ->title('Entrada registrada')
                                ->body('Se ha registrado su entrada correctamente.')
                                ->success()
                                ->send();
                        }),

                        Actions\Action::make('salida')
                        ->label('Marcar Salida')
                        ->color('danger')
                        ->action(function (){
                            $user = Auth::user();
                            $today = Carbon::now()->toDateString();

                            // Buscar el registro de entrada del día de hoy
                            $existingEntry = AsistenciaBecario::where('user_id', $user->id)
                                ->whereDate('fecha', $today)
                                ->first();

                            if (!$existingEntry) {
                                // Si no hay entrada previa, mostrar error
                                Notification::make()
                                    ->title('Error')
                                    ->body('Primero debe registrar su entrada.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            // Verificar si ya se registró la salida
                            if ($existingEntry->salida !== null) {
                                Notification::make()
                                    ->title('Salida ya registrada')
                                    ->body('Ya has registrado tu salida el día de hoy.')
                                    ->warning()
                                    ->send();
                                return;
                            }

                            // Actualizar el registro existente con la hora de salida
                            $existingEntry->salida = Carbon::now()->toTimeString();
                            $existingEntry->save();

                            // Mostrar notificación de éxito
                            Notification::make()
                                ->title('Salida registrada')
                                ->body('Se ha registrado su salida correctamente.')
                                ->success()
                                ->send();
            }),
        ];
    }
}
