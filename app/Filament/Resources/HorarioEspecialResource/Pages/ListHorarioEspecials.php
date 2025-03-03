<?php

namespace App\Filament\Resources\HorarioEspecialResource\Pages;

use App\Filament\Resources\HorarioEspecialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHorarioEspecials extends ListRecords
{
    protected static string $resource = HorarioEspecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
