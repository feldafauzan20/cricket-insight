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
        $query = Article::select([
                'id', 'category_id', 'title', 'title_en', 'slug', 'description', 'description_en', 'thumbnail',
                'pdf_file', 'source_link', 'published_at', 'created_at'
            ])
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'magazine');
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

        $query = Article::select([
                'id', 'category_id', 'title', 'title_en', 'slug', 'description', 'description_en', 'thumbnail',
                'pdf_file', 'source_link', 'published_at', 'created_at'
            ])
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'magazine');
            })
            ->latest();

        $total = $query->count();
        $articles = $query->skip($offset)->take(self::PER_PAGE)->get();

        $slice = $articles->map(fn ($article) => self::formatArticle($article))->toArray();

        $responseData = [
            'data' => $slice,
            'has_more_pages' => ($offset + self::PER_PAGE) < $total,
        ];

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

        // Lightweight lazy loading: Send link URL string only. File is fetched on-demand when clicked.
        $targetUrl = '#';
        if (!empty($article->source_link)) {
            $targetUrl = $article->source_link;
        } elseif (!empty($article->pdf_file)) {
            $targetUrl = asset('storage/' . $article->pdf_file);
        }

        return [
            'id' => $article->id,
            'title' => $article->title,
            'title_id' => $article->title_id,
            'title_en' => $article->title_en,
            'description' => $article->description ?? '',
            'description_id' => $article->description_id ?? '',
            'description_en' => $article->description_en ?? '',
            'thumbnail_url' => $thumbnailUrl,
            'target_url' => $targetUrl,
            'pdf_url' => $targetUrl,
            'link_url' => $targetUrl,
            'has_pdf' => !empty($article->pdf_file),
            'category' => $article->category?->name ?? 'Magazine',
            'published_date' => $article->published_at 
                ? $article->published_at->format('d M, Y') 
                : ($article->created_at ? $article->created_at->format('d M, Y') : date('d M, Y')),
        ];
    }
}
