<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Menampilkan daftar semua matches ke file Blade (match-centre.blade.php)
     */
    public function index()
    {
        $matches = Article::query()
            ->with(['category', 'tags'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'Matches')->orWhere('categories.id', 5);
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        dd(['matches' => $matches]);

        return view('match-centre', compact('matches'));
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