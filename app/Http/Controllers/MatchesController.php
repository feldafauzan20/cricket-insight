<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Menampilkan daftar semua matches ke file Blade (matches.index)
     */
    public function index()
    {
        $matches = Article::query()
            ->with(['category', 'tags']) 
            // Langsung filter menggunakan category_id nomor 5 (Matches)
            ->where('category_id', 5)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12); 

        return view('matches.index', compact('matches'));
    }

    /**
     * Menampilkan detail satu match berdasarkan slug ke file Blade (matches.show)
     */
    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('category_id', 5)
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('matches.show', compact('article'));
    }
}