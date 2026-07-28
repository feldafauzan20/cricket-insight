<?php

namespace App\Http\Controllers\MagazineGallery;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MagazineController extends Controller
{
    private const PER_PAGE = 6;

    // Dipanggil dari GalleryController@index buat initial load
    public static function initialData(): array
    {
        $query = Article::with('category')
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['visual-story', 'magazine']);
            })
            ->latest();

        $total = $query->count();
        $articles = $query->take(self::PER_PAGE)->get();

        $slice = $articles->map(fn ($article) => self::formatArticle($article))->toArray();

        return [
            'magazines' => $slice,
            'hasMore' => $total > self::PER_PAGE,
        ];
    }

    // Endpoint fetch buat tombol "SEE MORE"
    public function loadMore(Request $request): JsonResponse
    {
        $page = max((int) $request->query('page', 2), 1);
        $offset = ($page - 1) * self::PER_PAGE;

        $query = Article::with('category')
            ->whereHas('category', function ($q) {
                $q->whereIn('slug', ['visual-story', 'magazine']);
            })
            ->latest();

        $total = $query->count();
        $articles = $query->skip($offset)->take(self::PER_PAGE)->get();

        $slice = $articles->map(fn ($article) => self::formatArticle($article))->toArray();

        $responseData = [
            'data' => $slice,
            'has_more_pages' => ($offset + self::PER_PAGE) < $total,
        ];

        dd($responseData);

        return response()->json($responseData);
    }

    private static function formatArticle(Article $article): array
    {
        $thumbnailUrl = 'https://placehold.co/600x800?text=' . urlencode($article->title);
        if ($article->thumbnail) {
            $thumbnailUrl = Str::startsWith($article->thumbnail, ['http://', 'https://'])
                ? $article->thumbnail
                : asset('storage/' . $article->thumbnail);
        }

        return [
            'id' => $article->id,
            'title' => $article->title,
            'description' => $article->description ?? '',
            'thumbnail_url' => $thumbnailUrl,
            'pdf_url' => $article->source_link ?? '#',
            'category' => $article->category?->name ?? 'Visual Story',
            'published_date' => $article->published_at 
                ? $article->published_at->format('d M, Y') 
                : ($article->created_at ? $article->created_at->format('d M, Y') : date('d M, Y')),
        ];
    }
}
