<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua berita
     */
    public function index(Request $request)
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $query = Article::with(['category', 'tags']);

        if (! $request->filled('status')) {
            $query->where('status', 'published');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->query('category'));
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('slug', $request->query('tag'));
            });
        }

        if ($request->filled('editor_choice')) {
            $query->where('is_editor_choice', true);
        }

        if ($request->filled('trending')) {
            $query->where('is_trending_manual', true);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if (Schema::hasColumn('articles', 'region') && $request->filled('region')) {
            $query->where('region', $request->query('region'));
        }

        $timeFrame = $request->query('time_frame', 'all_time');
        if ($timeFrame !== 'all_time') {
            $now = Carbon::now();

            match ($timeFrame) {
                'today' => $query->whereDate('published_at', $now),
                'this_week' => $query->whereBetween('published_at', [$now->startOfWeek(), $now]),
                'this_month' => $query->whereBetween('published_at', [$now->startOfMonth(), $now]),
                'this_year' => $query->whereBetween('published_at', [$now->startOfYear(), $now]),
                default => null,
            };
        }

        $sort = $request->query('sort', 'newest_first');
        $popularity = $request->query('popularity');

        if ($request->filled('sort')) {
            match ($sort) {
                'oldest_first' => $query->orderBy('published_at', 'asc')->orderBy('created_at', 'asc'),
                'most_popular', 'most_viewed' => $query->orderBy('views_count', 'desc')->orderBy('published_at', 'desc'),
                'a_z' => $query->orderBy('title', 'asc'),
                'z_a' => $query->orderBy('title', 'desc'),
                default => $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc'),
            };
        } elseif ($request->filled('popularity')) {
            match ($popularity) {
                'most_viewed', 'most_popular' => $query->orderBy('views_count', 'desc')->orderBy('published_at', 'desc'),
                default => $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc'),
            };
        } else {
            $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
        }

        $news = $query->paginate(10)->withQueryString();

        $categoryOptions = Category::whereHas('articles')->orderBy('name')->get(['name', 'slug']);
        $tagOptions = Tag::whereHas('articles')->orderBy('name')->get(['name', 'slug']);

        $sortOptions = [
            'newest_first' => 'Newest First',
            'oldest_first' => 'Oldest First',
            'most_popular' => 'Most Popular',
            'most_viewed'  => 'Most Viewed',
            'a_z'          => 'Alphabetical A-Z',
            'z_a'          => 'Alphabetical Z-A',
        ];

        $timeFrameOptions = [
            'all_time'   => 'All Time',
            'today'      => 'Today',
            'this_week'  => 'This Week',
            'this_month' => 'This Month',
            'this_year'  => 'This Year',
        ];

        $popularityOptions = [
            'most_viewed' => 'Most Viewed',
        ];

        $regionOptions = [
            'Indonesia' => 'Indonesia',
            'Global'    => 'Global',
        ];

        $filters = array_merge(
            array_fill_keys([
                'category',
                'tag',
                'editor_choice',
                'trending',
                'sort',
                'time_frame',
                'popularity',
                'region',
            ], null),
            $request->only([
                'category',
                'tag',
                'editor_choice',
                'trending',
                'sort',
                'time_frame',
                'popularity',
                'region',
            ])
        );

        $data = [
            'news'              => $news,
            'matches'           => $matchesData['data'] ?? [],
            'hasError'          => ! $matchesData['success'],
            'error'             => $matchesData['error'] ?? null,
            'categories'        => $categoryOptions,
            'tags'              => $tagOptions,
            'sortOptions'       => $sortOptions,
            'timeFrames'        => $timeFrameOptions,
            'popularityOptions' => $popularityOptions,
            'regionOptions'     => $regionOptions,
            'filters'           => $filters,
        ];

        dd($data);

        return view('news', $data);
    }

    /**
     * Menampilkan detail satu berita
     */
    public function show($locale, $slug)
    {
        $article = Article::query()->where('slug', '=', $slug)->firstOrFail();

        // Increment total views in database
        $article->increment('views_count');

        dd(['article' => $article]);

        return view('single-news', compact('article'));
    }
}
