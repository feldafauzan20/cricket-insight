<?php

namespace App\Http\Controllers;

use App\Models\StreamingPartner;
use Illuminate\Http\Request;

class StreamingPartnerController extends Controller
{
    /**
     * Get active streaming partners capped at a maximum of 10.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getActivePartners(int $limit = 10)
    {
        // Enforce maximum 10 partners limit
        $effectiveLimit = min($limit, 10);

        return StreamingPartner::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take($effectiveLimit)
            ->get();
    }

    /**
     * Display a listing of streaming partners (up to 10).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $partners = self::getActivePartners(10);

        return response()->json([
            'status' => 'success',
            'data' => $partners,
        ]);
    }
}
