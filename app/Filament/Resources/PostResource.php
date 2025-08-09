<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = "Berita";
    protected static ?string $navigationGroup = "Kelola Konten";
    protected static ?string $slug = "kelola-berita";
    protected static ?string $label = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('thumbnail')
                    ->label('Gambar')
                    ->image()
                    ->directory('thumbnails') // simpan di storage/app/public/thumbnails
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->downloadable()
                    ->openable()
                    ->maxSize(20480)
                    ->preserveFilenames()
                    ->columnSpan(2),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->placeholder("Masukkan Judul Berita")
                    ->maxLength(255)
                    ->label("Judul Berita")
                    ->reactive()
                    ->debounce(1000)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $slug = Str::slug($state);
                        $set('slug', $slug);
                    }),

                Forms\Components\Select::make('category')
                    ->options([
                        'Berita' => 'Berita',
                        'Artikel' => 'Artikel',
                    ])
                    ->placeholder("Pilih Kategori Berita")
                    ->label("Kategori")
                    ->required(),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->label("slug")
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->label("Konten Berita")
                    ->placeholder("Masukkan Isi konten berita")
                    ->columnSpan('full'),

                Repeater::make('konten_tambahan')
                    ->label('Konten Tambahan')
                    ->schema([
                        FileUpload::make('gambar')
                            ->image()
                            ->label('Gambar')
                            ->directory('berita-konten')
                            ->imagePreviewHeight('150')
                            ->maxSize(2048),

                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Deskripsi')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList', 'undo', 'redo'
                            ]),
                    ])
                    ->default([])
                    ->collapsible()
                    ->addActionLabel('Tambah Konten')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title)
                    ->label("Judul"),

                Tables\Columns\TextColumn::make('category')
                    ->sortable()
                    ->label("Kategori"),
                    
                Tables\Columns\TextColumn::make('content')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->content)
                    ->formatStateUsing(fn ($state) => strip_tags($state))
                    ->label("Konten Berita"),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Update')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                    
            ])
            ->emptyStateHeading('Tidak ada Berita')
            ->emptyStateIcon('heroicon-o-bookmark')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
