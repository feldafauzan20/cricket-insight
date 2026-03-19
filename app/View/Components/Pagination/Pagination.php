<?php

namespace App\View\Components\Pagination;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public LengthAwarePaginator $paginator;
    public int $currentPage;
    public int $lastPage;
    public array $pages;

    /**
     * Create a new component instance.
     */
    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
        $this->currentPage = $paginator->currentPage();
        $this->lastPage = $paginator->lastPage();
        $this->pages = $this->computePageRange();
    }

    /**
     * Compute the page range to display based on current page and total pages.
     * Implements 4 scenarios:
     * 1. If total pages <= 7: show all pages
     * 2. If current page in first 3: show first 3, ellipsis, last 2
     * 3. If current page in last 3: show first 2, ellipsis, last 3
     * 4. If current page in middle: show first, ellipsis, current ± 1, ellipsis, last
     *
     * @return array Array of page numbers and ellipsis markers
     */
    protected function computePageRange(): array
    {
        $current = $this->currentPage;
        $last = $this->lastPage;

        // Scenario 1: Total pages <= 7, show all
        if ($last <= 7) {
            return range(1, $last);
        }

        // Scenario 2: Current page in first 3 pages
        if ($current <= 3) {
            return [1, 2, 3, '...', $last - 1, $last];
        }

        // Scenario 3: Current page in last 3 pages
        if ($current >= $last - 2) {
            return [1, 2, '...', $last - 2, $last - 1, $last];
        }

        // Scenario 4: Current page in middle
        return [1, '...', $current - 1, $current, $current + 1, '...', $last];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination.pagination');
    }
}
