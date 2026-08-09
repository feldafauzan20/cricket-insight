<?php

namespace App\Filament\Resources\OngoingMatches\Pages;

use App\Filament\Resources\OngoingMatches\OngoingMatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOngoingMatches extends ListRecords
{
    protected static string $resource = OngoingMatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Ongoing Match'),
        ];
    }
}
