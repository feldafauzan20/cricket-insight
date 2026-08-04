<?php

namespace App\Filament\Resources\BbiWbbiNews\Pages;

use App\Filament\Resources\BbiWbbiNews\BbiWbbiNewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBbiWbbiNews extends EditRecord
{
    protected static string $resource = BbiWbbiNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
