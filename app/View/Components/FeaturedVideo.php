<?php

namespace App\View\Components;

use App\Models\PageSlot;
use App\Models\Video;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedVideo extends Component
{
    public $slotId;
    public $featuredVideos;
    public $pageKey;

    /**
     * Create a new component instance.
     */
    public function __construct($slotId = null, $featuredVideos = null, $pageKey = null)
    {
        $this->slotId = $slotId;
        $this->featuredVideos = $featuredVideos;
        $this->pageKey = $pageKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (is_null($this->featuredVideos)) {
            if ($this->pageKey) {
                // Fetch slots assigned to page_slots for this pageKey
                $slots = PageSlot::with(['video.uploader', 'video.category'])
                    ->where('page_key', $this->pageKey)
                    ->where('section_key', 'like', 'featured_video_%')
                    ->where(function ($query) {
                        $query->whereNotNull('video_id')
                            ->orWhereNotNull('embed_link');
                    })
                    ->orderBy('id')
                    ->get();

                $videoItems = [];
                foreach ($slots as $slot) {
                    $video = $slot->video;
                    $targetLink = !empty($slot->embed_link) ? $slot->embed_link : ($video?->video_src ?? $video?->video_url ?? '#');

                    if ($video) {
                        $video->target_link = $targetLink;
                        $videoItems[] = $video;
                    } elseif (!empty($slot->embed_link)) {
                        // Create fallback object if only embed_link is set
                        $videoItems[] = (object) [
                            'id' => $slot->id,
                            'title' => $slot->label ?? 'Featured Video',
                            'thumbnail' => null,
                            'uploader' => (object) ['name' => 'ADMIN'],
                            'category' => (object) ['name' => 'Video'],
                            'published_at' => $slot->updated_at ?? now(),
                            'created_at' => $slot->created_at ?? now(),
                            'views' => 0,
                            'target_link' => $targetLink,
                        ];
                    }
                }

                if (!empty($videoItems)) {
                    $this->featuredVideos = collect($videoItems);
                }
            }

            if (is_null($this->featuredVideos) || (is_countable($this->featuredVideos) && count($this->featuredVideos) === 0)) {
                $this->featuredVideos = Video::with(['uploader', 'category'])
                    ->where('is_active', true)
                    ->latest()
                    ->limit(10)
                    ->get()
                    ->map(function ($video) {
                        $video->target_link = $video->video_src ?? $video->video_url ?? '#';
                        return $video;
                    });
            }
        }

        return view('components.featured-video', [
            'featuredVideos' => $this->featuredVideos,
            'slotId' => $this->slotId,
        ]);
    }
}