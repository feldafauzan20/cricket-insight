<?php

namespace App\Filament\Resources\PageSlots\Pages;

use App\Filament\Resources\PageSlots\PageSlotResource;
use App\Models\PageSlot;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPageSlot extends EditRecord
{
    protected static string $resource = PageSlotResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $slots = PageSlot::where('page_key', $this->record->page_key)->get();

        $slotData = [];
        foreach ($slots as $slot) {
            $slotData[$slot->section_key] = [
                'video_id' => $slot->video_id,
                'article_id' => $slot->article_id,
                'embed_link' => $slot->embed_link,
            ];
        }

        $data['slots'] = $slotData;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (isset($data['slots']) && is_array($data['slots'])) {
            foreach ($data['slots'] as $sectionKey => $slotValues) {
                PageSlot::where('page_key', $record->page_key)
                    ->where('section_key', $sectionKey)
                    ->update([
                        'article_id' => $slotValues['article_id'] ?? null,
                        'video_id' => $slotValues['video_id'] ?? null,
                        'embed_link' => $slotValues['embed_link'] ?? null,
                    ]);
            }
        }

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
