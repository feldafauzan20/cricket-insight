<?php

namespace App\Filament\Resources\SocialMedia; 

use App\Filament\Resources\SocialMedia\Pages;

use App\Models\SocialMedia;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-share';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';
    protected static ?string $navigationLabel = 'Social Media';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Social Media Details')->schema([
                TextInput::make('platform_name')
                    ->label('Nama Platform')
                    ->required(),
                TextInput::make('sosmed_link')
                    ->label('Sosmed Link')
                    ->placeholder('https://...')
                    ->url(),
                Textarea::make('embed_url')
                    ->label('Embed Link / Script')
                    ->rows(3),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('platform_name')
                ->label('Platform')
                ->searchable(),
            TextColumn::make('sosmed_link')
                ->label('Sosmed Link')
                ->limit(35)
                ->searchable(),
            TextColumn::make('embed_url')
                ->label('Embed Link')
                ->limit(35),
            IconColumn::make('is_active')
                ->label('Aktif')
                ->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialMedia::route('/'),
            'create' => Pages\CreateSocialMedia::route('/create'),
            'edit' => Pages\EditSocialMedia::route('/{record}/edit'),
        ];
    }
}