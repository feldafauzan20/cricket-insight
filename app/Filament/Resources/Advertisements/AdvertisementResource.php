<?php

namespace App\Filament\Resources\Advertisements;

use App\Filament\Resources\Advertisements\Pages;
use App\Models\Advertisement;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Ads Manager';
    protected static ?string $modelLabel = 'Advertisement';
    protected static ?string $pluralModelLabel = 'Advertisements';
    protected static ?string $slug = 'advertisements';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function getPositionOptions(): array
    {
        return [
            'Homepage' => [
                'home_top' => 'Homepage — Top Leaderboard Banner (Ratio 6:1)',
                'home_middle' => 'Homepage — Middle Sidebar Banner (Ratio 4:3)',
                'home_bottom' => 'Homepage — Bottom Banner (Ratio 6:1)',
            ],
            'Halaman Berita (News Page)' => [
                'news_top' => 'News Page — Header Banner (Ratio 6:1)',
                'news_slot_1' => 'News Page — Grid Slot 1 [Half Width] (Ratio 3:1)',
                'news_slot_2' => 'News Page — Grid Slot 2 [Half Width] (Ratio 3:1)',
                'news_slot_3' => 'News Page — Grid Slot 3 [Full Width] (Ratio 6:1)',
                'news_slot_4' => 'News Page — Grid Slot 4 [Half Width] (Ratio 3:1)',
                'news_slot_5' => 'News Page — Grid Slot 5 [Half Width] (Ratio 3:1)',
                'news_slot_6' => 'News Page — Grid Slot 6 [Half Width] (Ratio 3:1)',
                'news_slot_7' => 'News Page — Grid Slot 7 [Half Width] (Ratio 3:1)',
                'news_slot_8' => 'News Page — Grid Slot 8 [Full Width] (Ratio 6:1)',
                'news_sidebar' => 'News Page — Sidebar Banner (Ratio 4:3)',
                'news_bottom' => 'News Page — Bottom Banner (Ratio 6:1)',
                'single_news_bottom' => 'Single News Detail — Bottom Banner (Ratio 6:1)',
            ],
            'Halaman Interview' => [
                'interview_top' => 'Interview Page — Top Banner (Ratio 6:1)',
                'interview_bottom' => 'Interview Page — Bottom Banner (Ratio 6:1)',
            ],
            'Halaman Turnamen' => [
                'tournament_top' => 'Tournament Page — Top Banner (Ratio 6:1)',
                'tournament_middle' => 'Tournament Page — Middle Banner (Ratio 4:3)',
                'tournament_bottom' => 'Tournament Page — Bottom Banner (Ratio 6:1)',
            ],
            'Match Centre' => [
                'match_centre_top' => 'Match Centre — Top Banner (Ratio 6:1)',
                'match_centre_middle_1' => 'Match Centre — Sidebar Banner 1 (Ratio 4:3)',
                'match_centre_middle_2' => 'Match Centre — Sidebar Banner 2 (Ratio 4:3)',
                'match_centre_bottom' => 'Match Centre — Bottom Banner (Ratio 6:1)',
            ],
            'Halaman Lainnya & Fallbacks' => [
                'gallery_bottom' => 'Gallery Page — Bottom Banner (Ratio 6:1)',
                'bbi_wbbi_bottom' => 'BBI / WBBI Page — Bottom Banner (Ratio 6:1)',
                'sidebar' => 'General Sidebar Banner (Ratio 4:3)',
                'default' => 'Global Default Fallback (Ratio 6:1)',
            ],
        ];
    }

    public static function getFlatPositionOptions(): array
    {
        $flat = [];
        foreach (static::getPositionOptions() as $group => $options) {
            foreach ($options as $key => $label) {
                $flat[$key] = $label;
            }
        }
        return $flat;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Campaign & Placement Settings')
                ->description('Tentukan nama campaign dan posisi penempatan iklan pada halaman website.')
                ->schema([
                    TextInput::make('title')
                        ->label('Nama Campaign Iklan')
                        ->required()
                        ->placeholder('Contoh: Campaign Sponsor / AdSense News Slot 1'),

                    Select::make('position')
                        ->label('Posisi Penempatan Iklan (Placement Slot)')
                        ->options(static::getPositionOptions())
                        ->searchable()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Pilih lokasi slot iklan pada halaman target.'),

                    Toggle::make('is_active')
                        ->label('Status Aktif')
                        ->default(true),
                ])->columns(1),

            Section::make('Primary Ad Source — Google AdSense')
                ->description('Sumber iklan utama yang akan diprioritaskan untuk ditampilkan di website.')
                ->schema([
                    Toggle::make('is_adsense_active')
                        ->label('Status Aktif Script Google AdSense')
                        ->default(true)
                        ->helperText('Jika dimatikan, skrip Google AdSense tidak akan dimuat dan otomatis beralih ke Banner Foto CMS di bawah.'),

                    Textarea::make('adsense_code')
                        ->label('Kode HTML / JS Google AdSense')
                        ->rows(6)
                        ->placeholder('<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js..."></script>')
                        ->helperText('Tempelkan kode skrip dari Google AdSense di sini.'),
                ])->columns(1),

            Section::make('Fallback Ad Source — Custom CMS Banner')
                ->description('Gambar banner cadangan jika skrip Google AdSense dimatikan/kosong.')
                ->schema([
                    FileUpload::make('image')
                        ->label('Upload Banner Photo (CMS Fallback)')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                        ->disk('public')
                        ->directory('ads')
                        ->helperText('Unggah berkas foto banner cadangan.'),

                    TextInput::make('link')
                        ->label('URL Link Tujuan (Klik Banner)')
                        ->url()
                        ->placeholder('https://example.com')
                        ->helperText('Tautan ke halaman tujuan saat pengunjung mengklik gambar banner CMS.'),
                ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        $flatOptions = static::getFlatPositionOptions();

        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('CMS Banner')
                    ->disk('public'),

                TextColumn::make('title')
                    ->label('Nama Campaign')
                    ->searchable(),

                TextColumn::make('position')
                    ->label('Posisi Slot')
                    ->formatStateUsing(fn (string $state): string => $flatOptions[$state] ?? str_replace('_', ' ', strtoupper($state)))
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('primary_source')
                    ->label('Sumber Utama')
                    ->state(fn ($record) => (!empty($record->adsense_code) && $record->is_adsense_active) ? 'Google AdSense (ON)' : ((!empty($record->adsense_code) && !$record->is_adsense_active) ? 'AdSense (OFF)' : (!empty($record->image) ? 'Foto CMS' : 'Belum Ada Content')))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Google AdSense (ON)' => 'success',
                        'AdSense (OFF)' => 'danger',
                        'Foto CMS' => 'warning',
                        default => 'gray',
                    }),

                IconColumn::make('is_adsense_active')
                    ->label('AdSense Aktif')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Slot Aktif')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('position')
                    ->label('Filter Posisi Slot')
                    ->options($flatOptions),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
        ];
    }
}