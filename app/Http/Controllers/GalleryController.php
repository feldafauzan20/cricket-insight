<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\MagazineGallery\MagazineController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    private const PER_PAGE = 6;

    public static function initialData(): array
    {
        $query = Article::select([
                'id', 'category_id', 'title', 'slug', 'description', 'thumbnail',
                'pdf_file', 'source_link', 'visual_year', 'views_count', 'published_at', 'created_at'
            ])
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'gallery');
            })
            ->latest();

        $total = $query->count();
        $articles = $query->take(self::PER_PAGE)->get();

        $galleries = $articles->map(fn ($article) => self::formatArticle($article))->toArray();

        return [
            'galleries' => $galleries,
            'hasMore' => $total > self::PER_PAGE,
        ];
    }

    public function loadMore(Request $request): JsonResponse
    {
        $page = max((int) $request->query('page', 2), 1);
        $offset = ($page - 1) * self::PER_PAGE;

        $query = Article::select([
                'id', 'category_id', 'title', 'slug', 'description', 'thumbnail',
                'pdf_file', 'source_link', 'visual_year', 'views_count', 'published_at', 'created_at'
            ])
            ->with('category:id,name,slug')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'gallery');
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
        $imageUrl = asset('images/dummy/gallery/dummy-gallery.webp');
        if ($article->thumbnail) {
            $imageUrl = Str::startsWith($article->thumbnail, ['http://', 'https://'])
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
            'description' => $article->description ?? '',
            'image_url' => $imageUrl,
            'year' => (string) ($article->visual_year ?? $article->created_at?->format('Y') ?? date('Y')),
            'views' => $article->views_count ?? 0,
            'target_url' => $targetUrl,
            'source_link' => $targetUrl,
            'has_pdf' => !empty($article->pdf_file),
            'category' => $article->category?->name ?? 'Gallery',
        ];
    }

    public function index(): View {
        $galleryData = self::initialData();
        $magazineGalleryData = MagazineController::initialData();

        $data = [
            'galleries' => $galleryData['galleries'],
            'galleriesHasMore' => $galleryData['hasMore'],
            'magazines' => $magazineGalleryData['magazines'],
            'magazinesHasMore' => $magazineGalleryData['hasMore'],
        ];

        return view('gallery', $data);
    }
}
