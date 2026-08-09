<?php

namespace App\View\Components;

use App\Models\NationRanking;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class MensWomensRanking extends Component
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
        $mensRankings = collect();
        $womensRankings = collect();

        try {
            if (Schema::hasTable('nation_rankings') && Schema::hasColumn('nation_rankings', 'gender') && Schema::hasColumn('nation_rankings', 'rank')) {
                $mensRankings = \App\Models\NationRanking::where('gender', 'mens')->orderBy('rank', 'asc')->get();
                $womensRankings = \App\Models\NationRanking::where('gender', 'womens')->orderBy('rank', 'asc')->get();
            } else {
                Log::warning('Nation rankings table or columns missing: nation_rankings(gender|rank)');
            }
        } catch (QueryException $e) {
            Log::error('Error fetching nation rankings: ' . $e->getMessage());
        }

        return view('components.mens-womens-ranking', compact('mensRankings', 'womensRankings'));
    }
}
