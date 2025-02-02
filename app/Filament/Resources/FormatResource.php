<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormatResource\Pages;
use App\Filament\Resources\FormatResource\RelationManagers;
use App\Models\Format;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormatResource extends Resource
{
    protected static ?string $model = Format::class;
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_format')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('format')
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
                Tables\Columns\TextColumn::make('kode_format')
                    ->searchable(),
                Tables\Columns\TextColumn::make('format')
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
            'index' => Pages\ListFormats::route('/'),
            'create' => Pages\CreateFormat::route('/create'),
            'edit' => Pages\EditFormat::route('/{record}/edit'),
        ];
    }
}
