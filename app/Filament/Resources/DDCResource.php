<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DDCResource\Pages;
use App\Filament\Resources\DDCResource\RelationManagers;
use App\Models\DDC;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;

use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DDCResource extends Resource
{
    protected static ?string $model = DDC::class;
    protected static ?string $modelLabel = 'DDC';
    protected static ?string $pluralModelLabel = 'DDC';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_rak')
                    ->required()
                    ->relationship(name: 'rak', titleAttribute: 'kode_rak'),
                Forms\Components\TextInput::make('kode_ddc')
                    ->maxLength(3)
                    ->regex('/^\d{3}$/')
                    ->helperText('Kode DDC harus berupa 3 digit angka, contoh: "123".')
                    ->unique()
                    ->required(),
                Forms\Components\TextInput::make('ddc')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_rak')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_ddc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ddc')
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
            'index' => Pages\ListDDCS::route('/'),
            'create' => Pages\CreateDDC::route('/create'),
            'edit' => Pages\EditDDC::route('/{record}/edit'),
        ];
    }
}
