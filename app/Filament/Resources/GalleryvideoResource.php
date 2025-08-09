<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GalleryvideoResource\Pages;
use App\Filament\Resources\GalleryvideoResource\RelationManagers;

class GalleryvideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Kelola Konten';
    protected static ?string $navigationLabel = 'Video';
    protected static ?string $pluralModelLabel = 'Video';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('link_youtube')
                    ->label('Link YouTube')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('deskripsi')
                    ->required()
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->rows(10)
                    ->placeholder("Masukkan Deskripsi/Penjelasan dari Video"),

                DatePicker::make('tanggal')
                    ->label('Tanggal Upload')
                    ->helperText('Isi tanggal upload dari video youtube'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('link_youtube')
                    ->label('Link YouTube')
                    ->limit(20),

                TextColumn::make('tanggal')
                    ->label('Tanggal Upload')
                    ->date(),
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
            'index' => Pages\ListGalleryvideos::route('/'),
            'create' => Pages\CreateGalleryvideo::route('/create'),
            'edit' => Pages\EditGalleryvideo::route('/{record}/edit'),
        ];
    }
}
