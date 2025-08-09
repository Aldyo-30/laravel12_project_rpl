<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\WelcomeSetting;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WelcomeSettingResource\Pages;
use App\Filament\Resources\WelcomeSettingResource\RelationManagers;

class WelcomeSettingResource extends Resource
{
    protected static ?string $model = WelcomeSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'Welcome Section';
    protected static ?string $pluralModelLabel = 'Welcome Section';
    protected static ?string $navigationGroup = "Kelola Beranda";
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->label('Gambar')
                    ->directory('welcome-images')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label("Judul")
                    ->default("Desa Ngrawan")
                    ->required()
                    ->columnSpanFull(),

                RichEditor::make('description')
                    ->label("Deskripsi")
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title)
                    ->label("Judul"),

                Tables\Columns\TextColumn::make('description')
                    ->label("Deskripsi")
                    ->limit(40)
                    ->formatStateUsing(fn ($state) => strip_tags($state)),

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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWelcomeSettings::route('/'),
            'create' => Pages\CreateWelcomeSetting::route('/create'),
            'view' => Pages\ViewWelcomeSetting::route('/{record}'),
            'edit' => Pages\EditWelcomeSetting::route('/{record}/edit'),
        ];
    }
}
