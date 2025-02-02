<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pustaka;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Components\SpatieTagsEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\SpatieTagsInput;
use App\Filament\Resources\PustakaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PustakaResource\RelationManagers;
use App\Filament\Resources\PustakaResource\Pages\EditPustaka;
use App\Filament\Resources\PustakaResource\Pages\ViewPustaka;
use App\Filament\Resources\PustakaResource\Pages\ListPustakas;
use App\Filament\Resources\PustakaResource\Pages\CreatePustaka;

class PustakaResource extends Resource
{
    protected static ?string $model = Pustaka::class;
    protected static ?string $modelLabel = 'Pustaka';
    protected static ?string $pluralModelLabel = 'Pustaka';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Koleksi Pustaka';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kode_pustaka')
                        ->required()
                        ->helperText('Contoh: 112, 100, 101, dst.')
                        ->regex('/^\d{3}$/')
                        ->numeric(),
                        Forms\Components\Select::make('id_ddc')
                            ->label('ID DDC')
                            ->relationship(name: 'ddc', titleAttribute: 'ddc')
                            ->required(),
                        Forms\Components\Select::make('id_format')
                            ->label('Format')
                            ->relationship(name: 'format', titleAttribute: 'format')
                            ->required(),
                        Forms\Components\Select::make('id_penerbit')
                            ->label('Penerbit')
                            ->relationship(name: 'penerbit', titleAttribute: 'nama_penerbit')
                            ->required(),
                        Forms\Components\Select::make('id_pengarang')
                            ->label('Pengarang')
                            ->relationship(name: 'pengarang', titleAttribute: 'nama_pengarang')
                            ->required(),
                        Forms\Components\TextInput::make('isbn')
                            ->label('ISBN')
                            ->required()
                            ->regex('/^(97(8|9))?\d{9}(\d|X)$/')  // Regex untuk ISBN-13 atau ISBN-10
                            ->helperText('Contoh: 978-3-16-148410-0 atau 123456789X')
                            ->maxLength(20), 
                        ]),
                        Grid::make()
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('judul_pustaka')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('tahun_terbit')
                                    ->required()
                                    ->regex('/^\d{4}$/')
                                    ->placeholder('2024'),
                                Forms\Components\TextInput::make('keyword')
                                    ->required()
                                    ->maxLength(50),
                            ]),
                        
                        Forms\Components\TextInput::make('keterangan_fisik')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('keterangan_tambahan')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\MarkdownEditor::make('abstraksi')
                            ->disableToolbarButtons([
                                'blockquote',
                                'strike',
                                'codeBlock',
                                'attachFiles'
                            ])
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('gambar')
                            ->directory('images/pustaka')
                            // ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->required()
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('harga_buku')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('kondisi_buku')
                                ->required()
                                ->maxLength(15),
                        Forms\Components\Select::make('fp')
                            ->options([
                                '1' => 'Yes',
                                '0' => 'No',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('stok')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('denda_terlambat')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('denda_hilang')
                            ->required()
                            ->numeric(),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Grid::make()
                    ->columns(1)
                    ->Schema([
                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\Layout\Grid::make()
                            ->columns(1)
                            ->schema([
                                Tables\Columns\ImageColumn::make('gambar')
                                    ->height(180)
                                    ->width(150)
                                    ->extraImgAttributes([
                                        'class' => 'rounded-md'
                                    ]),
                            ])->grow(false),

                            Tables\Columns\Layout\Stack::make([
                                Tables\Columns\TextColumn::make('judul_pustaka')
                                    ->searchable()
                                    ->weight(FontWeight::Bold),
                                Tables\Columns\TextColumn::make('ddc.ddc'),
                                Tables\Columns\TextColumn::make('sisa')
                                    ->formatStateUsing(fn ($state) => "Jumlah Tersisa: $state"),
                                Tables\Columns\TextColumn::make('tahun_terbit')
                                    ->formatStateUsing(fn ($state) => "Tahun Terbit: $state")
                                    ->icon('heroicon-o-calendar-days'),
                                Tables\Columns\TextColumn::make('format.format')
                                    ->color(fn (string $state): string => match ($state) {
                                        'Ebook' => 'success',
                                        'Fisik' => 'info',
                                        'Jurnal' => 'warning',

                                    })
                                    ->badge(),
                                Tables\Columns\IconColumn::make('fp')
                                    ->label('Active')
                                    ->icon(fn ($state) => $state == 1 ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')  // Mengatur ikon
                                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger'),
                            ])->extraAttributes([
                                'class' => 'space-y-2'
                            ])->grow()
                        ])
                    ])
            ])->contentGrid([
                'md' => 2,
                'xl' => 3
            ])
            ->filters([
                SelectFilter::make('format_id')
                    ->relationship('format', 'Format')
                    ->label('Format')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('ddc_id')
                    ->relationship('ddc', 'DDC')
                    ->label('DDC')
                    ->preload()
                    ->multiple(),
                SelectFilter::make('fp')
                    ->label('Status')
                    ->preload()
                    ->options([
                        '1' => 'Active',
                        '0' => 'InActive',
                    ]),
            ])
            ->paginated([
                15,
                25,
                50,
                'all',
            ])
            ->actions([
                // Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                // ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
                Components\Section::make('Deskripsi')
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
                            Components\TextEntry::make('stok'),
                            Components\TextEntry::make('jml_pinjam'),
                            Components\TextEntry::make('sisa'),
                            Components\TextEntry::make('denda_terlambat'),
                            Components\TextEntry::make('denda_hilang'),
                        ]),
                ])
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPustakas::route('/'),
            'create' => Pages\CreatePustaka::route('/create'),
            // 'view' => Pages\ViewPustaka::route('/{record}'),
            'edit' => Pages\EditPustaka::route('/{record}/edit'),
        ];
    }
}
