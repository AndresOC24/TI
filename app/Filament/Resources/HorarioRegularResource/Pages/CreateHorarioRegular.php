<?php

namespace App\Filament\Resources\HorarioRegularResource\Pages;

use App\Filament\Resources\HorarioRegularResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHorarioRegular extends CreateRecord
{
    protected static string $resource = HorarioRegularResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirige a la lista de usuarios
    }
}
