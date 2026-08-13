<?php

namespace App\Filament\Resources\BbiWbbiSettings;

use App\Filament\Resources\BbiWbbiSettings\Pages;
use App\Models\BbiWbbiSetting;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;

class BbiWbbiSettingResource extends Resource
{
    protected static ?string $model = BbiWbbiSetting::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'BBI / WBBI Manager';
    protected static ?string $modelLabel = 'BBI / WBBI Content';
    protected static ?string $pluralModelLabel = 'BBI / WBBI Content';
    protected static ?string $slug = 'bbi-wbbi-settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Page Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // 1. Latest BBI CMS
            Section::make('Latest BBI Section')->schema([
                TextInput::make('latest_bbi_title')
                    ->label('Title (ex: BALI BASH INTERNATIONAL: SWEDEN TOUR TO INDONESIA)')
                    ->required(),
                DatePicker::make('latest_bbi_date')
                    ->label('Date')
                    ->displayFormat('M, d Y'),
                Textarea::make('latest_bbi_description')
                    ->label('Small Description')
                    ->rows(3),
                FileUpload::make('latest_bbi_thumbnail_1')
                    ->label('Thumbnail 1')
                    ->image()
                    ->disk('public')
                    ->directory('bbi-wbbi'),
                FileUpload::make('latest_bbi_thumbnail_2')
                    ->label('Thumbnail 2')
                    ->image()
                    ->disk('public')
                    ->directory('bbi-wbbi'),
                FileUpload::make('latest_bbi_logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->directory('bbi-wbbi'),
                TextInput::make('latest_bbi_livestream_link_1')
                    ->label('Live Stream Redirect Link 1')
                    ->url(),
                TextInput::make('latest_bbi_livestream_link_2')
                    ->label('Live Stream Redirect Link 2')
                    ->url(),
            ])->columns(2),

            // 2. BBI / WBBI Hero Carousel Articles (3 Slots)
            Section::make('BBI / WBBI Hero Carousel Articles (3 Slots)')->schema([
                Select::make('article_1_id')
                    ->label('Hero Carousel Article 1')
                    ->relationship('article1', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
                Select::make('article_2_id')
                    ->label('Hero Carousel Article 2')
                    ->relationship('article2', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
                Select::make('article_3_id')
                    ->label('Hero Carousel Article 3')
                    ->relationship('article3', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
            ])->columns(1),

            // Read BBI's Brand New Stories (3 Slots)
            Section::make("Read BBI's Brand New Stories (3 Slots)")->schema([
                Select::make('brand_story_1_id')
                    ->label('Brand Story Article 1')
                    ->relationship('brandStory1', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
                Select::make('brand_story_2_id')
                    ->label('Brand Story Article 2')
                    ->relationship('brandStory2', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
                Select::make('brand_story_3_id')
                    ->label('Brand Story Article 3')
                    ->relationship('brandStory3', 'title', fn (Builder $query) => $query->whereHas('category', fn ($q) => $q->where('slug', 'bbi-wbbi')))
                    ->searchable()
                    ->preload()
                    ->allowHtml()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "
                        <div style='display: flex; gap: 12px; align-items: center;'>
                            <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                            <span style='font-weight: 500;'>" . e(\Illuminate\Support\Str::limit($record->title, 100)) . "</span>
                        </div>
                    "),
            ])->columns(1),

            // 3. Highlight CMS
            Section::make('Highlight Games Section')->schema([
                TextInput::make('highlight_youtube_link')
                    ->label('Youtube Redirect Link')
                    ->url(),
                Repeater::make('highlights')
                    ->label('Highlight Items (1 - 4)')
                    ->schema([
                        TextInput::make('title')->label('Highlight Title')->required(),
                        Textarea::make('description')->label('Highlight Description')->rows(2),
                        FileUpload::make('thumbnail')->label('Thumbnail')->image()->disk('public')->directory('bbi-wbbi'),
                        TextInput::make('redirect_link')->label('Redirect Link')->url(),
                    ])
                    ->maxItems(4)
                    ->columns(2)
                    ->collapsible(),
            ]),

            // 4. Video Highlight CMS
            Section::make('Video Highlight Section')->schema([
                TextInput::make('loop_video_url')
                    ->label('Looping Autoplay Video Link (YouTube Embed or MP4 URL)')
                    ->url()
                    ->placeholder('https://www.youtube.com/embed/...'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('latest_bbi_title')->label('Title')->searchable(),
            TextColumn::make('latest_bbi_date')->label('Date')->date('M, d Y')->sortable(),
            TextColumn::make('updated_at')->label('Last Updated')->dateTime('d M Y H:i'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBbiWbbiSettings::route('/'),
            'create' => Pages\CreateBbiWbbiSetting::route('/create'),
            'edit' => Pages\EditBbiWbbiSetting::route('/{record}/edit'),
        ];
    }
}
