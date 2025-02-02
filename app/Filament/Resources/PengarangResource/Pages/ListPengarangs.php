<?php

namespace App\Filament\Resources\PengarangResource\Pages;

use App\Filament\Resources\PengarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengarangs extends ListRecords
{
    protected static string $resource = PengarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
