<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LiveScoreController;

class TournamentsController extends Controller
{
    public function index()
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        return view('tournaments', [
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null
        ]);
    }
}
