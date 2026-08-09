<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Categories';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Category Details')->schema([
                TextInput::make('name')
                    ->label('Category Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, $set) =>
                        $set('slug', Str::slug($state))
                    )
                    ->rule(function ($component) {
                        return function (string $attribute, $value, \Closure $fail) use ($component) {
                            $record = $component->getRecord();

                            $exists = Category::where('slug', Str::slug($value))
                                ->when($record, fn ($query) => $query->whereKeyNot($record))
                                ->exists();

                            if ($exists) {
                                $fail('This name generates a slug that is already in use. Please choose a different name.');
                            }
                        };
                    })
                    ->validationMessages([
                        'unique' => 'A category with this name already exists. Please choose a unique name.',
                    ]),

                Hidden::make('slug')
                    ->required(),
            ])->columns(1),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}