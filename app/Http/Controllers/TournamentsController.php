<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class TournamentsController extends Controller
{
    /**
     * Menampilkan daftar artikel turnamen ke Blade
     */
    public function index()
    {

        $tournaments = Article::query()
            ->with(['category', 'tags'])
            ->where('category_id', 2)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Menampilkan detail satu artikel turnamen berdasarkan slug
     */
    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('category_id', 2)
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Mengirim data ke resources/views/tournaments/show.blade.php
        return view('tournaments.show', compact('article'));
    }
}