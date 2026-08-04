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
                // Fetch videos assigned to page_slots for this pageKey
                $slotVideos = PageSlot::with(['video.uploader', 'video.category'])
                    ->where('page_key', $this->pageKey)
                    ->where('section_key', 'like', 'featured_video_%')
                    ->whereNotNull('video_id')
                    ->orderBy('id')
                    ->get()
                    ->pluck('video')
                    ->filter();

                if ($slotVideos->isNotEmpty()) {
                    $this->featuredVideos = $slotVideos;
                }
            }

            if (is_null($this->featuredVideos) || (is_countable($this->featuredVideos) && count($this->featuredVideos) === 0)) {
                $this->featuredVideos = Video::with(['uploader', 'category'])
                    ->where('is_active', true)
                    ->latest()
                    ->limit(10)
                    ->get();
            }
        }

        return view('components.featured-video', [
            'featuredVideos' => $this->featuredVideos,
            'slotId' => $this->slotId
        ]);
    }
}