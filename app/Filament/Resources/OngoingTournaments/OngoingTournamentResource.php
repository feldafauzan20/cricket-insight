<?php

namespace App\Filament\Resources\OngoingTournaments;

use App\Filament\Resources\OngoingTournaments\Pages;
use App\Models\OngoingTournament;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
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
            TextInput::make('tournament_title')
                ->label('Tournament Title')
                ->required(),

            FileUpload::make('image')
                ->label('Image Banner')
                ->image()
                ->disk('public')
                ->directory('ongoing-tournaments'),

            TextInput::make('redirect_link')
                ->label('Redirect Link')
                ->url()
                ->placeholder('https://example.com'),

            DateTimePicker::make('time_date')
                ->label('Time & Date'),

            RichEditor::make('description')
                ->label('Description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')->label('Image'),
            TextColumn::make('tournament_title')->label('Title')->searchable()->sortable(),
            TextColumn::make('time_date')->label('Time & Date')->dateTime('d M Y H:i')->sortable(),
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
