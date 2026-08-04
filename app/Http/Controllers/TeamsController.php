<?php

namespace App\Http\Controllers;

use App\Services\CricclubsTeamsService;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index(Request $request, CricclubsTeamsService $service)
    {
        $seriesId = $request->query('seriesId');

        return response()->json([
            'teamsList' => $service->getTeamsList($seriesId),
        ]);
    }
}
