<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LiveScoreController;
use App\Models\Video;

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

        $featuredVideos = Video::with(['uploader', 'category'])
            ->where('is_active', true)
            ->latest()
            ->limit(8)
            ->get();

        return view('home', [
            'matches' => $matchesData['data'] ?? [],
            'hasError' => !$matchesData['success'],
            'error' => $matchesData['error'] ?? null,
            'featuredVideos' => $featuredVideos
        ]);
    }
}
