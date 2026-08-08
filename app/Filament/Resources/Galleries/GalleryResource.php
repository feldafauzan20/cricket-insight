<?php

namespace App\Filament\Resources\Galleries;

use App\Filament\Resources\Galleries\Pages;
use App\Models\Article;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class GalleryResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery / Magazine';
    protected static ?string $modelLabel = 'Gallery / Magazine';
    protected static ?string $pluralModelLabel = 'Gallery / Magazine';
    protected static ?string $slug = 'gallery';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Gallery / Magazine Content')->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'An entry with this title already exists. Please choose a unique title.',
                    ])
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, $set) =>
                        $set('slug', Str::slug($state))
                    ),
                Hidden::make('slug')
                    ->required(),
                FileUpload::make('thumbnail')->label('Thumbnail Photo')->image()->disk('public')->directory('gallery'),
                FileUpload::make('pdf_file')
                    ->label('PDF File (Magazine)')
                    ->disk('public')
                    ->directory('magazines')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(20480)
                    ->openable()
                    ->downloadable(),
                Textarea::make('description')->label('Description'),
                TextInput::make('visual_year')->label('Year')->numeric(),
                TextInput::make('source_link')->label('Redirect Link')->url(),
            ])->columnSpan(2),

            Section::make('Settings')->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name', fn (Builder $query) => $query->whereIn('slug', ['gallery', 'magazine']))
                    ->default(fn () => Category::where('slug', 'gallery')->value('id'))
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('user_id')
                    ->label('Uploader / Journalist')
                    ->relationship('uploader', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published'])
                    ->default('published')
                    ->required(),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Thumbnail')->disk('public'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),
                TextColumn::make('visual_year')->label('Year')->sortable(),
                TextColumn::make('pdf_file')
                    ->label('PDF')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'PDF Attached' : '-')
                    ->color(fn ($state) => $state ? 'success' : 'gray'),
                TextColumn::make('source_link')
                    ->label('Link')
                    ->limit(30)
                    ->url(fn ($record) => $record->source_link)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name', fn (Builder $query) => $query->whereIn('slug', ['gallery', 'magazine']))
                    ->preload(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('category', function ($query) {
            $query->whereIn('slug', ['gallery', 'magazine']);
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
