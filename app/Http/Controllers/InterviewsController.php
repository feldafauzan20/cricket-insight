<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index()
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $interviews = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'Interviews')->orWhere('categories.id', 6);
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('interview', [
            'interviews' => $interviews,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
        ]);
    }

    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'Interviews')->orWhere('categories.id', 6);
            })
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('interview', compact('article'));
    }
}