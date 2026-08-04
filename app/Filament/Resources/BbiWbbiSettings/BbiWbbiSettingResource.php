<?php

namespace App\Filament\Resources\BbiWbbiSettings;

use App\Filament\Resources\BbiWbbiSettings\Pages;
use App\Models\BbiWbbiSetting;
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
                    ->label('Date'),
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

            // 2. BBI Article CMS (Allows selecting up to 3 articles)
            Section::make('BBI Article Section')->schema([
                TextInput::make('article_redirect_link')
                    ->label('Add Redirect Link (View All Button)')
                    ->url()
                    ->columnSpanFull(),
                Select::make('article_1_id')
                    ->label('Select Article 1')
                    ->relationship('article1', 'title')
                    ->searchable()
                    ->preload(),
                Select::make('article_2_id')
                    ->label('Select Article 2')
                    ->relationship('article2', 'title')
                    ->searchable()
                    ->preload(),
                Select::make('article_3_id')
                    ->label('Select Article 3')
                    ->relationship('article3', 'title')
                    ->searchable()
                    ->preload(),
            ])->columns(3),

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
            TextColumn::make('latest_bbi_date')->label('Date')->date('d M Y')->sortable(),
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
