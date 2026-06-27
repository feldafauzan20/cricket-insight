<?php

namespace App\View\Components;

use App\Models\PageSlot;
use App\Models\Video;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedVideo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
public function render(): View|Closure|string
{
    // Ambil langsung 8 video aktif terbaru
    $featuredVideos = \App\Models\Video::with(['uploader', 'category'])
        ->where('is_active', true)
        ->latest()
        ->limit(8)
        ->get();

    return view('components.featured-video', compact('featuredVideos'));
}
}