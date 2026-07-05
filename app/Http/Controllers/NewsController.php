<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua berita
     */
    public function index(Request $request)
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $query = Article::with(['category', 'uploader', 'tags']);

        if (! $request->filled('status')) {
            $query->where('status', 'published');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->query('category'));
            });
        }

        if ($request->filled('uploader')) {
            $query->where('user_id', $request->query('uploader'));
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

        $uploaderIds = Article::whereNotNull('user_id')->distinct()->pluck('user_id')->filter();
        $uploaderOptions = User::whereIn('id', $uploaderIds)->orderBy('name')->get(['id', 'name']);

        $statusOptions = Article::select('status')->distinct()->orderBy('status')->pluck('status');

        $regionOptions = [];
        if (Schema::hasColumn('articles', 'region')) {
            $regionOptions = Article::select('region')
                ->whereNotNull('region')
                ->distinct()
                ->orderBy('region')
                ->pluck('region')
                ->mapWithKeys(fn ($region) => [$region => Str::title(str_replace(['-', '_'], ' ', $region))]);
        } else {
            $regionOptions = [
                'global' => 'Global',
                'asia' => 'Asia',
                'indonesia' => 'Indonesia',
                'europe' => 'Europe',
            ];
        }

        $sortOptions = [
            'newest_first' => 'Newest First',
            'oldest_first' => 'Oldest First',
            'most_popular' => 'Most Popular',
            'most_viewed' => 'Most Viewed',
            'a_z' => 'Alphabetical A-Z',
            'z_a' => 'Alphabetical Z-A',
        ];

        $timeFrameOptions = [
            'all_time' => 'All Time',
            'today' => 'Today',
            'this_week' => 'This Week',
            'this_month' => 'This Month',
            'this_year' => 'This Year',
        ];

        $popularityOptions = [
            'most_viewed' => 'Most Viewed',
        ];

        $filters = array_merge(
            array_fill_keys([
                'category',
                'uploader',
                'tag',
                'editor_choice',
                'trending',
                'region',
                'sort',
                'time_frame',
                'popularity',
                'status',
            ], null),
            $request->only([
                'category',
                'uploader',
                'tag',
                'editor_choice',
                'trending',
                'region',
                'sort',
                'time_frame',
                'popularity',
                'status',
            ])
        );

        return view('news', [
            'news' => $news,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => ! $matchesData['success'],
            'error' => $matchesData['error'] ?? null,
            'categories' => $categoryOptions,
            'uploaders' => $uploaderOptions,
            'tags' => $tagOptions,
            'statuses' => $statusOptions,
            'regionOptions' => $regionOptions,
            'sortOptions' => $sortOptions,
            'timeFrames' => $timeFrameOptions,
            'popularityOptions' => $popularityOptions,
            'filters' => $filters,
        ]);
    }

    /**
     * Menampilkan detail satu berita
     */
    public function show($slug)
    {
        // Mencari artikel berdasarkan slug, jika tidak ketemu akan menampilkan error 404
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Mengirim data ke view 'single-news'
        return view('single-news', compact('article'));
    }
}