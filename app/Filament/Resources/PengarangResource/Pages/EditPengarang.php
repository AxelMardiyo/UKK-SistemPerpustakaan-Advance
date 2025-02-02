<?php

namespace App\Filament\Resources\PengarangResource\Pages;

use App\Filament\Resources\PengarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengarang extends EditRecord
{
    protected static string $resource = PengarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
