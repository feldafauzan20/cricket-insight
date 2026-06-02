<?php

namespace App\Filament\Resources\VisualStories; // <-- Wajib VisualStories

use App\Filament\Resources\VisualStories\Pages; // <-- Wajib VisualStories\Pages
use App\Models\Article;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class VisualStoryResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Visual Stories';
    protected static ?string $slug = 'visual-stories';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required(),
            FileUpload::make('thumbnail')->image()->directory('visuals'),
            Textarea::make('description')->required(),
            TextInput::make('visual_year')->label('Tahun')->numeric()->required(),
            TextInput::make('source_link')->label('Link Redirect')->url()->required(),
            Select::make('status')->options(['draft' => 'Draft', 'published' => 'Published'])->default('draft'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('visual_year')->sortable(),
            TextColumn::make('status')->badge(),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('category', function ($query) {
            $query->where('slug', 'visual-story');
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisualStories::route('/'),
            'create' => Pages\CreateVisualStory::route('/create'),
            'edit' => Pages\EditVisualStory::route('/{record}/edit'),
        ];
    }
}