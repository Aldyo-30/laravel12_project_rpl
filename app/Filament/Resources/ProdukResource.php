<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $slug = "kelola-produk";
    protected static ?string $navigationGroup = "Kelola Konten";
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $modelLabel = 'Produk';
    protected static ?string $pluralModelLabel = 'Produk';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar_path')
                    ->label('Gambar Utama')
                    ->image()
                    ->imageEditor()
                    ->directory('produk')
                    ->visibility('public')
                    ->maxSize(20480)
                    ->required(),

                FileUpload::make('gambar1')
                    ->label('Gambar 2')
                    ->image()
                    ->imageEditor()
                    ->directory('produk')
                    ->visibility('public')
                    ->maxSize(20480),

                FileUpload::make('gambar2')
                    ->label('Gambar 3')
                    ->image()
                    ->imageEditor()
                    ->directory('produk')
                    ->visibility('public')
                    ->maxSize(20480),

                FileUpload::make('gambar3')
                    ->label('Gambar 4')
                    ->image()
                    ->imageEditor()
                    ->directory('produk')
                    ->visibility('public')
                    ->maxSize(20480),

                TextInput::make('nama')
                    ->label('Nama Produk')
                    ->required()
                    ->placeholder("Masukkan Nama Produk")
                    ->maxLength(255)
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function (?string $state, callable $set) {
                        if (!empty($state)) {
                            $set('slug', Str::slug($state));
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
                        'unique' => 'Nama slug sudah ada sebelumnya.'
                    ]),

                TextInput::make('harga')
                    ->label('Harga')
                    ->placeholder("Masukkan Harga")
                    ->numeric()
                    ->prefix('Rp '),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi')
                    ->placeholder("Masukkan Isi Deskripsi")
                    ->columnSpan('full'),

                Select::make('jenis_makanan')
                    ->label('Jenis Produk')
                    ->options([
                        'makanan/minuman' => 'Makanan/Minuman',
                        'kerajinan' => 'Kerajinan',
                    ])
                    ->required(),

                TextInput::make('bahan_utama')
                    ->label('Bahan Utama')
                    ->placeholder("Masukan Bahan Utama")
                    ->maxLength(255),

                TextInput::make('nama_penjual')
                    ->label('Nama Penjual')
                    ->placeholder("Masukkan Nama Penjual")
                    ->maxLength(255),

                TextInput::make('telepon_penjual')
                    ->label('Telepon Penjual')
                    ->placeholder("Contoh: +62 673-7878-8390")
                    ->tel()
                    ->maxLength(20),

                Textarea::make('alamat_penjual')
                    ->label('Alamat Penjual')
                    ->placeholder("Masukkan Alamat")
                    ->rows(3)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar_path')
                    ->label('Gambar')
                    ->circular()
                    ->size(60),

                TextColumn::make('nama')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin!')
                    ->copyMessageDuration(1500),

                TextColumn::make('jenis_makanan')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'makanan' => 'success',
                        'kerajinan' => 'info',
                        default => 'secondary',
                    }),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('nama_penjual')
                    ->label('Penjual')
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Tanggal Update')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_makanan')
                    ->label('Jenis Makanan')
                    ->options([
                        'makanan' => 'Makanan',
                        'kerajinan' => 'Kerajinan',
                    ]),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
