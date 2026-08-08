<?php

namespace App\View\Components\interview;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllInterview extends Component
{
    public iterable $interviews;
    public iterable $regionOptions;
    public array $filters;

    /**
     * Create a new component instance.
     */
    public function __construct(iterable $interviews = [], iterable $regionOptions = [], array $filters = [])
    {
        $this->interviews = $interviews;
        $this->regionOptions = $regionOptions;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.interview.all-interview');
    }
}
