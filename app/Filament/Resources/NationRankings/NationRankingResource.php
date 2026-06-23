<?php

namespace App\Filament\Resources\NationRankings; 

use App\Filament\Resources\NationRankings\Pages;
use App\Models\NationRanking;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Validation\Rules\Unique;

class NationRankingResource extends Resource
{
    protected static ?string $model = NationRanking::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-flag';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';
    protected static ?string $navigationLabel = 'Nation Rankings';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('rank')
                ->numeric()
                ->required()
                ->label('Peringkat')
                ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule, callable $get) {
                    return $rule->where('gender', $get('gender'));
                }),

            Select::make('gender')
                ->options([
                    'mens' => "Men's Ranking",
                    'womens' => "Women's Ranking",
                ])
                ->required()
                ->label('Kategori Ranking')
                ->default('mens'),

            TextInput::make('country_name')
                ->label('Nama Negara')
                ->required(),

            // --- INPUT SCORE DITAMBAHKAN DI SINI ---
            TextInput::make('score')
                ->label('Score / Points')
                ->numeric()
                ->default(0)
                ->required(),
            // ---------------------------------------

            FileUpload::make('flag_image')
                ->label('Bendera Negara')
                ->image()
                ->disk('public')
                ->directory('flags'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('rank')
                ->label('Rank')
                ->sortable(),

            ImageColumn::make('flag_image')
                ->label('Bendera'),

            TextColumn::make('country_name')
                ->label('Negara')
                ->searchable(),

            // --- KOLOM SCORE DITAMBAHKAN DI SINI ---
            TextColumn::make('score')
                ->label('Score')
                ->sortable(),
            // ---------------------------------------

            TextColumn::make('gender')
                ->label('Kategori')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'mens' => 'info',
                    'womens' => 'danger',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'mens' => "Men's",
                    'womens' => "Women's",
                })
                ->sortable(),
        ])
        ->defaultSort('rank', 'asc')
        ->filters([
            Tables\Filters\SelectFilter::make('gender')
                ->label('Saring Kategori')
                ->options([
                    'mens' => "Men's Only",
                    'womens' => "Women's Only",
                ])
        ]);
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