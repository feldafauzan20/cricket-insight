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
        $query = Article::with('category')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'gallery')->orWhere('categories.id', 7);
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

        $query = Article::with('category')
            ->whereHas('category', function ($q) {
                $q->where('slug', 'gallery')->orWhere('categories.id', 7);
            })
            ->latest();

        $total = $query->count();
        $articles = $query->skip($offset)->take(self::PER_PAGE)->get();

        $slice = $articles->map(fn ($article) => self::formatArticle($article))->toArray();

        return response()->json([
            'data' => $slice,
            'has_more_pages' => ($offset + self::PER_PAGE) < $total,
        ]);
    }

    private static function formatArticle(Article $article): array
    {
        $imageUrl = asset('images/dummy/gallery/dummy-gallery.webp');
        if ($article->thumbnail) {
            $imageUrl = Str::startsWith($article->thumbnail, ['http://', 'https://'])
                ? $article->thumbnail
                : asset('storage/' . $article->thumbnail);
        }

        return [
            'id' => $article->id,
            'title' => $article->title,
            'description' => $article->description ?? '',
            'image_url' => $imageUrl,
            'year' => (string) ($article->visual_year ?? $article->created_at?->format('Y') ?? date('Y')),
            'views' => $article->views_count ?? 0,
            'source_link' => $article->source_link ?? '',
        ];
    }

    public function index(): View {
        $galleryData = self::initialData();
        $magazineGalleryData = MagazineController::initialData();

        return view('gallery', [
            'galleries' => $galleryData['galleries'],
            'galleriesHasMore' => $galleryData['hasMore'],
            'magazines' => $magazineGalleryData['magazines'],
            'magazinesHasMore' => $magazineGalleryData['hasMore'],
        ]);
    }
}
