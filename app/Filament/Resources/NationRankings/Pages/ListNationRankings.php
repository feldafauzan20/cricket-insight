<?php

namespace App\Filament\Resources\NationRankings\Pages;

use App\Filament\Resources\NationRankings\NationRankingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNationRankings extends ListRecords
{
    protected static string $resource = NationRankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
