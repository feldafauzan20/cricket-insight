<?php

namespace App\Filament\Resources\NewsFlashes; 

use App\Filament\Resources\NewsFlashes\Pages;
use App\Models\NewsFlash;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class NewsFlashResource extends Resource
{
    protected static ?string $model = NewsFlash::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bolt';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('News Flash Details')->schema([
                TextInput::make('title')->required(),
                Textarea::make('description'),
                Toggle::make('is_active')->default(true),
            ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            IconColumn::make('is_active')->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsFlashes::route('/'),
            'create' => Pages\CreateNewsFlash::route('/create'),
            'edit' => Pages\EditNewsFlash::route('/{record}/edit'),
        ];
    }
}