<?php

namespace App\Filament\Resources\JenisAnggotaResource\Pages;

use App\Filament\Resources\JenisAnggotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisAnggota extends EditRecord
{
    protected static string $resource = JenisAnggotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
