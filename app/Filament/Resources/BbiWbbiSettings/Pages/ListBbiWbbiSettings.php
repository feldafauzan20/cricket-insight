<?php

namespace App\Filament\Resources\BbiWbbiSettings\Pages;

use App\Filament\Resources\BbiWbbiSettings\BbiWbbiSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBbiWbbiSettings extends ListRecords
{
    protected static string $resource = BbiWbbiSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create New'),
        ];
    }
}
