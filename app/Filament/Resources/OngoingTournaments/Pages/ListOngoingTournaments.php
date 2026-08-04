<?php

namespace App\Filament\Resources\OngoingTournaments\Pages;

use App\Filament\Resources\OngoingTournaments\OngoingTournamentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOngoingTournaments extends ListRecords
{
    protected static string $resource = OngoingTournamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
