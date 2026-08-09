<?php

namespace App\Http\Controllers;

use App\Services\CricclubsSeriesService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Endpoint AJAX: dipanggil dari JS setiap kali user ganti tahun
     * di filter Match Centre. Bukan untuk initial page load.
     */
    public function index(Request $request, CricclubsSeriesService $service)
    {
        $year = (int) $request->query('year', now()->year);

        return response()->json([
            'seriesList' => $service->getSeriesList($year),
        ]);
    }

    /**
     * Endpoint AJAX: dipanggil dari JS setiap kali user pilih series
     * di filter Points Table, buat dapetin encryptedLeagueId/encryptedClubId
     * yang dipakai bangun URL "See All" Player Stats.
     */
    public function details(Request $request, CricclubsSeriesService $service)
    {
        $seriesId = $request->query('seriesId');

        if (! $seriesId) {
            return response()->json(['encryptedLeagueId' => null, 'encryptedClubId' => null]);
        }

        return response()->json($service->getSeriesDetails((int) $seriesId));
    }
}
