<?php

namespace App\Filament\Resources\Videos;

use App\Filament\Resources\Videos\Pages;
use App\Models\Video;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-video-camera';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Title')
                ->required()
                ->unique(ignoreRecord: true)
                ->validationMessages([
                    'unique' => 'A video with this title already exists. Please enter a unique title.',
                ]),

            FileUpload::make('video_file')
                ->label('Upload Video File (MP4, WebM, MOV)')
                ->disk('public')
                ->directory('videos/uploads')
                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime', 'video/x-msvideo'])
                ->maxSize(102400),

            TextInput::make('video_url')
                ->label('URL Video (YouTube, dll)')
                ->url()
                ->placeholder('https://www.youtube.com/watch?v=...'),

            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->directory('videos/thumbnails'),

            Textarea::make('description')
                ->label('Description'),

            Toggle::make('is_active')
                ->label('Is active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('thumbnail')
                ->disk('public'),
            TextColumn::make('title')
                ->searchable(),
            TextColumn::make('video_file')
                ->label('Source')
                ->formatStateUsing(fn ($record) => $record->video_file ? 'Uploaded MP4' : ($record->video_url ?? 'N/A')),
            IconColumn::make('is_active')
                ->boolean(),
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