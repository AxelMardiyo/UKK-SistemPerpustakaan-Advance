<?php

namespace App\Filament\Resources\DDCResource\Pages;

use App\Filament\Resources\DDCResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDDCS extends ListRecords
{
    protected static string $resource = DDCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
