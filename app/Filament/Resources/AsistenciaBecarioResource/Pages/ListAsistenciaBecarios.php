<?php

namespace App\Filament\Resources\AsistenciaBecarioResource\Pages;

use App\Filament\Resources\AsistenciaBecarioResource;
use App\Models\AsistenciaBecario;
use App\Models\RegistroBecario;
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

            // Acción para marcar entrada
            Actions\Action::make('ingreso')
                ->label('Marcar Entrada')
                ->color('success')
                ->action(function () {
                    $user = Auth::user();
                    $today = Carbon::now()->toDateString();
                    $currentTime = Carbon::now()->toTimeString();

                    // Verificar si ya existe un registro de entrada para hoy
                    $existingEntry = AsistenciaBecario::where('user_id', $user->id)
                        ->whereDate('fecha', $today)
                        ->first();

                    if ($existingEntry) {
                        Notification::make()
                            ->title('Entrada ya registrada')
                            ->body('Ya has registrado tu entrada el día de hoy.')
                            ->warning()
                            ->send();
                        return;
                    }

                    // Guardar la entrada con la hora actual
                    $asistenciaBecario = new AsistenciaBecario();
                    $asistenciaBecario->user_id = $user->id;
                    $asistenciaBecario->fecha = $today;
                    $asistenciaBecario->ingreso = $currentTime;
                    $asistenciaBecario->save();

                    Notification::make()
                        ->title('Entrada registrada')
                        ->body('Se ha registrado su entrada correctamente.')
                        ->success()
                        ->send();
                }),

            // Acción para marcar salida y calcular horas trabajadas
            Actions\Action::make('salida')
                ->label('Marcar Salida')
                ->color('danger')
                ->action(function () {
                    $user = Auth::user();
                    $today = Carbon::now()->toDateString();
                    $currentTime = Carbon::now()->toTimeString();

                    // Buscar el registro de entrada del día de hoy
                    $existingEntry = AsistenciaBecario::where('user_id', $user->id)
                        ->whereDate('fecha', $today)
                        ->first();

                    if (!$existingEntry) {
                        Notification::make()
                            ->title('Error')
                            ->body('Primero debe registrar su entrada.')
                            ->danger()
                            ->send();
                        return;
                    }

                    if ($existingEntry->salida !== null) {
                        Notification::make()
                            ->title('Salida ya registrada')
                            ->body('Ya has registrado tu salida el día de hoy.')
                            ->warning()
                            ->send();
                        return;
                    }

                    // Guardar la hora de salida con la hora actual
                    $existingEntry->salida = $currentTime;
                    $existingEntry->save();

                    // Calcular minutos trabajados
                    $ingresoReal = Carbon::parse($existingEntry->ingreso);
                    $salidaReal = Carbon::parse($currentTime);
                    $minutosTrabajados = $ingresoReal->diffInMinutes($salidaReal);
                    $horasTrabajadas = round($minutosTrabajados / 60, 2); // Convertir a horas con dos decimales

                    // Actualizar o crear en `registro_becarios`
                    $registro = RegistroBecario::firstOrCreate(
                        ['user_id' => $user->id],
                        ['horas_total' => 0]
                    );

                    $registro->horas_total += $horasTrabajadas;
                    $registro->save();

                    Notification::make()
                        ->title('Salida registrada')
                        ->body('Se ha registrado su salida correctamente y actualizado sus horas trabajadas.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
