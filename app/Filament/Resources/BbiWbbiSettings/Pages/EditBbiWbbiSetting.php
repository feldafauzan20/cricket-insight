<?php

namespace App\Filament\Resources\BbiWbbiSettings\Pages;

use App\Filament\Resources\BbiWbbiSettings\BbiWbbiSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBbiWbbiSetting extends EditRecord
{
    protected static string $resource = BbiWbbiSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
