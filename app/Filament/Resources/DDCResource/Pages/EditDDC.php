<?php

namespace App\Filament\Resources\DDCResource\Pages;

use App\Filament\Resources\DDCResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDDC extends EditRecord
{
    protected static string $resource = DDCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
