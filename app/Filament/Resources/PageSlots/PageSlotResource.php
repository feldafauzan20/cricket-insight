<?php

namespace App\Filament\Resources\PageSlots;

use App\Filament\Resources\PageSlots\Pages;
use App\Models\PageSlot;
use Filament\Resources\Resource;
use Filament\Tables\Table;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Actions\EditAction;

class PageSlotResource extends Resource
{
    protected static ?string $model = PageSlot::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationLabel = 'Page Manager';
    protected static ?string $slug = 'page-manager';
    protected static string|\UnitEnum|null $navigationGroup = 'Page Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Letak (Tidak dapat diubah)')->schema([
                TextInput::make('page_key')->label('Halaman')->disabled(),
                TextInput::make('label')->label('Nama Slot')->disabled(),
            ])->columns(2),

            Section::make('Pilih Konten untuk Ditampilkan')->schema([
                            Select::make('article_id')
                                ->relationship('article', 'title')
                                ->searchable()
                                ->preload()
                                ->allowHtml()
                                ->getOptionLabelFromRecordUsing(fn ($record) => "
                                    <div style='display: flex; gap: 12px; align-items: center;'>
                                        <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                            style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                                        <span style='font-weight: 500;'>{$record->title}</span>
                                    </div>
                                ")
                                ->label('Pilih Artikel / Turnamen')
                                ->helperText('Isi ini jika slot membutuhkan Artikel/Berita. Kosongkan jika slot untuk Video.'),

                            Select::make('video_id')
                                ->relationship('video', 'title')
                                ->searchable()
                                ->preload()
                                ->allowHtml()
                                ->getOptionLabelFromRecordUsing(fn ($record) => "
                                    <div style='display: flex; gap: 12px; align-items: center;'>
                                        <img src='" . ($record->thumbnail ? asset('storage/' . $record->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp')) . "' 
                                            style='width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;' />
                                        <span style='font-weight: 500;'>{$record->title}</span>
                                    </div>
                                ")
                                ->label('Pilih Video (Do not use this for Carousel slots)')
                                ->helperText('Isi ini jika slot membutuhkan Video. Kosongkan jika slot untuk Artikel.'),

                            TextInput::make('embed_link')
                                ->label('Embed Link YouTube')
                                ->helperText('Masukkan URL video YouTube yang ingin ditampilkan di slot ini.'),
                        ])->columns(2),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')->label('Nama Etalase/Slot')->searchable()->weight('bold'),
                TextColumn::make('article.title')->label('Artikel yang Tampil')->limit(30),
                TextColumn::make('video.title')->label('Video yang Tampil')->limit(30),
                TextColumn::make('embed_link')
                    ->label('Embed Link')
                    ->limit(20)
                    ->wrap(),
            ])
            // Fitur Grouping agar rapi per Halaman!
            ->groups([
                Group::make('page_key')
                    ->label('Halaman')
                    ->collapsible(),
            ])
            ->defaultGroup('page_key')
            ->actions([
                // Kita hanya izinkan EDIT, tidak boleh DELETE
                EditAction::make(),
            ])
            ->bulkActions([]); // Matikan fitur delete massal agar aman
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageSlots::route('/'),
            'edit' => Pages\EditPageSlot::route('/{record}/edit'),
        ];
    }
}