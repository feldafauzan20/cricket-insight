<?php

namespace App\Http\Controllers\MagazineGallery;

use App\Http\Controllers\Controller;
use App\Data\DummyMagazineData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    private const PER_PAGE = 6;

    // Dipanggil dari GalleryController@index buat initial load
    public static function initialData(): array
    {
        $all = DummyMagazineData::all();
        $slice = array_slice($all, 0, self::PER_PAGE);

        return [
            'magazines' => $slice,
            'hasMore' => count($all) > self::PER_PAGE,
        ];
    }

    // Endpoint fetch buat tombol "SEE MORE"
    public function loadMore(Request $request): JsonResponse
    {
        $page = max((int) $request->query('page', 2), 1);
        $all = DummyMagazineData::all();

        $offset = ($page - 1) * self::PER_PAGE;
        $slice = array_slice($all, $offset, self::PER_PAGE);

        return response()->json([
            'data' => $slice,
            'has_more_pages' => ($offset + self::PER_PAGE) < count($all),
        ]);
    }
}
