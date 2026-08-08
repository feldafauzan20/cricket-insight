<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LiveScoreController extends Controller
{
    /**
     * Get list of matches with live scores
     * Implements caching to improve performance
     *
     * @param int $limit Number of matches to fetch
     * @return array
     */
    public function getMatches($limit = 10)
    {
        // Create cache key based on limit
        $cacheKey = "live_scores_{$limit}";

        // Cache for 2 minutes (120 seconds) for live scores
        // Adjust this value based on your needs:
        // - 60 seconds = very fresh data, more API calls
        // - 300 seconds (5 min) = less API calls, slightly stale data
        $cacheMinutes = 2;

        return Cache::remember($cacheKey, now()->addMinutes($cacheMinutes), function () use ($limit) {
            return $this->fetchMatchesFromAPI($limit);
        });
    }

    /**
     * Fetch matches from API (extracted for caching)
     *
     * @param int $limit
     * @return array
     */
    private function fetchMatchesFromAPI($limit)
    {
        try {
            $apiUrl = config('app.cricket_api_url');
            $clubId = config('app.cricket_club_id', '19323');

            // Get current timestamp in milliseconds
            $timestamp = round(microtime(true) * 1000);

            $response = Http::withoutVerifying()->withHeaders([
                'X-Consumer-Key' => config('app.x_consumer_key'),
                'X-API-Key' => config('app.x_api_key'),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'X-Timestamp' => $timestamp,
                'X-Timezone' => 'Asia/Jakarta',
            ])->timeout(30)->get("{$apiUrl}/core/match/getMatches", [
                'X-Auth-Token' => '',
                'clubId' => $clubId,
                'seriesId' => '',
                'teamId' => '',
                'limit' => $limit,
                'timestamp' => $timestamp,
            ]);

            if ($response->failed()) {
                Log::error('Failed to fetch matches from API', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [
                    'success' => false,
                    'data' => [],
                    'error' => 'Failed to fetch live scores'
                ];
            }

            $data = $response->json();

            if (!$data['responseState'] ?? false) {
                Log::error('API returned error state', ['response' => $data]);
                return [
                    'success' => false,
                    'data' => [],
                    'error' => $data['errorMessage'] ?? 'Unknown error'
                ];
            }

            // Format the matches data
            $matches = collect($data['data'] ?? [])->map(function ($match) use ($apiUrl) {
                return $this->formatMatchData($match, $apiUrl);
            })->toArray();

            return [
                'success' => true,
                'data' => $matches,
                'error' => null
            ];

        } catch (\Exception $e) {
            Log::error('Exception while fetching matches', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'data' => [],
                'error' => 'An error occurred while fetching live scoress'
            ];
        }
    }

    /**
     * Format match data for view
     *
     * @param array $match
     * @param string $apiUrl
     * @return array
     */
    private function formatMatchData($match, $apiUrl)
    {
        // Calculate overs from balls
        $t1Overs = $this->calculateOvers($match['t1balls'] ?? 0, $match['noOfBallsPerOver'] ?? 6);
        $t2Overs = $this->calculateOvers($match['t2balls'] ?? 0, $match['noOfBallsPerOver'] ?? 6);

        // Get team logos with fallback
        $t1Logo = !empty($match['t1_logo_file_path'])
            ? "https://media.cricclubs.com" . $match['t1_logo_file_path']
            : asset('images/dummy/live-score-card/dummy-logo-live-score-1.webp');

        $t2Logo = !empty($match['t2_logo_file_path'])
            ? "https://media.cricclubs.com" . $match['t2_logo_file_path']
            : asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp');

        // Determine match status badge
        $statusBadge = $this->getStatusBadge($match);

        // Format match date
        $matchDate = $this->formatMatchDate($match['matchDate'] ?? '', $match['lastUpdatedDate'] ?? '');

        return [
            'matchId' => $match['matchId'] ?? 0,
            'team1' => [
                'name' => $match['teamOneName'] ?? 'TBA',
                'code' => $match['teamOneCode'] ?? '',
                'logo' => $t1Logo,
                'score' => $match['t1total'] ?? 0,
                'wickets' => $match['t1wickets'] ?? 0,
                'overs' => $t1Overs,
            ],
            'team2' => [
                'name' => $match['teamTwoName'] ?? 'TBA',
                'code' => $match['teamTwoCode'] ?? '',
                'logo' => $t2Logo,
                'score' => $match['t2total'] ?? 0,
                'wickets' => $match['t2wickets'] ?? 0,
                'overs' => $t2Overs,
            ],
            'matchInfo' => [
                'seriesType' => $match['seriesType'] ?? '',
                'seriesName' => $match['seriesName'] ?? '',
                'location' => $match['location'] ?? '',
                'totalOvers' => $match['overs'] ?? 0,
            ],
            'result' => $match['result'] ?? '',
            'status' => $statusBadge,
            'matchDate' => $matchDate,
            'isComplete' => $match['isComplete'] ?? 0,
        ];
    }

    /**
     * Calculate overs from balls
     *
     * @param int $balls
     * @param int $ballsPerOver
     * @return string
     */
    private function calculateOvers($balls, $ballsPerOver = 6)
    {
        if ($balls == 0) return '0.0';

        // Prevent division by zero
        if ($ballsPerOver <= 0) {
            $ballsPerOver = 6; // Default to 6 balls per over
        }

        $overs = floor($balls / $ballsPerOver);
        $remainingBalls = $balls % $ballsPerOver;

        return "{$overs}.{$remainingBalls}";
    }

    /**
     * Get status badge info
     *
     * @param array $match
     * @return array
     */
    private function getStatusBadge($match)
    {
        $status = strtolower($match['status'] ?? '');
        $isComplete = $match['isComplete'] ?? 0;

        if ($status === 'live' && !$isComplete) {
            return [
                'text' => 'LIVE',
                'class' => 'bg-red-300/30 dark:bg-[#D6111A]/20 border-[#D6111A] text-[#D6111A]',
                'show' => true
            ];
        }

        if ($isComplete) {
            return [
                'text' => 'RESULT',
                'class' => 'bg-gray-300/30 dark:bg-gray-500/20 border-gray-500 text-gray-600 dark:text-gray-400',
                'show' => true
            ];
        }

        return [
            'text' => 'UPCOMING',
            'class' => 'bg-blue-300/30 dark:bg-blue-500/20 border-blue-500 text-blue-600',
            'show' => true
        ];
    }

    /**
     * Format match date
     *
     * @param string $matchDate
     * @param string $lastUpdated
     * @return string
     */
    private function formatMatchDate($matchDate, $lastUpdated)
    {
        try {
            if (!empty($matchDate)) {
                $date = Carbon::createFromFormat('m/d/Y', $matchDate);
                return $date->format('M d Y');
            }

            if (!empty($lastUpdated)) {
                $date = Carbon::parse($lastUpdated);
                return $date->format('M d Y');
            }

            return 'Date TBA';
        } catch (\Exception $e) {
            return 'Date TBA';
        }
    }

    /**
     * Get detailed scorecard for a specific match
     *
     * @param Request $request
     * @param int $matchId
     * @param int $clubId
     * @return \Illuminate\View\View
     */
    public function getScoreCard(Request $request, $matchId, $clubId = null)
    {
        $clubId = $clubId ?? config('app.cricket_club_id', '19323');

        try {
            $apiUrl = config('app.cricket_api_url');

            // Get current timestamp in milliseconds
            $timestamp = round(microtime(true) * 1000);

            $response = Http::withoutVerifying()->withHeaders([
                'X-Consumer-Key' => config('app.x_consumer_key'),
                'X-API-Key' => config('app.x_api_key'),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'X-Timestamp' => $timestamp,
                'X-Timezone' => 'Asia/Jakarta',
            ])->timeout(30)->get("{$apiUrl}/core/scoreCard/getScoreCard", [
                'matchId' => $matchId,
                'clubId' => $clubId,
                'timestamp' => $timestamp,
            ]);

            if ($response->failed()) {
                return view('components.cards.live-score-card', [
                    'error' => 'Failed to fetch scorecard'
                ]);
            }

            $data = $response->json();

            if (!$data['responseState'] ?? false) {
                return view('components.cards.live-score-card', [
                    'error' => $data['errorMessage'] ?? 'Unknown error'
                ]);
            }

            $scorecardData = [
                'scorecard' => $data['data'] ?? null
            ];

            return view('components.cards.live-score-card', $scorecardData);

        } catch (\Exception $e) {
            Log::error('Exception while fetching scorecard', [
                'matchId' => $matchId,
                'clubId' => $clubId,
                'message' => $e->getMessage()
            ]);

            return view('components.cards.live-score-card', [
                'error' => 'An error occurred while fetching scorecard'
            ]);
        }
    }
}