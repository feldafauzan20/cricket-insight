<?php

namespace App\Filament\Resources\StreamingPartners\Pages;

use App\Filament\Resources\StreamingPartners\StreamingPartnerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStreamingPartners extends ListRecords
{
    protected static string $resource = StreamingPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New Streaming Partner'),
        ];
    }
}
