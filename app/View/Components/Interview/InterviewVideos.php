<?php

namespace App\View\Components\Interview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InterviewVideos extends Component
{
    public $highlightVideo;
    public iterable $interviewVideos;

    /**
     * Create a new component instance.
     */
    public function __construct($highlightVideo = null, iterable $interviewVideos = [])
    {
        $this->highlightVideo = $highlightVideo;
        $this->interviewVideos = $interviewVideos;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.interview.interview-videos');
    }
}
