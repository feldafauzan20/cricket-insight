<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\OngoingTournament;
use App\Models\PageSlot;
use Illuminate\Http\Request;

class TournamentsController extends Controller
{
    /**
     * Menampilkan data turnamen ke Blade (tournaments.blade.php)
     */
    public function index()
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        // 1. Hero Carousel Articles (Max 4 from PageSlot or latest articles)
        $heroSlots = PageSlot::where('page_key', 'tournament')
            ->whereIn('section_key', ['hero_carousel_1', 'hero_carousel_2', 'hero_carousel_3', 'hero_carousel_4'])
            ->with(['article.category', 'article.tags', 'article.uploader'])
            ->get();

        $heroArticles = collect();
        foreach (['hero_carousel_1', 'hero_carousel_2', 'hero_carousel_3', 'hero_carousel_4'] as $key) {
            $slot = $heroSlots->firstWhere('section_key', $key);
            if ($slot && $slot->article) {
                $heroArticles->push($slot->article);
            }
        }

        if ($heroArticles->count() < 4) {
            $fallbackArticles = Article::query()
                ->with(['category', 'tags', 'uploader'])
                ->where('status', 'published')
                ->whereNotIn('id', $heroArticles->pluck('id'))
                ->orderByDesc('published_at')
                ->take(4 - $heroArticles->count())
                ->get();

            $heroArticles = $heroArticles->merge($fallbackArticles);
        }

        // 2. Featured Tournaments (from OngoingTournament model)
        $featuredTournaments = OngoingTournament::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest('time_date')
            ->get();

        if ($featuredTournaments->isEmpty()) {
            $featuredTournaments = OngoingTournament::query()
                ->where('is_active', true)
                ->latest('time_date')
                ->take(10)
                ->get();
        }

        // 3. Ongoing Tournaments (time_date is now or in the future)
        $ongoingTournaments = OngoingTournament::query()
            ->where('is_active', true)
            ->where('time_date', '>=', now())
            ->oldest('time_date')
            ->get();

        // 3b. Past Tournaments (time_date is before now)
        $pastTournaments = OngoingTournament::query()
            ->where('is_active', true)
            ->where('time_date', '<', now())
            ->latest('time_date')
            ->get();

        // 4. Tournament News (Top Swiper)
        $tournamentNews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where(function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', 'tournament')
                      ->orWhere('slug', 'tournaments')
                      ->orWhere('name', 'like', '%tournament%')
                      ->orWhere('name', 'like', '%turnamen%')
                      ->orWhere('categories.id', 3);
                })->orWhereHas('tags', function ($q) {
                    $q->where('name', 'like', '%tournament%')
                      ->orWhere('name', 'like', '%turnamen%');
                });
            })
            ->orderByDesc('published_at')
            ->take(10)
            ->get();

        if ($tournamentNews->isEmpty()) {
            $tournamentNews = Article::query()
                ->with(['category', 'tags', 'uploader'])
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->take(10)
                ->get();
        }

        // 5. Indonesia Tournament News (Region = Indonesia)
        $indonesiaNews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where('region', 'Indonesia')
            ->orderByDesc('published_at')
            ->take(9)
            ->get();

        // 6. International Tournament News (Region = Global / International)
        $internationalNews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where(function ($q) {
                $q->where('region', '!=', 'Indonesia')
                  ->orWhereNull('region');
            })
            ->orderByDesc('published_at')
            ->take(9)
            ->get();

        $data = [
            'heroArticles' => $heroArticles,
            'featuredTournaments' => $featuredTournaments,
            'ongoingTournaments' => $ongoingTournaments,
            'pastTournaments' => $pastTournaments,
            'tournamentNews' => $tournamentNews,
            'indonesiaNews' => $indonesiaNews,
            'internationalNews' => $internationalNews,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
        ];

        // dd($data);

        return view('tournaments', $data);
    }

    /**
     * Menampilkan detail satu artikel turnamen berdasarkan slug
     */
    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'tournament')
                    ->orWhere('slug', 'tournaments')
                    ->orWhere('categories.id', 2);
            })
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('tournaments', compact('article'));
    }
}
