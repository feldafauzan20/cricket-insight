<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class TournamentsController extends Controller
{
    /**
     * Menampilkan daftar artikel turnamen ke Blade (tournaments.blade.php)
     */
    public function index()
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $tournaments = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'tournament')->orWhere('categories.id', 2);
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('tournaments', [
            'tournaments' => $tournaments,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
        ]);
    }

    /**
     * Menampilkan detail satu artikel turnamen berdasarkan slug
     */
    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'tournament')->orWhere('categories.id', 2);
            })
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('tournaments', compact('article'));
    }
}