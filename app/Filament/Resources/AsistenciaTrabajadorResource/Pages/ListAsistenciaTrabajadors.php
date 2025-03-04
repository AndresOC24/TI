<?php

namespace App\Filament\Resources\AsistenciaTrabajadorResource\Pages;

use App\Filament\Resources\AsistenciaTrabajadorResource;
use App\Models\AsistenciaTrabajador;
use App\Models\HorarioRegular;
use App\Models\RegistroTotal;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAsistenciaTrabajadors extends ListRecords
{
    protected static string $resource = AsistenciaTrabajadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            // Acción para marcar entrada con la hora actual
            Actions\Action::make('ingreso')
                ->label('Marcar Entrada')
                ->color('success')
                ->action(function () {
                    $user = Auth::user();
                    $today = Carbon::now()->toDateString();
                    $currentTime = Carbon::now()->toTimeString();

                    // Verificar si ya existe un registro de entrada para hoy
                    $existingEntry = AsistenciaTrabajador::where('user_id', $user->id)
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
                    $asistenciaTrabajador = new AsistenciaTrabajador();
                    $asistenciaTrabajador->user_id = $user->id;
                    $asistenciaTrabajador->fecha = $today;
                    $asistenciaTrabajador->ingreso = $currentTime;
                    $asistenciaTrabajador->save();

                    Notification::make()
                        ->title('Entrada registrada')
                        ->body('Se ha registrado su entrada correctamente.')
                        ->success()
                        ->send();
                }),

            // Acción para marcar salida y calcular tiempo trabajado
            Actions\Action::make('salida')
                ->label('Marcar Salida')
                ->color('danger')
                ->action(function () {
                    $user = Auth::user();
                    $today = Carbon::now()->toDateString();
                    $currentTime = Carbon::now()->toTimeString();

                    // Buscar el registro de entrada del día de hoy
                    $existingEntry = AsistenciaTrabajador::where('user_id', $user->id)
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

                    // Obtener el horario regular del usuario
                    $horario = HorarioRegular::where('user_id', $user->id)->first();

                    if ($horario) {
                        // Convertir tiempos a Carbon
                        $ingresoReal = Carbon::parse($existingEntry->ingreso);
                        $salidaReal = Carbon::parse($currentTime);
                        $ingresoFijo = Carbon::parse($horario->ingreso);
                        $salidaFija = Carbon::parse($horario->salida);

                        // Calcular minutos trabajados
                        $minutosTrabajados = $ingresoReal->diffInMinutes($salidaReal);

                        // Calcular minutos esperados
                        $minutosEsperados = $ingresoFijo->diffInMinutes($salidaFija);

                        // Calcular saldo de minutos
                        $saldo = $minutosTrabajados - $minutosEsperados;

                        // Actualizar o crear en `registro_totales`
                        $registro = RegistroTotal::firstOrCreate(
                            ['user_id' => $user->id],
                            ['total_tiempo' => 0, 'saldo' => 0]
                        );

                        $registro->total_tiempo += $minutosTrabajados;
                        $registro->saldo += $saldo;
                        $registro->save();
                    }

                    Notification::make()
                        ->title('Salida registrada')
                        ->body('Se ha registrado su salida correctamente y actualizado su saldo.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
