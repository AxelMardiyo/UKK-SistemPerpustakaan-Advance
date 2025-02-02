<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pustaka;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\TransaksiResource\Pages;
use App\Filament\User\Resources\TransaksiResource\RelationManagers;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_pustaka')
                    ->default(fn () => Pustaka::find(request('id_pustaka'))->id_pustaka)
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_anggota')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tgl_pinjam')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_kembali')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_pengembalian'),
                Forms\Components\TextInput::make('fp')
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pustaka')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_anggota')
                    ->numeric()
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
                Tables\Columns\TextColumn::make('fp'),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
