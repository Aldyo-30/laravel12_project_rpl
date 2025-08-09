<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Penduduk';
    protected static ?string $navigationGroup = 'Kelola Infografis';
    protected static ?string $modelLabel = 'Penduduk';
    protected static ?string $pluralModelLabel = 'Penduduk';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kepala_keluarga')
                    ->label('Jumlah Kepala Keluarga')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('laki_laki')
                    ->label('Jumlah Laki-laki')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->debounce(1000)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $set('total', ($state ?? 0) + ($get('perempuan') ?? 0));
                    }),

                Forms\Components\TextInput::make('perempuan')
                    ->label('Jumlah Perempuan')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->debounce(1000)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $set('total', ($get('laki_laki') ?? 0) + ($state ?? 0));
                    }),

                Forms\Components\TextInput::make('total')
                    ->label('Total Penduduk')
                    ->numeric()
                    ->readOnly()
                    ->default(fn($get) => ($get('laki_laki') ?? 0) + ($get('perempuan') ?? 0))
                    ->reactive(),

                Forms\Components\TextInput::make('desa')
                    ->label('Jumlah Dusun')
                    ->numeric()
                    ->default(5)
                    ->required(),

                Forms\Components\TextInput::make('dusun_1')
                    ->label('Jumlah Penduduk Dusun Ngrawan')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dusun_2')
                    ->label('Jumlah Penduduk Dusun Tanon')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dusun_3')
                    ->label('Jumlah Penduduk Dusun Padan')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dusun_4')
                    ->label('Jumlah Penduduk Dusun Ploso')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('dusun_5')
                    ->label('Jumlah Penduduk Dusun Tegalsari')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kepala_keluarga')
                    ->label('Kepala Keluarga'),
                
                Tables\Columns\TextColumn::make('laki_laki')
                    ->label('Laki-laki'),

                Tables\Columns\TextColumn::make('perempuan')
                    ->label('Perempuan'),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total Penduduk'),

                Tables\Columns\TextColumn::make('desa')
                    ->label('Total Dusun'),

                Tables\Columns\TextColumn::make('dusun_1')
                    ->label('Dusun Ngrawan'),

                Tables\Columns\TextColumn::make('dusun_2')
                    ->label('Dusun Tanon'),

                Tables\Columns\TextColumn::make('dusun_3')
                    ->label('Dusun Padan'),

                Tables\Columns\TextColumn::make('dusun_4')
                    ->label('Dusun Ploso'),

                Tables\Columns\TextColumn::make('dusun_5')
                    ->label('Dusun Tegalsari'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
