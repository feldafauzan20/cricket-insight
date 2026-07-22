<?php

namespace App\Http\Controllers;

use App\Models\Article;

class MatchesController extends Controller
{
    public function apiIndex()
    {
        $matches = Article::query()
            ->with(['category:id,name,slug', 'tags:id,name,slug'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'matches');
            })
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->get();

        return response()->json([
            'data' => $matches->map(function (Article $article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'thumbnail' => $article->thumbnail ? asset($article->thumbnail) : null,
                    'description' => $article->description,
                    'content' => $article->content,
                    'published_at' => $article->published_at?->toISOString(),
                    'match_date' => $article->match_date?->toISOString(),
                    'region' => $article->region,
                    'status' => $article->status,
                    'category' => $article->category ? [
                        'id' => $article->category->id,
                        'name' => $article->category->name,
                        'slug' => $article->category->slug,
                    ] : null,
                    'tags' => $article->tags->map(function ($tag) {
                        return [
                            'id' => $tag->id,
                            'name' => $tag->name,
                            'slug' => $tag->slug,
                        ];
                    })->values(),
                ];
            })->values(),
        ]);
    }

    public function apiShow(string $slug)
    {
        $article = Article::query()
            ->with(['category:id,name,slug', 'tags:id,name,slug', 'uploader:id,name'])
            ->whereHas('category', function ($query) {
                $query->where('slug', 'matches');
            })
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'thumbnail' => $article->thumbnail ? asset($article->thumbnail) : null,
            'description' => $article->description,
            'content' => $article->content,
            'published_at' => $article->published_at?->toISOString(),
            'match_date' => $article->match_date?->toISOString(),
            'region' => $article->region,
            'status' => $article->status,
            'category' => $article->category ? [
                'id' => $article->category->id,
                'name' => $article->category->name,
                'slug' => $article->category->slug,
            ] : null,
            'tags' => $article->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'slug' => $tag->slug,
                ];
            })->values(),
            'uploader' => $article->uploader ? [
                'id' => $article->uploader->id,
                'name' => $article->uploader->name,
            ] : null,
        ]);
    }
}
