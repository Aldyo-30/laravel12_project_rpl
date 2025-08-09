<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficialResource\Pages;
use App\Filament\Resources\OfficialResource\RelationManagers;
use App\Models\Official;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class OfficialResource extends Resource
{
    protected static ?string $model = Official::class;
    protected static ?string $navigationLabel = "Struktur Pemerintahan";
    protected static ?string $navigationGroup = "Kelola Beranda";
    protected static ?string $slug = "kelola-pemerintahan";
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $label = 'Pemerintahan Desa';
    protected static ?string $pluralModelLabel = 'Pemerintahan Desa';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('photo')
                ->image()
                ->disk('public')
                ->directory('officials')
                ->preserveFilenames()
                ->visibility('public')
                ->required()
                ->previewable(true)
                ->label('Foto')
                ->columnSpan(2),

                Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nama'),
                
                Forms\Components\TextInput::make('position')
                ->required()
                ->label('Jabatan')->formatStateUsing(fn ($state) => strtoupper($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                ->label('Image')
                ->circular(),

                Tables\Columns\TextColumn::make('name')
                ->label('Nama'),

                Tables\Columns\TextColumn::make('position')
                ->label('Jabatan'),
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
            'index' => Pages\ListOfficials::route('/'),
            'create' => Pages\CreateOfficial::route('/create'),
            'edit' => Pages\EditOfficial::route('/{record}/edit'),
        ];
    }
}
