<?php

namespace App\Filament\Resources\PenerbitResource\Pages;

use App\Filament\Resources\PenerbitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenerbit extends EditRecord
{
    protected static string $resource = PenerbitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
