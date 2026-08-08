<?php

namespace App\Filament\Resources\Tags;

use App\Filament\Resources\Tags\Pages;
use App\Models\Tag;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\TextColumn;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Tags';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Tag Name')
                ->required()
                ->unique(ignoreRecord: true)
                ->validationMessages([
                    'unique' => 'A tag with this name already exists. Please choose a unique name.',
                ])
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),

            Hidden::make('slug')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('slug'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
}