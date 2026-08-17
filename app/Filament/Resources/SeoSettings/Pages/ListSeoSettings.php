<?php

namespace App\Filament\Resources\SeoSettings\Pages;

use App\Filament\Resources\SeoSettings\SeoSettingResource;
use App\Models\SeoSetting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeoSettings extends ListRecords
{
    protected static string $resource = SeoSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Create New SEO Setting')
                ->visible(fn (): bool => SeoSetting::count() === 0),
        ];
    }
}
