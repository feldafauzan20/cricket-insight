<?php

namespace App\Filament\Resources\SeoSettings;

use App\Filament\Resources\SeoSettings\Pages;
use App\Models\SeoSetting;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'SEO Settings';
    protected static ?string $modelLabel = 'SEO Setting';
    protected static ?string $pluralModelLabel = 'SEO Settings';
    protected static ?string $slug = 'seo-settings';
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General Meta Tags')
                ->description('Configure general meta tags, site identity, and robots directives.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->placeholder('Cricket Insight')
                            ->helperText('Global site name used in title templates and Open Graph.')
                            ->required(),

                        TextInput::make('title_suffix')
                            ->label('Title Suffix')
                            ->placeholder(' | Cricket Insight')
                            ->helperText('Appended to page titles automatically.'),
                    ]),

                    TextInput::make('homepage_title')
                        ->label('Homepage Title')
                        ->placeholder('Cricket Insight - Premier Cricket News & Tournament Updates')
                        ->helperText('Default title specifically for the homepage.'),

                    Textarea::make('meta_description')
                        ->label('Default Meta Description')
                        ->rows(3)
                        ->placeholder('Stay updated with Cricket Insight for live cricket scores...')
                        ->helperText('Fallback description used when page-specific meta description is missing.'),

                    Textarea::make('meta_keywords')
                        ->label('Default Meta Keywords')
                        ->rows(2)
                        ->placeholder('cricket, scores, tournaments, rankings')
                        ->helperText('Comma-separated list of fallback meta keywords.'),

                    Grid::make(2)->schema([
                        TextInput::make('author_default')
                            ->label('Default Author')
                            ->placeholder('Cricket Insight Team'),

                        TextInput::make('robots_default')
                            ->label('Default Robots Meta')
                            ->default('max-snippet:-1,max-image-preview:large,max-video-preview:-1')
                            ->helperText('Directives for search crawlers (e.g. max-snippet:-1, max-image-preview:large).'),
                    ]),

                    Grid::make(2)->schema([
                        Toggle::make('enable_canonical_link')
                            ->label('Enable Canonical Link Tags')
                            ->default(true)
                            ->helperText('Automatically injects <link rel="canonical"> for all pages.'),

                        TextInput::make('canonical_url')
                            ->label('Custom Base Canonical URL')
                            ->placeholder('https://cricketinsight.com')
                            ->helperText('Leave empty to auto-detect from current request.'),
                    ]),
                ]),

            Section::make('Open Graph (Social Sharing)')
                ->description('Configure rich snippets and previews for Facebook, LinkedIn, Discord, etc.')
                ->schema([
                    Toggle::make('enable_open_graph')
                        ->label('Enable Open Graph Meta Tags')
                        ->default(true)
                        ->helperText('Generates og:title, og:description, og:image, and og:site_name tags.'),

                    Grid::make(2)->schema([
                        TextInput::make('og_site_name')
                            ->label('OG Site Name')
                            ->placeholder('Cricket Insight'),

                        Select::make('og_type')
                            ->label('OG Type')
                            ->options([
                                'website' => 'Website',
                                'article' => 'Article',
                                'sports_event' => 'Sports Event',
                            ])
                            ->default('website'),
                    ]),

                    TextInput::make('og_title')
                        ->label('Fallback OG Title')
                        ->placeholder('Cricket Insight'),

                    Textarea::make('og_description')
                        ->label('Fallback OG Description')
                        ->rows(2),

                    FileUpload::make('og_image')
                        ->label('Default Open Graph Image')
                        ->image()
                        ->disk('public')
                        ->directory('seo')
                        ->helperText('Recommended size: 1200x630 pixels. Used when sharing pages without custom thumbnails.'),
                ]),

            Section::make('Twitter Cards')
                ->description('Configure Twitter Card summary and player cards for X / Twitter.')
                ->schema([
                    Toggle::make('enable_twitter_card')
                        ->label('Enable Twitter Card Meta Tags')
                        ->default(true)
                        ->helperText('Generates twitter:card, twitter:site, twitter:creator tags.'),

                    Grid::make(3)->schema([
                        Select::make('twitter_card_type')
                            ->label('Twitter Card Type')
                            ->options([
                                'summary_large_image' => 'Summary Large Image',
                                'summary' => 'Summary',
                                'app' => 'App',
                                'player' => 'Player',
                            ])
                            ->default('summary_large_image'),

                        TextInput::make('twitter_username')
                            ->label('Twitter / X Username')
                            ->placeholder('cricketinsight')
                            ->prefix('@'),

                        TextInput::make('twitter_creator')
                            ->label('Twitter Creator')
                            ->placeholder('@cricketinsight'),
                    ]),
                ]),

            Section::make('JSON-LD Schema & Structured Data')
                ->description('Configure search engine structured data markup for rich search results.')
                ->schema([
                    Grid::make(2)->schema([
                        Toggle::make('enable_json_ld')
                            ->label('Enable JSON-LD Structured Data')
                            ->default(true)
                            ->helperText('Outputs Schema.org JSON-LD scripts in the head tag.'),

                        Toggle::make('auto_schema_generation')
                            ->label('Auto-Generate Schema')
                            ->default(true)
                            ->helperText('Automatically builds Organization / WebSite schema markup.'),
                    ]),

                    Grid::make(2)->schema([
                        Select::make('schema_type')
                            ->label('Schema Type')
                            ->options([
                                'Organization' => 'Organization',
                                'SportsOrganization' => 'Sports Organization',
                                'NewsMediaOrganization' => 'News Media Organization',
                                'WebSite' => 'WebSite',
                            ])
                            ->default('Organization'),

                        TextInput::make('schema_name')
                            ->label('Organization / Publisher Name')
                            ->placeholder('Cricket Insight'),
                    ]),

                    Grid::make(2)->schema([
                        TextInput::make('schema_url')
                            ->label('Website URL')
                            ->placeholder('https://cricketinsight.com'),

                        FileUpload::make('schema_logo')
                            ->label('Organization Logo')
                            ->image()
                            ->disk('public')
                            ->directory('seo'),
                    ]),

                    Textarea::make('schema_description')
                        ->label('Organization Description')
                        ->rows(2),

                    Textarea::make('custom_json_ld')
                        ->label('Custom JSON-LD Schema Snippet')
                        ->placeholder('{"@context": "https://schema.org", ...}')
                        ->rows(4)
                        ->helperText('Add any custom Schema.org JSON-LD scripts to be injected automatically.'),
                ]),

            Section::make('Webmaster Verification')
                ->description('Verify ownership with search engines.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('google_site_verification')
                            ->label('Google Search Console Verification Code')
                            ->placeholder('e.g. 4z...'),

                        TextInput::make('bing_site_verification')
                            ->label('Bing Webmaster Verification Code')
                            ->placeholder('e.g. 8A...'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')->label('Site Name')->searchable(),
                TextColumn::make('homepage_title')->label('Homepage Title')->limit(30),
                IconColumn::make('enable_open_graph')->label('Open Graph')->boolean(),
                IconColumn::make('enable_twitter_card')->label('Twitter Cards')->boolean(),
                IconColumn::make('enable_json_ld')->label('JSON-LD')->boolean(),
                IconColumn::make('auto_schema_generation')->label('Auto Schema')->boolean(),
                TextColumn::make('updated_at')->label('Last Updated')->dateTime(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeoSettings::route('/'),
            'create' => Pages\CreateSeoSetting::route('/create'),
            'edit' => Pages\EditSeoSetting::route('/{record}/edit'),
        ];
    }
}
