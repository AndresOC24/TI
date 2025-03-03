<?php

namespace App\Filament\Resources\HorarioEspecialResource\Pages;

use App\Filament\Resources\HorarioEspecialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorarioEspecial extends EditRecord
{
    protected static string $resource = HorarioEspecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
