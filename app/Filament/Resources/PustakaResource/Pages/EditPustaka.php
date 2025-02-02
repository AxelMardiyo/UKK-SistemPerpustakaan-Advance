<?php

namespace App\Filament\Resources\PustakaResource\Pages;

use App\Filament\Resources\PustakaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPustaka extends EditRecord
{
    protected static string $resource = PustakaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
