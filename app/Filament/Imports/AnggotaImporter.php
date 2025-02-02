<?php

namespace App\Filament\Imports;

use App\Models\Anggota;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AnggotaImporter extends Importer
{
    protected static ?string $model = Anggota::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id_jenis_anggota')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('kode_anggota')
                ->requiredMapping()
                ->rules(['required', 'max:20']),
            ImportColumn::make('nama_anggota')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('tempat')
                ->requiredMapping()
                ->rules(['required', 'max:20']),
            ImportColumn::make('tgl_lahir')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('alamat')
                ->requiredMapping()
                ->rules(['required', 'max:225']),
            ImportColumn::make('no_telp')
                ->requiredMapping()
                ->rules(['required', 'max:15']),
            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email', 'max:30']),
            ImportColumn::make('tgl_daftar')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('masa_aktif')
                ->rules(['date']),
            ImportColumn::make('fa')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('keterangan')
                ->requiredMapping()
                ->rules(['required', 'max:45']),
            ImportColumn::make('foto')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('username')
                ->requiredMapping()
                ->rules(['required', 'max:50']),
            ImportColumn::make('password')
                ->requiredMapping()
                ->rules(['required', 'max:225']),
        ];
    }

    public function resolveRecord(): ?Anggota
    {
        // return Anggota::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Anggota();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your anggota import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
