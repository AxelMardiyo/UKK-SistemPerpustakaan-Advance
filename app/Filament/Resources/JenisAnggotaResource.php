<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisAnggotaResource\Pages;
use App\Filament\Resources\JenisAnggotaResource\RelationManagers;
use App\Models\JenisAnggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisAnggotaResource extends Resource
{
    protected static ?string $model = JenisAnggota::class;
    protected static ?string $pluralModelLabel = 'Jenis Anggota';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Keanggotaan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_jenis_anggota')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('jenis_anggota')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('max_pinjam')
                    ->required()
                    ->maxLength(5),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_jenis_anggota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_anggota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_pinjam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->id_jenis_anggota === 1),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJenisAnggotas::route('/'),
            'create' => Pages\CreateJenisAnggota::route('/create'),
            // 'edit' => Pages\EditJenisAnggota::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return auth()->user()->id_jenis_anggota === 1;
    }
    public static function canUpdate(): bool
    {
        return auth()->user()->id_jenis_anggota === 1;
    }
}
