<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\OngoingTournament;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $results = $this->search($q, 6);

        return view('search', array_merge(['q' => $q], $results));
    }

    public function live(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $results = $this->search($q, 5);

        return response()->json([
            'news' => $results['news']->map(fn (Article $a) => [
                'title' => $a->title,
                'thumbnail' => $a->thumbnail ? asset('storage/' . $a->thumbnail) : null,
                'url' => route('news.show', ['locale' => app()->getLocale(), 'slug' => $a->slug]),
            ])->values(),
            'interviews' => $results['interviews']->map(fn (Article $a) => [
                'title' => $a->title,
                'thumbnail' => $a->thumbnail ? asset('storage/' . $a->thumbnail) : null,
                'url' => route('news.show', ['locale' => app()->getLocale(), 'slug' => $a->slug]),
            ])->values(),
            'tournaments' => $results['tournaments']->map(fn (OngoingTournament $t) => [
                'title' => $t->tournament_title,
                'thumbnail' => $t->image ? asset('storage/' . $t->image) : null,
                'url' => $t->redirect_link ?: route('news.show', ['locale' => app()->getLocale(), 'id' => $t->id]),
            ])->values(),
        ]);
    }

    /**
     * @return array{news: Collection, interviews: Collection, tournaments: Collection}
     */
    private function search(string $q, int $limit): array
    {
        if ($q === '') {
            return ['news' => collect(), 'interviews' => collect(), 'tournaments' => collect()];
        }

        $interviewCategoryFilter = function ($query) {
            $query->where('category_id', 7)
                ->orWhereHas('category', function ($q) {
                    $q->where('slug', 'Interviews')
                        ->orWhere('slug', 'interviews')
                        ->orWhere('id', 7);
                });
        };

        $needle = '%' . mb_strtolower($q) . '%';

        $matchesKeyword = function ($query) use ($needle) {
            $query->whereRaw('LOWER(title) LIKE ?', [$needle])
                ->orWhereRaw('LOWER(description) LIKE ?', [$needle]);
        };

        $news = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where($matchesKeyword)
            ->whereNot($interviewCategoryFilter)
            ->orderByDesc('published_at')
            ->take($limit)
            ->get();

        $interviews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where($matchesKeyword)
            ->where($interviewCategoryFilter)
            ->orderByDesc('published_at')
            ->take($limit)
            ->get();

        $tournaments = OngoingTournament::query()
            ->whereRaw('LOWER(tournament_title) LIKE ?', [$needle])
            ->latest('time_date')
            ->take($limit)
            ->get();

        return ['news' => $news, 'interviews' => $interviews, 'tournaments' => $tournaments];
    }
}
