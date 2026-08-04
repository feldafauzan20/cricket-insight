<?php

namespace App\Http\Controllers;

use App\Services\CricclubsPlayerStatsService;
use App\Services\CricclubsPointsTableService;
use Illuminate\Http\Request;

class PointsTableController extends Controller
{
    /**
     * Endpoint AJAX: dipanggil dari JS setiap kali user pilih series
     * di filter Points Table.
     */
    public function getPointsTableApi(Request $request, CricclubsPointsTableService $service)
    {
        $seriesId = $request->query('seriesId');

        if (! $seriesId) {
            return response()->json(['groups' => []]);
        }

        return response()->json([
            'groups' => $service->getPointsTable((int) $seriesId),
        ]);
    }

    /**
     * Endpoint AJAX: dipanggil bareng getPointsTableApi setiap kali user
     * pilih series, buat ngisi section Player Stats (Batting/Bowling/Fielding).
     */
    public function getPlayerStatsApi(Request $request, CricclubsPlayerStatsService $service)
    {
        $seriesId = $request->query('seriesId');

        if (! $seriesId) {
            return response()->json([
                'batting'  => [],
                'bowling'  => [],
                'fielding' => [],
            ]);
        }

        $seriesId = (int) $seriesId;

        return response()->json([
            'batting'  => $service->getBattingStats($seriesId),
            'bowling'  => $service->getBowlingStats($seriesId),
            'fielding' => $service->getFieldingStats($seriesId),
        ]);
    }
}
