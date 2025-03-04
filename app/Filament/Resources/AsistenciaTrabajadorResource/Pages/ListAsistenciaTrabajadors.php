<?php

namespace App\Filament\Resources\AsistenciaTrabajadorResource\Pages;

use App\Filament\Resources\AsistenciaTrabajadorResource;
use App\Models\AsistenciaTrabajador;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Filament\Notifications\Notification;

class ListAsistenciaTrabajadors extends ListRecords
{
    protected static string $resource = AsistenciaTrabajadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('ingreso')
            ->label('Marcar entrada')
            ->color('success')
            ->action(function (){
                $user = Auth::user();
                $today = Carbon::now()->toDateString();

                // Verificar si ya existe un registro de entrada para hoy
                $existingEntry = AsistenciaTrabajador::where('user_id', $user->id)
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
                $asistenciaTrabajador = new AsistenciaTrabajador();
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
                $existingEntry = AsistenciaTrabajador::where('user_id', $user->id)
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
