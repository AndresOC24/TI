<?php

namespace App\Filament\Resources\RegistroTotalResource\Pages;

use App\Filament\Resources\RegistroTotalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistroTotals extends ListRecords
{
    protected static string $resource = RegistroTotalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
