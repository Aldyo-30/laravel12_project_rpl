<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
use App\Filament\Resources\WisataResource\RelationManagers;
use App\Models\Wisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $slug = "kelola-wisata";
    protected static ?string $navigationGroup = "Kelola Konten";
    protected static ?string $navigationLabel = 'Wisata';
    protected static ?string $modelLabel = 'Wisata';
    protected static ?string $pluralModelLabel = 'Wisata';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar')
                    ->label('Gambar Utama')
                    ->image()
                    ->directory('wisata')
                    ->visibility('public')
                    ->maxSize(20480)
                    ->required(),

                FileUpload::make('gambar1')
                    ->label('Gambar 2')
                    ->image()
                    ->directory('wisata')
                    ->visibility('public')
                    ->maxSize(20480),

                FileUpload::make('gambar2')
                    ->label('Gambar 3')
                    ->image()
                    ->directory('wisata')
                    ->visibility('public')
                    ->maxSize(20480),

                FileUpload::make('gambar3')
                    ->label('Gambar 4')
                    ->image()
                    ->directory('wisata')
                    ->visibility('public')
                    ->maxSize(20480),

                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->placeholder("Masukkan Judul Wisata")
                    ->maxLength(255)
                    ->live(debounce: 800)
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state) && is_string($state)) {
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Slug wisata sudah ada sebelumnya.'
                    ]),

                TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->placeholder("Masukan Harga")
                    ->prefix('Rp ')
                    ->minValue(0),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi')
                    ->placeholder("Masukkan Isi Deskripsi")
                    ->columnSpan('full'),

                TextInput::make('nama_pemilik')
                    ->label('Nama Pemilik')
                    ->placeholder("Masukkan Nama")
                    ->maxLength(255),

                TextInput::make('telepon')
                    ->label('Telepon')
                    ->placeholder("Contoh: +62 673-7878-8390")
                    ->tel()
                    ->maxLength(20),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->placeholder("Masukkan Alamat")
                    ->rows(3)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular()
                    ->size(60),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_pemilik')
                    ->label('Nama Pemilik')
                    ->searchable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Tanggal Update')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListWisatas::route('/'),
            'create' => Pages\CreateWisata::route('/create'),
            'edit' => Pages\EditWisata::route('/{record}/edit'),
        ];
    }
}
