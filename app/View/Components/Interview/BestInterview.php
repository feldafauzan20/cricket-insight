<?php

namespace App\View\Components\Interview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BestInterview extends Component
{
    public iterable $interviews;

    /**
     * Create a new component instance.
     */
    public function __construct(iterable $interviews = [])
    {
        $this->interviews = $interviews;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.interview.best-interview');
    }
}
