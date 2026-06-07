<?php

namespace App\Filament\Resources\NationRankings; 

use App\Filament\Resources\NationRankings\Pages;
use App\Models\NationRanking;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class NationRankingResource extends Resource
{
    protected static ?string $model = NationRanking::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-flag';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('rank')->numeric()->unique(ignoreRecord: true)->required(),
            TextInput::make('country_name')->required(),
            FileUpload::make('flag_image')->image()->disk('public')->directory('flags'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('rank')->sortable(),
            ImageColumn::make('flag_image'),
            TextColumn::make('country_name')->searchable(),
        ])->defaultSort('rank', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNationRankings::route('/'),
            'create' => Pages\CreateNationRanking::route('/create'),
            'edit' => Pages\EditNationRanking::route('/{record}/edit'),
        ];
    }
}