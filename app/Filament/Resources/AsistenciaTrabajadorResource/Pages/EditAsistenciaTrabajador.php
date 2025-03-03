<?php

namespace App\Filament\Resources\AsistenciaTrabajadorResource\Pages;

use App\Filament\Resources\AsistenciaTrabajadorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsistenciaTrabajador extends EditRecord
{
    protected static string $resource = AsistenciaTrabajadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
