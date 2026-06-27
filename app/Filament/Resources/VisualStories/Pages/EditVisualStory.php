<?php

namespace App\Filament\Resources\VisualStories\Pages;

use App\Filament\Resources\VisualStories\VisualStoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVisualStory extends EditRecord
{
    protected static string $resource = VisualStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
