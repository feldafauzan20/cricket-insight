<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CricclubsMatchesService
{
    protected int $clubId = 18330;

    public function getMatchesList(?string $seriesId = null, int $limit = 10000000): array
    {
        $cacheKey = 'cricclubs-matches-' . ($seriesId ?: 'all') . '-' . $limit;

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($seriesId, $limit) {
            $timestamp = round(microtime(true) * 1000);

            $response = Http::withHeaders([
                'X-Consumer-Key' => config('app.x_consumer_key'),
                'X-API-Key' => config('app.x_api_key'),
                'User-Agent' => 'Mozilla/5.0',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])
                ->timeout(30)
                ->get('https://core-prod-origin.cricclubs.com/core/match/getMatches', [
                    'clubId' => $this->clubId,
                    'limit' => $limit,
                    'seriesId' => $seriesId ?? '',
                    'timestamp' => $timestamp,
                ]);

            if ($response->failed()) {
                return [];
            }

            return collect($response->json('data', []))
                ->map(fn (array $match) => $this->normalizeMatch($match))
                ->values()
                ->all();
        });
    }

    private function normalizeMatch(array $match): array
    {
        $rawDate = $match['matchDate'] ?? '';
        $formattedDate = 'Date TBA';

        if (! empty($rawDate)) {
            try {
                $date = Carbon::createFromFormat('m/d/Y', $rawDate);
                $formattedDate = strtoupper($date->format('d F, Y'));
            } catch (\Exception $e) {
                $formattedDate = strtoupper($rawDate);
            }
        }

        return [
            'matchId' => $match['matchId'] ?? null,
            'date' => $formattedDate,
            'rawDate' => $rawDate,
            'type' => strtoupper($match['matchType'] ?? 'MATCH'),
            'title' => $match['seriesName'] ?? ($match['result'] ?? 'Match'),
            'venue' => $match['location'] ?? 'Venue TBA',
            'teamOne' => [
                'id' => $match['teamOne'] ?? null,
                'name' => $match['teamOneName'] ?? 'TBA',
                'logo' => $this->buildLogoUrl($match['t1_logo_file_path'] ?? null),
                'score' => $this->buildScore($match['t1total'] ?? 0, $match['t1wickets'] ?? 0, $match['t1balls'] ?? 0),
            ],
            'teamTwo' => [
                'id' => $match['teamTwo'] ?? null,
                'name' => $match['teamTwoName'] ?? 'TBA',
                'logo' => $this->buildLogoUrl($match['t2_logo_file_path'] ?? null),
                'score' => $this->buildScore($match['t2total'] ?? 0, $match['t2wickets'] ?? 0, $match['t2balls'] ?? 0),
            ],
            'result' => $match['result'] ?? 'Result pending',
            'status' => $match['status'] ?? 'upcoming',
            'isComplete' => (bool) ($match['isComplete'] ?? 0),
        ];
    }

    private function buildScore(int $total, int $wickets, int $balls): string
    {
        if ($total > 0 || $wickets > 0 || $balls > 0) {
            return "{$total}/{$wickets} ({$balls}b)";
        }

        return 'Yet to bat';
    }

    private function buildLogoUrl(?string $path): string
    {
        return $path
            ? 'https://media.cricclubs.com' . $path
            : asset('images/dummy/live-score-card/dummy-logo-live-score-1.webp');
    }
}
