<?php

namespace App\Filament\Resources\Videos;

use App\Filament\Resources\Videos\Pages;
use App\Models\Video;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-video-camera';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    // Berubah dari Form $form menjadi Schema $schema
    public static function form(Schema $schema): Schema
    {
        // Berubah dari ->schema([]) menjadi ->components([])
        return $schema->components([
            TextInput::make('title')
                ->label('Title')
                ->required()
                ->unique(ignoreRecord: true)
                ->validationMessages([
                    'unique' => 'A video with this title already exists. Please enter a unique title.',
                ]),
            
            Select::make('video_type')
                ->options([
                    'featured' => 'Featured Video',
                    'highlight_interview' => 'Highlight Interview',
                    'tournament' => 'Tournament Video',
                ])->required(),
                
            TextInput::make('video_url')
                ->label('URL Video (YouTube, dll)')
                ->url()
                ->required(),
                
            FileUpload::make('thumbnail')
                ->image()->disk('public')
                ->directory('videos'),
                
            Textarea::make('description'),
            
            Toggle::make('is_active')
                ->default(true),
            Toggle::make('is_featured')
                ->default(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('video_type')->badge(),
            IconColumn::make('is_active')->boolean(),
            IconColumn::make('is_featured')->label('Featured')->boolean(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}