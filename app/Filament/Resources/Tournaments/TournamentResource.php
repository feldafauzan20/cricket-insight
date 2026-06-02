<?php

namespace App\Filament\Resources\Tournaments;  

use App\Filament\Resources\Tournaments\Pages;
use App\Models\Article;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class TournamentResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Tournament';
    protected static ?string $slug = 'tournaments';
    protected static string|\UnitEnum|null $navigationGroup = 'Content Library';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required(),
            FileUpload::make('thumbnail')->image()->directory('tournaments'),
            RichEditor::make('content')->required(),
            DateTimePicker::make('match_date')->label('Tanggal Pertandingan')->required(),
            Select::make('status')->options(['draft' => 'Draft', 'published' => 'Published'])->default('draft'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('match_date')->dateTime('d M Y H:i')->sortable(),
            TextColumn::make('status')->badge(),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('category', function ($query) {
            $query->where('slug', 'tournament');
        });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTournaments::route('/'),
            'create' => Pages\CreateTournament::route('/create'),
            'edit' => Pages\EditTournament::route('/{record}/edit'),
        ];
    }
}