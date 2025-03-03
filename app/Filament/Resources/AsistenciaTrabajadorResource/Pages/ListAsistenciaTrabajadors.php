<?php

namespace App\Filament\Resources\AsistenciaTrabajadorResource\Pages;

use App\Filament\Resources\AsistenciaTrabajadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsistenciaTrabajadors extends ListRecords
{
    protected static string $resource = AsistenciaTrabajadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
