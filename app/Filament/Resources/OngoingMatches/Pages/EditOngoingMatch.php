<?php

namespace App\Filament\Resources\OngoingMatches\Pages;

use App\Filament\Resources\OngoingMatches\OngoingMatchResource;
use Filament\Resources\Pages\EditRecord;

class EditOngoingMatch extends EditRecord
{
    protected static string $resource = OngoingMatchResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
