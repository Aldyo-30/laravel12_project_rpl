<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Sejarah;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SejarahResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SejarahResource\RelationManagers;

class SejarahResource extends Resource
{
    protected static ?string $model = Sejarah::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Sejarah';
    protected static ?string $pluralModelLabel = 'Sejarah';
    protected static ?string $navigationGroup = "Kelola Beranda";
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gambar')
                    ->label("Gambar")
                    ->image()
                    ->directory('sejarah')
                    ->maxSize(2048)
                    ->columnSpanFull(),

                TextInput::make('judul')
                    ->label("Judul Sejarah")
                    ->required()
                    ->live()
                    ->reactive()
                    ->default("Sejarah Desa Ngrawan")
                    ->debounce(800)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $slug = Str::slug($state);
                        $set('slug', $slug);
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->dehydrated()
                    ->label("slug")
                    ->maxLength(255),

                RichEditor::make('isi')
                    ->label("Konten Sejarah")
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->circular(),

                TextColumn::make('judul')
                    ->label("Judul Sejarah")
                    ->sortable()
                    ->searchable(),

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
            'index' => Pages\ListSejarahs::route('/'),
            'create' => Pages\CreateSejarah::route('/create'),
            'edit' => Pages\EditSejarah::route('/{record}/edit'),
        ];
    }
}
