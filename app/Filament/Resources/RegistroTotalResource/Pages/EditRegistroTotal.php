<?php

namespace App\Filament\Resources\RegistroTotalResource\Pages;

use App\Filament\Resources\RegistroTotalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistroTotal extends EditRecord
{
    protected static string $resource = RegistroTotalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
