<?php

namespace App\Filament\Resources\OngoingMatches;

use App\Filament\Resources\OngoingMatches\Pages;
use App\Models\OngoingMatch;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class OngoingMatchResource extends Resource
{
    protected static ?string $model = OngoingMatch::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Current & Upcoing Tournaments';
    protected static ?string $modelLabel = 'Current & Upcoing Tournament';
    protected static ?string $pluralModelLabel = 'Current & Upcoing Tournaments';
    protected static ?string $slug = 'current-upcoming-tournaments';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('tournament_title')
                ->label('Title')
                ->required()
                ->unique(ignoreRecord: true)
                ->validationMessages([
                    'unique' => 'A match with this title already exists. Please choose a unique title.',
                ]),

            FileUpload::make('image')
                ->label('Image Banner')
                ->image()
                ->disk('public')
                ->directory('ongoing-matches'),

            TextInput::make('redirect_link')
                ->label('Redirect Link')
                ->url()
                ->placeholder('https://example.com'),

            DateTimePicker::make('time_date')
                ->label('Time & Date'),


            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),

            RichEditor::make('description')
                ->label('Description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->label('Image')->disk('public'),
            TextColumn::make('tournament_title')->label('Title')->searchable()->sortable(),
            TextColumn::make('time_date')->label('Time & Date')->dateTime('d M Y H:i')->sortable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
            TextColumn::make('redirect_link')->label('Redirect Link'),
            TextColumn::make('created_at')->dateTime('d M Y H:i')->toggleable(isToggledHiddenByDefault: true),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOngoingMatches::route('/'),
            'create' => Pages\CreateOngoingMatch::route('/create'),
            'edit' => Pages\EditOngoingMatch::route('/{record}/edit'),
        ];
    }
}
