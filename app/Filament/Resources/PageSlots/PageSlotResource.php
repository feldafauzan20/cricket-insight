<?php

namespace App\Filament\Resources\PageSlots;

use App\Filament\Resources\PageSlots\Pages;
use App\Models\Article;
use App\Models\PageSlot;
use App\Models\Video;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSlotResource extends Resource
{
    protected static ?string $model = PageSlot::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationLabel = 'Page Manager';
    protected static ?string $modelLabel = 'Page Manager';
    protected static ?string $pluralModelLabel = 'Page Manager';
    protected static ?string $slug = 'page-manager';
    protected static string|\UnitEnum|null $navigationGroup = 'Page Settings';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('id', DB::table('page_slots')->selectRaw('MIN(id)')->groupBy('page_key'));
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(function ($record) {
            $pageKey = $record ? $record->page_key : 'home_and_match_centre';

            $sections = [];

            $pageTitle = match ($pageKey) {
                'home_and_match_centre' => 'Home & Match Centre Page',
                'bbi_wbbi' => 'BBI / WBBI Page',
                'tournament' => 'Tournament Page',
                'interview' => 'Interview Page',
                'homepage' => 'Homepage Hero & Slots',
                default => Str::title(str_replace('_', ' ', $pageKey)),
            };

            $sections[] = Section::make('Page Information')->schema([
                TextInput::make('page_title_display')
                    ->label('Target Page')
                    ->default($pageTitle)
                    ->disabled(),
            ]);

            // Homepage Special Slots
            if ($pageKey === 'homepage') {
                $sections[] = Section::make('Hero Carousel (3 Slots)')->schema([
                    Select::make('slots.hero_carousel_1.article_id')
                        ->label('Hero Carousel 1 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.hero_carousel_2.article_id')
                        ->label('Hero Carousel 2 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.hero_carousel_3.article_id')
                        ->label('Hero Carousel 3 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->columns(1)->collapsible();

                $sections[] = Section::make('Trending Main News (3 Slots)')->schema([
                    Select::make('slots.trending_1.article_id')
                        ->label('Trending 1 (Big Card Left)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.trending_2.article_id')
                        ->label('Trending 2 (Small Card Right Top)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.trending_3.article_id')
                        ->label('Trending 3 (Small Card Right Bottom)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->columns(1)->collapsible();

                $sections[] = Section::make('Editor\'s Choice')->schema([
                    Select::make('slots.editor_choice.article_id')
                        ->label('Editor\'s Choice Main Article')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->collapsible();

                $sections[] = Section::make('Trending Sidebar (4 Slots)')->schema([
                    Select::make('slots.trending_side_1.article_id')
                        ->label('Trending Sidebar 1 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.trending_side_2.article_id')
                        ->label('Trending Sidebar 2 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.trending_side_3.article_id')
                        ->label('Trending Sidebar 3 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.trending_side_4.article_id')
                        ->label('Trending Sidebar 4 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->columns(2)->collapsible();
            }

            if ($pageKey === 'bbi_wbbi') {
                $sections[] = Section::make('BBI / WBBI Hero Carousel (3 Slots)')->schema([
                    Select::make('slots.bbi_wbbi_hero_1.article_id')
                        ->label('Hero Carousel 1 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.bbi_wbbi_hero_2.article_id')
                        ->label('Hero Carousel 2 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.bbi_wbbi_hero_3.article_id')
                        ->label('Hero Carousel 3 (Article)')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->columns(1)->collapsible();
            }

            if ($pageKey === 'interview') {
                $sections[] = Section::make('Interview Main Highlight')->schema([
                    Select::make('slots.main_highlight.video_id')
                        ->label('Highlight Paling Atas (Video)')
                        ->options(fn () => static::getVideoSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),

                    TextInput::make('slots.main_highlight.embed_link')
                        ->label('YouTube Embed Link (Optional)')
                        ->url()
                        ->placeholder('https://www.youtube.com/embed/...'),
                ])->columns(2);
            }

            if ($pageKey === 'tournament') {
                $sections[] = Section::make('Tournament Hero Carousel (Max 4 Articles)')->schema([
                    Select::make('slots.hero_carousel_1.article_id')
                        ->label('Carousel Article 1')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.hero_carousel_2.article_id')
                        ->label('Carousel Article 2')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.hero_carousel_3.article_id')
                        ->label('Carousel Article 3')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                    Select::make('slots.hero_carousel_4.article_id')
                        ->label('Carousel Article 4')
                        ->options(fn () => static::getArticleSelectOptions())
                        ->allowHtml()->searchable()->preload()->nullable(),
                ])->columns(2);
            }

            // 10 Featured Video Slots
            $prefix = match ($pageKey) {
                'home_and_match_centre' => 'featured_video_home_match_',
                'tournament' => 'featured_video_tournament_',
                'interview' => 'featured_video_interview_',
                'bbi_wbbi' => 'featured_video_bbi_wbbi_',
                default => null,
            };

            if ($prefix) {
                $videoSlots = [];
                for ($i = 1; $i <= 10; $i++) {
                    $key = $prefix . $i;
                    $videoSlots[] = Section::make("Featured Video Slot {$i}")
                        ->schema([
                            Select::make("slots.{$key}.video_id")
                                ->label("Select Video")
                                ->options(fn () => static::getVideoSelectOptions())
                                ->allowHtml()
                                ->searchable()
                                ->preload()
                                ->nullable(),

                            TextInput::make("slots.{$key}.embed_link")
                                ->label("YouTube Embed Link (Optional)")
                                ->url()
                                ->placeholder("https://www.youtube.com/embed/..."),
                        ])
                        ->columns(2)
                        ->collapsible();
                }

                $sections[] = Section::make('Featured Video Section (10 Slots)')
                    ->description('Select videos for slots 1 through 10 for this page.')
                    ->schema($videoSlots)
                    ->collapsible();
            }

            return $sections;
        });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_key')
                    ->label('Target Page')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'home_and_match_centre' => 'Home & Match Centre Page',
                        'tournament' => 'Tournament Page',
                        'interview' => 'Interview Page',
                        'bbi_wbbi' => 'BBI / WBBI Page',
                        'homepage' => 'Homepage Slots',
                        default => Str::title(str_replace('_', ' ', $state)),
                    })
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('active_slots_count')
                    ->label('Total Slots Configured')
                    ->state(function (PageSlot $record): string {
                        $total = PageSlot::where('page_key', $record->page_key)->count();
                        $filled = PageSlot::where('page_key', $record->page_key)
                            ->where(function ($q) {
                                $q->whereNotNull('video_id')
                                  ->orWhereNotNull('article_id')
                                  ->orWhereNotNull('embed_link');
                            })
                            ->count();
                        return "{$filled} / {$total} Slots Configured";
                    })
                    ->badge()
                    ->color('info'),
            ])
            ->actions([
                EditAction::make()
                    ->label('Configure Page Slots'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageSlots::route('/'),
            'edit' => Pages\EditPageSlot::route('/{record}/edit'),
        ];
    }

    public static function getArticleSelectOptions(): array
    {
        return Article::where('status', 'published')
            ->latest()
            ->get()
            ->mapWithKeys(function ($record) {
                $img = $record->thumbnail
                    ? asset('storage/' . $record->thumbnail)
                    : asset('images/dummy/news-card/dummy-news-card.webp');
                $title = e(Str::limit($record->title, 55));
                $html = "
                    <div style='display: flex; gap: 12px; align-items: center;'>
                        <img src='{$img}' style='width: 36px; height: 36px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;' />
                        <span style='font-weight: 500;'>{$title}</span>
                    </div>
                ";
                return [$record->id => $html];
            })
            ->toArray();
    }

    public static function getVideoSelectOptions(): array
    {
        return Video::where('is_active', true)
            ->latest()
            ->get()
            ->mapWithKeys(function ($record) {
                $img = $record->thumbnail
                    ? asset('storage/' . $record->thumbnail)
                    : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp');
                $title = e(Str::limit($record->title, 55));
                $html = "
                    <div style='display: flex; gap: 12px; align-items: center;'>
                        <img src='{$img}' style='width: 36px; height: 36px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;' />
                        <span style='font-weight: 500;'>{$title}</span>
                    </div>
                ";
                return [$record->id => $html];
            })
            ->toArray();
    }
}