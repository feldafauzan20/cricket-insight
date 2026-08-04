<?php

namespace App\Filament\Resources\BbiWbbiNews\Pages;

use App\Filament\Resources\BbiWbbiNews\BbiWbbiNewsResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;

class CreateBbiWbbiNews extends CreateRecord
{
    protected static string $resource = BbiWbbiNewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['category_id'])) {
            $category = Category::where('slug', 'bbi-wbbi')->first();
            if ($category) {
                $data['category_id'] = $category->id;
            }
        }

        return $data;
    }
}
