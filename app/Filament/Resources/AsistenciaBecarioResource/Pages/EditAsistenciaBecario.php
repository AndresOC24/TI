<?php

namespace App\Filament\Resources\AsistenciaBecarioResource\Pages;

use App\Filament\Resources\AsistenciaBecarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsistenciaBecario extends EditRecord
{
    protected static string $resource = AsistenciaBecarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
