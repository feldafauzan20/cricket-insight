<?php

namespace App\Filament\Resources\Articles;

use App\Filament\Resources\Articles\Pages;
use App\Models\Article;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ArticlesResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $pluralModelLabel = 'Articles';
    protected static ?string $slug = 'articles';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Article Content')->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, $set) =>
                        $set('slug', Str::slug($state))
                    )
                    ->rule(function ($component) {
                        return function (string $attribute, $value, \Closure $fail) use ($component) {
                            $record = $component->getRecord();

                            $exists = Article::where('slug', Str::slug($value))
                                ->when($record, fn ($query) => $query->whereKeyNot($record))
                                ->exists();

                            if ($exists) {
                                $fail('This title generates a slug that is already in use. Please choose a different title.');
                            }
                        };
                    })
                    ->validationMessages([
                        'unique' => 'An article with this title already exists. Please choose a unique title.',
                    ]),

                Hidden::make('slug')
                    ->required(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail Photo')
                    ->image()
                    ->disk('public')
                    ->directory('news'),

                FileUpload::make('foto1')
                    ->label('Additional Photo 1')
                    ->image()
                    ->disk('public')
                    ->directory('news'),

                FileUpload::make('foto2')
                    ->label('Additional Photo 2')
                    ->image()
                    ->disk('public')
                    ->directory('news'),

                Textarea::make('description')
                    ->label('Summary / Description')
                    ->rows(3),

                RichEditor::make('content')
                    ->label('Content Body')
                    ->required(),
            ])->columnSpan(2),

            Section::make('Settings & Categorization')->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->whereNotIn('slug', ['gallery', 'magazine'])
                    )
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('user_id')
                    ->label('Uploader / Journalist')
                    ->relationship('uploader', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('New Tag Name')
                            ->required()
                            ->unique('tags', 'name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, $set) =>
                                $set('slug', Str::slug($state))
                            )
                            ->rule(function () {
                                return function (string $attribute, $value, \Closure $fail) {
                                    if (\App\Models\Tag::where('slug', Str::slug($value))->exists()) {
                                        $fail('This name generates a slug that is already in use. Please choose a different name.');
                                    }
                                };
                            })
                            ->validationMessages([
                                'unique' => 'A tag with this name already exists.',
                            ]),
                        Hidden::make('slug')
                            ->required(),
                    ]),


                TextInput::make('source_link')
                    ->label('Redirect Link / Source URL')
                    ->url(),

                DateTimePicker::make('match_date')
                    ->label('Match Date'),

                Select::make('region')
                    ->label('Region')
                    ->options([
                        'Indonesia' => 'Indonesia',
                        'Global' => 'Global',
                    ])
                    ->default('Global')
                    ->required(),

                Select::make('status')
                    ->label('Publication Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                DateTimePicker::make('published_at')
                    ->label('Published At')
                    ->default(now()),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumb')
                    ->disk('public'),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->badge(),

                TextColumn::make('region')
                    ->label('Region')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    })
                    ->label('Status'),

                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->whereNotIn('slug', ['gallery', 'magazine'])
                    )
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                SelectFilter::make('region')
                    ->label('Region')
                    ->options([
                        'Indonesia' => 'Indonesia',
                        'Global' => 'Global',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereDoesntHave('category', function (Builder $query) {
            $query->whereIn('slug', ['gallery', 'magazine']);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticles::route('/create'),
            'edit' => Pages\EditArticles::route('/{record}/edit'),
        ];
    }
}
