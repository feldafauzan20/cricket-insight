<?php

namespace App\Filament\Resources\BbiWbbiSettings\Pages;

use App\Filament\Resources\BbiWbbiSettings\BbiWbbiSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBbiWbbiSetting extends CreateRecord
{
    protected static string $resource = BbiWbbiSettingResource::class;

    protected static ?string $title = 'Create New';
}
