<?php

namespace App\Filament\Resources\BbiWbbiNews\Pages;

use App\Filament\Resources\BbiWbbiNews\BbiWbbiNewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBbiWbbiNews extends ListRecords
{
    protected static string $resource = BbiWbbiNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Create New'),
        ];
    }
}
