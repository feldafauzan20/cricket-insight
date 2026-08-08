<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LiveScoreController;

class HomeController extends Controller
{
    /**
     * Display the home page with live scores
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $liveScoreController = new LiveScoreController();
        $matchesData = $liveScoreController->getMatches(10);

        $data = [
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
        ];

        return view('home', $data);
   }
}
