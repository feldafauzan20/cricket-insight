<?php

namespace App\Filament\Resources\Interviews;

use App\Filament\Resources\Interviews\Pages\CreateInterviews;
use App\Filament\Resources\Interviews\Pages\EditInterviews;
use App\Filament\Resources\Interviews\Pages\ListInterviews;
use App\Models\Article;
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

class InterviewsResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Interviews';
    protected static ?string $slug = 'interviews';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Konten Artikel')->schema([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, ?string $state, $set) =>
                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                FileUpload::make('thumbnail')->image()->disk('public')->directory('news'),
                Textarea::make('description'),
                RichEditor::make('content')->required(),
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
        return parent::getEloquentQuery()->where('category_id', 6);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInterviews::route('/'),
            'create' => CreateInterviews::route('/create'),
            'edit' => EditInterviews::route('/{record}/edit'),
        ];
    }
}
