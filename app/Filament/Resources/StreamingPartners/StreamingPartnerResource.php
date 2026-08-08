<?php

namespace App\Filament\Resources\StreamingPartners;

use App\Filament\Resources\StreamingPartners\Pages;
use App\Models\StreamingPartner;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class StreamingPartnerResource extends Resource
{
    protected static ?string $model = StreamingPartner::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tv';
    protected static ?string $navigationLabel = 'Streaming Partners';
    protected static ?string $slug = 'streaming-partners';
    protected static string|\UnitEnum|null $navigationGroup = 'Supporting Elements';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Streaming Partner Details')->schema([
                TextInput::make('title')
                    ->label('Title / Partner Name')
                    ->placeholder('e.g. YouTube, FanCode, ICC TV')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'A streaming partner with this title already exists. Please choose a unique title.',
                    ])
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Partner Photo (1:1 Ratio)')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ])
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'])
                    ->disk('public')
                    ->directory('streaming-partners')
                    ->helperText('Please upload a square photo/logo with 1:1 aspect ratio.')
                    ->required(),

                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower values will be displayed first.'),

                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true)
                    ->helperText('Enable or disable displaying this streaming partner.'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Photo')
                    ->square(),

                TextColumn::make('title')
                    ->label('Partner Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStreamingPartners::route('/'),
            'create' => Pages\CreateStreamingPartner::route('/create'),
            'edit' => Pages\EditStreamingPartner::route('/{record}/edit'),
        ];
    }
}
