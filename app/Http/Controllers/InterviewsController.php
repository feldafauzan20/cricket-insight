<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class InterviewsController extends Controller
{
    public function index()
    {
        $interviews = Article::query()
            ->with(['category', 'tags']) 
            // Hanya mengambil artikel dengan category_id = 6 (Interviews)
            ->where('category_id', 6)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('interviews.index', compact('interviews'));
    }

    public function show(string $slug)
    {
        $article = Article::query()
            ->with(['category', 'tags'])
            ->where('category_id', 6) 
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('interviews.show', compact('article'));
    }
}