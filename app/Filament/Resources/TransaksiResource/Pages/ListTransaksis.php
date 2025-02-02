<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TransaksiResource;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return TransaksiResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Telah Dikembalikan' => Tab::make()->query(fn ($query) => $query->where('fp', '1')),
            'Belum Dikembalikan' => Tab::make()->query(fn ($query) => $query->where('fp', '0')),
            'Pending' => Tab::make()->query(fn ($query) => $query->where('status_request', 'pending')),
            'Approved' => Tab::make()->query(fn ($query) => $query->where('status_request', 'approved')),
            'Rejected' => Tab::make()->query(fn ($query) => $query->where('status_request', 'rejected')),
        ];
    }

}
