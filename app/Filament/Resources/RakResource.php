<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RakResource\Pages;
use App\Filament\Resources\RakResource\RelationManagers;
use App\Models\Rak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RakResource extends Resource
{
    protected static ?string $model = Rak::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $pluralModelLabel = 'Rak';

    protected static ?string $navigationGroup = 'Data Master';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_rak')
                ->required()
                ->maxLength(10)
                ->regex('/^RAK-\d{3}$/')
                ->helperText('Format: "RAK-001", "RAK-002", dst.')
                ->unique(),
                // ->errorMessage('Kode rak tidak valid. Pastikan formatnya "RAK-XXX" dengan 3 digit angka.'),
                Forms\Components\TextInput::make('rak')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_rak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListRaks::route('/'),
            'create' => Pages\CreateRak::route('/create'),
            'edit' => Pages\EditRak::route('/{record}/edit'),
        ];
    }
}
