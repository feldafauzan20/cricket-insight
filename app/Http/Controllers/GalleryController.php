<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $galleries = Article::with('category')
            ->whereHas('category', function ($query) {
                $query->where('slug', 'gallery');
            })
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'description' => $article->description ?? '',
                    'image_url' => $article->thumbnail,
                    'year' => $article->visual_year ?? ($article->published_at ? $article->published_at->format('Y') : date('Y')),
                    'views' => $article->views_count ?? 0,
                    'source_link' => $article->source_link,
                ];
            })
            ->toArray();

        return view('gallery', [
            'galleries' => $galleries,
        ]);
    }
}
