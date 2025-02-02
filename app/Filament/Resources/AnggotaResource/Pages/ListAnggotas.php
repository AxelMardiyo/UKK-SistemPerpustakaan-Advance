<?php

namespace App\Filament\Resources\AnggotaResource\Pages;

use Filament\Actions;
use App\Imports\AnggotaImport;
use Filament\Pages\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AnggotaResource;

class ListAnggotas extends ListRecords
{
    protected static string $resource = AnggotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('importAnggota')
                ->label('Import Anggota')
                ->color('warning')
                ->icon('heroicon-o-document-arrow-down')
                ->form([
                    FileUpload::make('attachment'),
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/'. $data['attachment']);

                    Excel::import(new AnggotaImport(), $file);

                    Notification::make()
                        ->title('Anggota Imported')
                        ->success()
                        ->send();
                })

        ];
    }
}
