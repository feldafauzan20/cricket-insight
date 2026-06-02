<?php

namespace App\Filament\Resources\PageSlots\Pages;

use App\Filament\Resources\PageSlots\PageSlotResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPageSlot extends EditRecord
{
    protected static string $resource = PageSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
