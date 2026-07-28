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

    /**
     * Create a new component instance.
     */
    public function __construct($slotId = null, $featuredVideos = null)
    {
        $this->slotId = $slotId;
        $this->featuredVideos = $featuredVideos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (is_null($this->featuredVideos)) {
            $this->featuredVideos = Video::with(['uploader', 'category'])
                ->where('is_active', true)
                ->latest()
                ->limit(8)
                ->get();
        }

        return view('components.featured-video', [
            'featuredVideos' => $this->featuredVideos,
            'slotId' => $this->slotId
        ]);
    }
}