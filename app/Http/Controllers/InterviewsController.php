<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index(Request $request)
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $categoryFilter = function ($query) {
            $query->where('slug', 'Interviews')->orWhere('categories.id', 6);
        };

        $bestInterviews = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', $categoryFilter)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        $regionOptions = [
            'Indonesia' => 'Indonesia',
            'Global' => 'Global',
        ];

        $region = $request->query('region', 'Indonesia');

        $interviews = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', $categoryFilter)
            ->where('status', 'published')
            ->where('region', $region)
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        $data = [
            'interviews' => $interviews,
            'bestInterviews' => $bestInterviews,
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
            'regionOptions' => $regionOptions,
            'filters' => ['region' => $region],
        ];

        return view('interview', $data);
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
