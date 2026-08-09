<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedArticles extends Component
{
    public $articles;

    /**
     * Create a new component instance.
     */
    public function __construct(?int $category = null, ?int $exclude = null, int $limit = 10)
    {
        $query = Article::with(['category', 'uploader'])
            ->where('status', 'published')
            ->when($exclude, fn ($q) => $q->where('id', '!=', $exclude));

        if ($category) {
            $query->where('category_id', $category);
        }

        $this->articles = $query->orderBy('published_at', 'desc')->limit($limit)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.related-articles');
    }
}
