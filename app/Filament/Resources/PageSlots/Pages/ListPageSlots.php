<?php

namespace App\Filament\Resources\PageSlots\Pages;

use App\Filament\Resources\PageSlots\PageSlotResource;
use App\Models\PageSlot;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPageSlots extends ListRecords
{
    protected static string $resource = PageSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create New')
                ->visible(fn (): bool => PageSlot::count() === 0),
        ];
    }
}
