<?php

namespace App\Filament\Resources\JenisAnggotaResource\Pages;

use App\Filament\Resources\JenisAnggotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisAnggotas extends ListRecords
{
    protected static string $resource = JenisAnggotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
