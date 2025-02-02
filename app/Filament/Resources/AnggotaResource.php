<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Anggota;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\ViewAction;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\Laravel\Facades\Image;
use App\Filament\Resources\AnggotaResource\Pages;
use App\Filament\Resources\AnggotaResource\RelationManagers;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Keanggotaan';
    protected static ?string $pluralModelLabel = 'Anggota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_jenis_anggota')
                    ->options(function () {
                        if (auth()->user()->id_jenis_anggota == 4) {
                            return [
                                1 => 'Siswa',
                                2 => 'Guru'
                            ];
                        } else {
                            return [
                                1 => 'Administrator',
                                2 => 'Pustakawan',
                                3 => 'Siswa',
                                4 => 'Guru',
                            ];
                        }
                    })
                    ->required(),
                Forms\Components\TextInput::make('kode_anggota')
                    ->label('Kode Anggota')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_anggota')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('tempat')
                    ->required()
                    ->maxLength(20),
                Forms\Components\DatePicker::make('tgl_lahir')
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(225),
                Forms\Components\TextInput::make('no_telp')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(30),
                Forms\Components\DatePicker::make('tgl_daftar')
                    ->required(),
                Forms\Components\DatePicker::make('masa_aktif')
                    ->required(),
                Forms\Components\TextInput::make('fa')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(45),
                Forms\Components\FileUpload::make('foto')
                    ->directory('images/anggota')->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => $state ? bcrypt($state) : null)
                    // ->readonly()
                    ->required()
                    ->maxLength(225),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenisAnggota.jenis_anggota')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Administrator' => 'info',
                        'Pustakawan' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('kode_anggota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_anggota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(), 
                Tables\Columns\IconColumn::make('fa')
                    ->label('Active')
                    ->icon(fn ($state) => $state === 'Y' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->color(fn ($state) => $state === 'Y' ? 'success' : 'danger')
            ])
            ->filters([
                SelectFilter::make('jenis_anggota')
                    ->relationship('jenisAnggota', 'jenis_anggota'),
                SelectFilter::make('fa')
                    ->label('Status')
                    ->options([
                        'Y' => 'Aktif',
                        'N' => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->disabled(fn($record) => $record->id_jenis_anggota === 1)
                    ->color(fn($record) => $record->id_jenis_anggota === 1 ? 'gray' : 'info'),
                Tables\Actions\ViewAction::make()
                    ->color('warning'),
                // Tables\Actions\Action::make('generate_id_card')
                //     ->label('Generate ID Card')
                //     ->icon('heroicon-o-document-text')
                //     ->action(function ($record) {
                //         $fileUrl = static::generateMemberCard($record); 
                //         return redirect($fileUrl);
                //     })
                //     ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->action(function (Collection $records) {
                    foreach ($records as $record) {
                        try {
                            $record->delete();
                        } catch (QueryException $e) {
                            if ($e->getCode() == "23000") { // Foreign Key Constraint Error
                                Notification::make()
                                    ->title('Gagal Menghapus')
                                    ->danger()
                                    ->body('Data anggota ini terkait dengan transaksi lain. Hapus transaksi terkait terlebih dahulu.')
                                    ->send();

                                return; // Hentikan eksekusi jika ada error
                            }

                            throw $e; // Jika bukan error yang dikenali, biarkan error dilempar
                        }
                    }

                    Notification::make()
                        ->title('Berhasil')
                        ->success()
                        ->body('Data berhasil dihapus.')
                        ->send();
                })
                ->requiresConfirmation()
                ->label('Hapus Data')
                ->color('danger')
                ->icon('heroicon-o-trash'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationBadge(): ?string
    {
        return Anggota::where('fa', 'T')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Inactive users';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit' => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }

    protected static function generateMemberCard($record): string
    {
        $member = Anggota::find($record->id_anggota);

        $width = 850;
        $height = 540;

        $image = Image::create($width, $height, '#FFFFFF');

        $photoPath = storage_path('app/public/' . $member->foto);
        if (file_exists($photoPath)) {
            $image->place($photoPath, 'top-left', 5,5,5);
        }

        $image->text($member->nama_anggota, 120, 100, function($font) {
            $font->file(public_path('fonts/Arial.ttf'));
            $font->size(20);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });

        $image->text($member->kode_anggota, 120, 150, function($font) {
            $font->file(public_path('fonts/Arial.ttf'));
            $font->size(18);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });

        $image->text('Alamat: ' . $member->alamat, 120, 200, function($font) {
            $font->file(public_path('fonts/Arial.ttf'));
            $font->size(14);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });

        $filename = 'idcard-' . $member->id_anggota . '.png';
        $path = storage_path("app/public/kartu-anggota/$filename");

        $image->save($path);

        return Storage::url("kartu-anggota/$filename");
    }
}
