<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengarangResource\Pages;
use App\Filament\Resources\PengarangResource\RelationManagers;
use App\Models\Pengarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengarangResource extends Resource
{
    protected static ?string $model = Pengarang::class;
    protected static ?string $modelLabel = 'Pengarang';
    protected static ?string $pluralModelLabel = 'Pengarang';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Koleksi Pustaka';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_pengarang')
                    ->required()
                    ->maxLength(10)
                    ->regex('/^PG\d{3}$/')
                    ->helperText('Format harus PG diikuti 3 digit angka, contoh: PG123'),
                Forms\Components\TextInput::make('gelar_depan')
                    ->maxLength(10),
                Forms\Components\TextInput::make('nama_pengarang')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('gelar_belakang')
                    ->maxLength(10),
                Forms\Components\TextInput::make('no_telp')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('website')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Textarea::make('biografi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_pengarang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gelar_depan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pengarang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gelar_belakang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
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
            'index' => Pages\ListPengarangs::route('/'),
            'create' => Pages\CreatePengarang::route('/create'),
            'edit' => Pages\EditPengarang::route('/{record}/edit'),
        ];
    }
}
