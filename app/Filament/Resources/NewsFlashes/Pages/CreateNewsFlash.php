<?php

namespace App\Filament\Resources\NewsFlashes\Pages;

use App\Filament\Resources\NewsFlashes\NewsFlashResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsFlash extends CreateRecord
{
    protected static string $resource = NewsFlashResource::class;
}
