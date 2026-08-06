<?php

namespace App\Filament\Resources\StreamingPartners\Pages;

use App\Filament\Resources\StreamingPartners\StreamingPartnerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStreamingPartner extends EditRecord
{
    protected static string $resource = StreamingPartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
