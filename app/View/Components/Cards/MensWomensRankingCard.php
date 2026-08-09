<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MensWomensRankingCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $rank,
        public string $flag,
        public string $country,
        public string $points,
        public ?string $py = null,
        public ?string $bgColor = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.mens-womens-ranking-card');
    }
}
