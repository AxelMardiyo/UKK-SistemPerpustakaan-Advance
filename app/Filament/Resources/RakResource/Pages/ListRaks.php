<?php

namespace App\Filament\Resources\RakResource\Pages;

use App\Filament\Resources\RakResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRaks extends ListRecords
{
    protected static string $resource = RakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
