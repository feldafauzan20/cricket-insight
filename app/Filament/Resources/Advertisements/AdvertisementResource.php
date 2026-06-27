<?php

namespace App\Filament\Resources\Advertisements;

use App\Filament\Resources\Advertisements\Pages;
use App\Models\Advertisement;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Ads Manager';
    protected static ?string $slug = 'advertisements';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detail Iklan')->schema([
                TextInput::make('title')
                    ->label('Nama Campaign Iklan')
                    ->required(),
                
                Select::make('position')
                    ->label('Posisi Iklan')
                    ->options([
                        'home_top' => 'Homepage - Tengah Atas',
                        'home_middle' => 'Homepage - Sidebar Kanan',
                        'home_bottom' => 'Homepage - Tengah Bawah',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Satu posisi hanya bisa diisi 1 iklan aktif.'),
                
                FileUpload::make('image')
                    ->label('Gambar Iklan')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->disk('public')
                    ->directory('ads')
                    ->required(),
                
                TextInput::make('link')
                    ->label('Link URL Tujuan')
                    ->url()
                    ->helperText('Kosongkan jika iklan tidak bisa diklik.'),
                
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->label('Banner'),
            TextColumn::make('title')->label('Nama Campaign')->searchable(),
            TextColumn::make('position')
                ->label('Posisi')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'home_top' => 'success',
                    'home_middle' => 'warning',
                    'home_bottom' => 'info',
                    default => 'gray',
                }),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
        ];
    }
}