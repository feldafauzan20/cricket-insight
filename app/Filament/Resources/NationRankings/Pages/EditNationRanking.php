<?php

namespace App\Filament\Resources\NationRankings\Pages;

use App\Filament\Resources\NationRankings\NationRankingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNationRanking extends EditRecord
{
    protected static string $resource = NationRankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
