<?php

namespace App\Filament\Resources\VisualStories\Pages;

use App\Filament\Resources\VisualStories\VisualStoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisualStories extends ListRecords
{
    protected static string $resource = VisualStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
