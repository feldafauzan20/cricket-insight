<?php

namespace App\Filament\Resources\OngoingTournaments\Pages;

use App\Filament\Resources\OngoingTournaments\OngoingTournamentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOngoingTournament extends EditRecord
{
    protected static string $resource = OngoingTournamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
