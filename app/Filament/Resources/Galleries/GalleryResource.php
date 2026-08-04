<?php

namespace App\Filament\Resources\Galleries;

use App\Filament\Resources\Galleries\Pages;
use App\Models\Article;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class GalleryResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery';
    protected static ?string $slug = 'gallery';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Konten Gallery')->schema([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),
                TextInput::make('slug')->required(),
                FileUpload::make('thumbnail')->image()->disk('public')->directory('gallery'),
                Textarea::make('description')->label('Description'),
                TextInput::make('visual_year')->label('Year')->numeric(),
                TextInput::make('source_link')->label('Link Redirect')->url(),
            ])->columnSpan(2),

            Section::make('Pengaturan')->schema([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('user_id')
                    ->label('Uploader / Jurnalis')
                    ->relationship('uploader', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')->label('Thumbnail'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('visual_year')->label('Year')->sortable(),
            TextColumn::make('source_link')
                ->label('Link')
                ->limit(30)
                ->url(fn ($record) => $record->source_link)
                ->openUrlInNewTab(),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('category', function ($query) {
            $query->where('slug', 'gallery');
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