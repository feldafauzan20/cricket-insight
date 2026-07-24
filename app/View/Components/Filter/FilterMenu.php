<?php

namespace App\View\Components\Filter;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterMenu extends Component
{
    public iterable $categories;
    public iterable $tags;
    public iterable $sortOptions;
    public iterable $timeFrames;
    public iterable $popularityOptions;
    public array $filters;

    /**
     * Create a new component instance.
     */
    public function __construct(
        iterable $categories = [],
        iterable $tags = [],
        iterable $sortOptions = [],
        iterable $timeFrames = [],
        iterable $popularityOptions = [],
        array $filters = []
    ) {
        $this->categories = $categories;
        $this->tags = $tags;
        $this->sortOptions = $sortOptions;
        $this->timeFrames = $timeFrames;
        $this->popularityOptions = $popularityOptions;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter.filter-menu');
    }
}
