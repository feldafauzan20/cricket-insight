<?php

namespace App\View\Components;

use App\Http\Controllers\StreamingPartnerController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StreamingPartner extends Component
{
    public $streamingPartners;

    /**
     * Create a new component instance.
     */
    public function __construct($streamingPartners = null)
    {
        $this->streamingPartners = $streamingPartners ?? StreamingPartnerController::getActivePartners(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.streaming-partner', [
            'streamingPartners' => $this->streamingPartners,
        ]);
    }
}
