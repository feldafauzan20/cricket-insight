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

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Social Media Details')->schema([
                TextInput::make('platform_name')->label('Nama Platform')->required(),
                Textarea::make('embed_url')->label('Link / Script Embed')->required(),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('platform_name')->searchable(),
            TextColumn::make('sort_order')->sortable(),
            IconColumn::make('is_active')->boolean(),
        ])->defaultSort('sort_order', 'asc');
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