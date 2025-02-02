<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pustaka;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TransaksiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Filament\Resources\TransaksiResource\Widgets\TransaksisOverview;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $pluralModelLabel = 'Transaksi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_pustaka')
                    // ->relationship('pustaka', 'judul_pustaka') // Relasi ke model pustaka

                    ->options(function () {
                        return Pustaka::all()->mapWithKeys(function ($pustaka) {
                            // Menghitung sisa stok
                            $sisaStok = $pustaka->stok - $pustaka->jml_pinjam;

                            // Menggunakan ID pustaka sebagai key dan judul pustaka dengan sisa stok sebagai value
                            return [
                                $pustaka->id_pustaka => $pustaka->judul_pustaka . ' (Sisa: ' . $sisaStok . ')'
                            ];
                        });
                    })
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('id_anggota')
                    ->relationship(name: 'anggota', titleAttribute: 'nama_anggota')
                    ->searchable(['nama_anggota', 'kode_anggota'])
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('tgl_pinjam')
                    ->label('Tanggal Pinjam')
                    ->default(now())
                    ->required(),
                Forms\Components\DatePicker::make('tgl_kembali')
                    ->label('Tanggal Kembali')
                    ->default(now()->addDays(7))
                    ->required(),
                Forms\Components\DatePicker::make('tgl_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Jika tgl_pengembalian diisi, otomatis set fp menjadi 1 (Sudah Dikembalikan)
                        if ($state) {
                            $set('fp', '1');  // Menetapkan fp menjadi '1' jika tgl_pengembalian diisi
                        }
                    })
                    ->live(),
                Forms\Components\ToggleButtons::make('fp')
                    ->default('0')
                    ->label('Status')
                    ->inline()
                    ->options([
                        '0' => 'Belum Dikembalikan',
                        '1' => 'Sudah Dikembalikan',
                    ])
                    ->colors([
                        '0' => 'danger',    // Warna untuk opsi 'N'
                        '1' => 'success', // Warna untuk opsi 'Y'
                    ])
                    ->icons([
                        '0' => 'heroicon-m-x-circle',    // Icon untuk opsi 'N'
                        '1' => 'heroicon-m-check-circle', // Icon untuk opsi 'Y'
                    ])
                    ->required(),
                Forms\Components\ToggleButtons::make('status_request')
                    ->label('Status Request')
                    ->inline()
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending') // Nilai default
                    ->colors([
                        'pending' => 'warning',
                        'approved' => 'info',
                        'rejected' => 'danger',
                    ])
                    ->required(),
                Forms\Components\MarkdownEditor::make('keterangan')
                    ->disableToolbarButtons([
                        'blockquote',
                        'strike',
                        'codeBlock',
                        'attachFiles'
                    ])
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(50),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pustaka')
                    ->formatStateUsing(fn($state, $record) => "{$record->id_pustaka} | {$record->pustaka->judul_pustaka}") // Format ID dan nama
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_anggota')
                    ->formatStateUsing(fn($state, $record) => "{$record->id_anggota} | {$record->anggota->nama_anggota}") // Format ID dan nama
                    // ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_pinjam')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_kembali')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_pengembalian')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fp')
                    ->label('Status Kembali')
                    ->formatStateUsing(fn($state) => $state === '1' ? 'Sudah Dikembalikan' : 'Belum Dikembalikan') // Format nilai
                    ->icon(fn($state) => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')  // Atur ikon
                    ->color(fn($state) => $state === '1' ? 'success' : 'danger')  // Atur warna
                    ->badge(),
                Tables\Columns\TextColumn::make('status_request')
                    ->label('Status')
                    ->badge() // Menampilkan teks sebagai badge
                    ->colors([
                        'warning' => 'pending', // Warna abu-abu untuk pending
                        'info' => 'approved',  // Warna hijau untuk approved
                        'danger' => 'rejected',   // Warna merah untuk rejected
                    ])
                // ->formatStateUsing(fn ($state): string => match($state) {
                //     'pending' => 'Menunggu Persetujuan',
                //     'approved' => 'Disetujui',
                //     'rejected' => 'Ditolak',
                //     default => 'Tidak Diketahui',
                // })
                // Tables\Columns\TextColumn::make('keterangan')
                //     ->searchable(),
            ])
            ->filters([
                SelectFilter::make('fp')
                    ->label('Status')
                    ->options([
                        '1' => 'Dikembalikan',
                        '0' => 'Belum Dikembalikan',
                    ]),
                SelectFilter::make('id_anggota')
                    ->relationship('anggota', 'nama_anggota') // Menggunakan relasi untuk mendapatkan daftar anggota
                    ->label('Anggota')
                    ->preload()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->BulkActions([
                Tables\Actions\DeleteBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_request', 'pending')->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Pending Transaction';
    }

    public static function getWidgets(): array
    {
        return [
            TransaksisOverview::class,
        ];
    }
}
