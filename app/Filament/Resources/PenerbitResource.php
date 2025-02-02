<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenerbitResource\Pages;
use App\Filament\Resources\PenerbitResource\RelationManagers;
use App\Models\Penerbit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenerbitResource extends Resource
{
    protected static ?string $model = Penerbit::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $pluralModelLabel = 'Penerbit';

    protected static ?string $navigationGroup = 'Koleksi Pustaka';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_penerbit')
                    ->required()
                    ->maxLength(10)
                    ->regex('/^PN\d{3}$/')
                    ->helperText('Format harus PN diikuti 3 digit angka, contoh: PN123'),
                Forms\Components\TextInput::make('nama_penerbit')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('alamat_penerbit')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('no_telp')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('fax')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('website')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kontak')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_penerbit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_penerbit')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('alamat_penerbit')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('no_telp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPenerbits::route('/'),
            'create' => Pages\CreatePenerbit::route('/create'),
            'edit' => Pages\EditPenerbit::route('/{record}/edit'),
        ];
    }
}
