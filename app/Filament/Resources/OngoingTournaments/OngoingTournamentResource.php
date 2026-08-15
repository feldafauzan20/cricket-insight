<?php

namespace App\Filament\Resources\OngoingTournaments;

use App\Filament\Resources\OngoingTournaments\Pages;
use App\Models\OngoingTournament;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class OngoingTournamentResource extends Resource
{
    protected static ?string $model = OngoingTournament::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Ongoing Tournaments';
    protected static ?string $slug = 'ongoing-tournaments';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Tournament Details')->schema([
                TextInput::make('tournament_title')
                    ->label('Tournament Title (ID)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'A tournament with this title already exists. Please choose a unique title.',
                    ]),

                TextInput::make('tournament_title_en')
                    ->label('Tournament Title (EN)')
                    ->placeholder('English title translation...'),

                FileUpload::make('image')
                    ->label('Tournament Image')
                    ->image()
                    ->disk('public')
                    ->directory('ongoing-tournaments'),

                RichEditor::make('description')
                    ->label('Description (ID)'),

                RichEditor::make('description_en')
                    ->label('Description (EN)'),
            ])->columnSpan(2),

            Section::make('Settings')->schema([
                TextInput::make('redirect_link')
                    ->label('Redirect Link')
                    ->url()
                    ->placeholder('https://example.com'),

                DateTimePicker::make('time_date')
                    ->label('Time & Date'),

                Toggle::make('is_featured')
                    ->label('Featured Tournament')
                    ->helperText('Tampil di Featured Tournaments Carousel')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ])->columnSpan(1),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->label('Image')->disk('public'),
            TextColumn::make('tournament_title')->label('Title')->searchable()->sortable(),
            TextColumn::make('time_date')->label('Time & Date')->dateTime('d M Y H:i')->sortable(),
            IconColumn::make('is_featured')->label('Featured')->boolean(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
            TextColumn::make('redirect_link')->label('Redirect Link'),
            TextColumn::make('created_at')->dateTime('d M Y H:i')->toggleable(isToggledHiddenByDefault: true),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOngoingTournaments::route('/'),
            'create' => Pages\CreateOngoingTournament::route('/create'),
            'edit' => Pages\EditOngoingTournament::route('/{record}/edit'),
        ];
    }
}
