<?php

namespace App\Filament\Resources\OngoingMatches\Pages;

use App\Filament\Resources\OngoingMatches\OngoingMatchResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOngoingMatch extends CreateRecord
{
    protected static string $resource = OngoingMatchResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
