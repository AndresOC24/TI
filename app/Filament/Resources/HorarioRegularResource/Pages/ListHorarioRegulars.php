<?php

namespace App\Filament\Resources\HorarioRegularResource\Pages;

use App\Filament\Resources\HorarioRegularResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHorarioRegulars extends ListRecords
{
    protected static string $resource = HorarioRegularResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
