<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pustaka;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\PustakaResource\Pages;
use App\Filament\User\Resources\PustakaResource\RelationManagers;

class PustakaResource extends Resource
{
    protected static ?string $model = Pustaka::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\Layout\Stack::make([
                Tables\Columns\ImageColumn::make('gambar')
                    ->height(150)
                    ->width(120),
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('judul_pustaka')
                        ->weight(FontWeight::Bold),
                    Tables\Columns\TextColumn::make('penerbit.nama_penerbit')
                ]),
            ])->space(3),
            Tables\Columns\Layout\Panel::make([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\ColorColumn::make('tahun_terbit')
                        ->grow(false),
                    Tables\Columns\TextColumn::make('harga_buku')
                        ->color('gray'),
                ]),
            ])->collapsible(),
        ])
        ->filters([
            //
        ])
        ->contentGrid([
            'md' => 4,
            'xl' => 5,
        ])
        ->paginated([
            15,
            25,
            50,
            'all',
        ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('checkout')
                    // ->url(fn (Pustaka $record): string => route('pustaka.checkout', $record))
                    ->url(fn (\App\Models\Pustaka $record) => route('transaksi.create', ['id_pustaka' => $record->id]))
                    ->icon('heroicon-o-arrow-right-on-rectangle')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('kode_pustaka')
                                            ->label('Kode Pustaka')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('ddc.kode_ddc')
                                            ->label('Kode DDC')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('penerbit.nama_penerbit')
                                            ->label('Penerbit')
                                            ->badge()
                                            ->color('info'),
                                        
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('judul_pustaka')
                                            ->label('Judul')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('ddc.ddc')
                                            ->label('Judul DDC')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('pengarang.nama_pengarang')
                                            ->label('Pengarang')
                                            ->badge()
                                            ->color('info'),
                                        
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('isbn')
                                            ->label('ISBN')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('keyword')
                                            ->label('Keyword')
                                            ->badge()
                                            ->color('info'),
                                        Components\TextEntry::make('tahun_terbit')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                ]),
                            Components\ImageEntry::make('gambar')
                                ->hiddenLabel()
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Section::make('Deskripsi')
                    ->schema([
                        Components\TextEntry::make('abstraksi'),
                        Components\Split::make([
                            Components\TextEntry::make('keterangan_fisik')
                                ->label('Keterangan Fisik'),
                            Components\TextEntry::make('keterangan_tambahan')
                                ->label('Keterangan Tambahan'),
                            Components\TextEntry::make('kondisi_buku')
                                ->label('Kondisi Buku'),
                        ]),
                ])
                ->collapsible(),
                Components\Section::make('Keterangan')
                    ->schema([
                    Components\Split::make([
                            Components\TextEntry::make('fp')
                            ->label('FP')
                            ->badge()
                            ->color('info'),
                            Components\TextEntry::make('jml_pinjam'),
                            Components\TextEntry::make('denda_terlambat'),
                            Components\TextEntry::make('denda_hilang'),
                        ]),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPustakas::route('/'),
        ];
    }
}
