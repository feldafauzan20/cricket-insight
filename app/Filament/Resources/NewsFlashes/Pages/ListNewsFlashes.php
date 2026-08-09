<?php

namespace App\Filament\Resources\NewsFlashes\Pages;

use App\Filament\Resources\NewsFlashes\NewsFlashResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNewsFlashes extends ListRecords
{
    protected static string $resource = NewsFlashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
