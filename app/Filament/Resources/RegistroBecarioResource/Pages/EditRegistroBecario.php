<?php

namespace App\Filament\Resources\RegistroBecarioResource\Pages;

use App\Filament\Resources\RegistroBecarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistroBecario extends EditRecord
{
    protected static string $resource = RegistroBecarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
