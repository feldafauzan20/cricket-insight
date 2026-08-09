<?php

namespace App\Filament\Resources\NewsFlashes\Pages;

use App\Filament\Resources\NewsFlashes\NewsFlashResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNewsFlash extends EditRecord
{
    protected static string $resource = NewsFlashResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
