<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\CricclubsSeriesService;
use App\Services\CricclubsMatchesService;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Menampilkan daftar semua matches ke file Blade (match-centre.blade.php)
     */
    public function index(Request $request, CricclubsSeriesService $service)
    {
        $matches = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'Matches')->orWhere('categories.id', 5);
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        $currentYear = (int) $request->query('year', now()->year);
        $seriesList = $service->getSeriesList($currentYear);

        return view('match-centre', [
            'matches' => $matches,
            'seriesList' => $seriesList,
            'currentYear' => $currentYear,
        ]);
    }

    public function getMatchesApi(Request $request, CricclubsMatchesService $service)
    {
        $seriesId = $request->query('seriesId');
        $teamId = $request->query('teamId');
        $page = max(1, (int) $request->query('page', 1));
        $perPage = max(1, min(100, (int) $request->query('limit', 10))); // frontend mengirim 'limit'

        // Ambil semua matches untuk series (tanpa membatasi) supaya kita bisa hitung total benar
        $all = $service->getMatchesList($seriesId);

        // Filter by teamId bila diminta
        if ($teamId) {
            $all = array_values(
                array_filter($all, function ($m) use ($teamId) {
                    $t1 = $m['teamOne']['id'] ?? null;
                    $t2 = $m['teamTwo']['id'] ?? null;
                    return (string) $t1 === (string) $teamId || (string) $t2 === (string) $teamId;
                }),
            );
        }

        $total = count($all);
        $lastPage = $total === 0 ? 1 : (int) ceil($total / $perPage);
        $page = min($page, $lastPage);

        $offset = ($page - 1) * $perPage;
        $pagedItems = array_slice($all, $offset, $perPage);

        $pagination = [
            'current_page' => $page,
            'last_page' => $lastPage,
            'per_page' => $perPage,
            'total' => $total,
            'from' => $total ? $offset + 1 : 0,
            'to' => min($offset + count($pagedItems), $total),
        ];

        return response()->json([
            'matches' => $pagedItems,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Menampilkan detail satu match berdasarkan slug ke file Blade (match-centre.blade.php)
     */
    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'Matches')->orWhere('categories.id', 5);
            })
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        dd(['article' => $article]);

        return view('match-centre', compact('article'));
    }
}
