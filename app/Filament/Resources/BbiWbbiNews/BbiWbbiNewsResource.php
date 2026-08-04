<?php

namespace App\Filament\Resources\BbiWbbiNews;

use App\Filament\Resources\BbiWbbiNews\Pages\CreateBbiWbbiNews;
use App\Filament\Resources\BbiWbbiNews\Pages\EditBbiWbbiNews;
use App\Filament\Resources\BbiWbbiNews\Pages\ListBbiWbbiNews;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BbiWbbiNewsResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'BBI-WBBI';
    protected static ?string $modelLabel = 'BBI-WBBI News';
    protected static ?string $pluralModelLabel = 'BBI-WBBI News';
    protected static ?string $slug = 'bbi-wbbi-news';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Konten Berita BBI-WBBI')->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('news'),
                
                Textarea::make('description')
                    ->label('Ringkasan / Description'),

                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->required(),
            ])->columnSpan(2),

            Section::make('Pengaturan')->schema([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->default(fn () => Category::where('slug', 'bbi-wbbi')->value('id'))
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('user_id')
                    ->label('Uploader / Jurnalis')
                    ->relationship('uploader', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Toggle::make('is_editor_choice')->label("Editor's Choice"),
                Toggle::make('is_trending_manual')->label('Jadikan Trending'),

                Select::make('region')
                    ->label('Region')
                    ->options([
                        'Indonesia' => 'Indonesia',
                        'Global' => 'Global',
                    ])
                    ->default('Global')
                    ->required(),

                Select::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published'])
                    ->default('draft')
                    ->required(),

                DateTimePicker::make('published_at')->default(now()),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')
                ->label('Thumb')
                ->disk('public'),
            TextColumn::make('title')
                ->label('Judul')
                ->searchable()
                ->limit(30),
            TextColumn::make('category.name')
                ->label('Kategori')
                ->sortable(),
            TextColumn::make('region')
                ->label('Region')
                ->sortable(),
            IconColumn::make('is_editor_choice')
                ->boolean()
                ->label("Editor's Choice"),
            IconColumn::make('is_trending_manual')
                ->boolean()
                ->label('Trending'),
            TextColumn::make('status')
                ->badge()
                ->label('Status'),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('category', function ($query) {
            $query->where('slug', 'bbi-wbbi');
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBbiWbbiNews::route('/'),
            'create' => CreateBbiWbbiNews::route('/create'),
            'edit' => EditBbiWbbiNews::route('/{record}/edit'),
        ];
    }
}
