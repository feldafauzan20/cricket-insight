<?php

namespace App\Http\Controllers;

use App\Data\DummyGalleryData;
use App\Http\Controllers\MagazineGallery\MagazineController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    private const PER_PAGE = 6;

    public static function initialData(): array
    {
        $all = DummyGalleryData::all();
        $slice = array_slice($all, 0, self::PER_PAGE);

        return [
            'galleries' => $slice,
            'hasMore' => count($all) > self::PER_PAGE,
        ];
    }

    public function loadMore(Request $request): JsonResponse
    {
        $page = max((int) $request->query('page', 2), 1);
        $all = DummyGalleryData::all();

        $offset = ($page - 1) * self::PER_PAGE;
        $slice = array_slice($all, $offset, self::PER_PAGE);

        return response()->json([
            'data' => $slice,
            'has_more_pages' => ($offset + self::PER_PAGE) < count($all),
        ]);
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
