<?php

namespace App\Filament\Resources\AsistenciaBecarioResource\Pages;

use App\Filament\Resources\AsistenciaBecarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsistenciaBecarios extends ListRecords
{
    protected static string $resource = AsistenciaBecarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
