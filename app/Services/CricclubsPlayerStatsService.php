<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CricclubsPlayerStatsService
{
    protected int $clubId = 18330;

    public function getBattingStats(int $seriesId): array
    {
        $players = $this->fetch('getBattingStats', $seriesId);

        usort($players, fn ($a, $b) => ($b['runsScored'] ?? 0) <=> ($a['runsScored'] ?? 0));

        return $this->format($players, fn ($p) => (int) ($p['runsScored'] ?? 0));
    }

    public function getBowlingStats(int $seriesId): array
    {
        $players = $this->fetch('getBowlingStats', $seriesId);

        usort($players, fn ($a, $b) => ($b['wickets'] ?? 0) <=> ($a['wickets'] ?? 0));

        return $this->format($players, fn ($p) => (int) ($p['wickets'] ?? 0));
    }

    public function getFieldingStats(int $seriesId): array
    {
        // Endpoint asli Cricclubs salah eja "getFeildingStats", jangan dikoreksi.
        $players = $this->fetch('getFeildingStats', $seriesId);

        usort($players, fn ($a, $b) => ($b['total'] ?? 0) <=> ($a['total'] ?? 0));

        return $this->format($players, fn ($p) => (int) ($p['total'] ?? 0));
    }

    protected function fetch(string $endpoint, int $seriesId): array
    {
        return Cache::remember("player-stats-{$endpoint}-{$seriesId}", now()->addMinutes(10), function () use ($endpoint, $seriesId) {
            $response = Http::withHeaders([
                'X-Consumer-Key'  => config('app.x_consumer_key'),
                'X-API-Key'       => config('app.x_api_key'),
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept'          => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])->timeout(30)->get("https://core-prod-origin.cricclubs.com/core/stats/{$endpoint}", [
                'v'            => '5.0.29',
                'X-Auth-Token' => 'null',
                'clubId'       => $this->clubId,
                'seriesId'     => $seriesId,
            ]);

            if ($response->failed()) {
                Log::error('Failed to fetch player stats from Cricclubs API', [
                    'endpoint' => $endpoint,
                    'seriesId' => $seriesId,
                    'status'   => $response->status(),
                    'body'     => $response->body(),
                ]);

                return [];
            }

            return $response->json('data') ?? [];
        });
    }

    /**
     * Ubah raw player data jadi bentuk siap tampil di stat-table component
     * (name, avatar, value).
     */
    protected function format(array $players, callable $valueResolver): array
    {
        $topPerformers = array_slice($players, 0, 5);

        return array_map(fn ($player) => [
            'name'   => trim(($player['firstName'] ?? '').' '.($player['lastName'] ?? '')),
            'avatar' => $this->buildAvatarUrl($player['profilepic_file_path'] ?? null),
            'value'  => $valueResolver($player),
        ], $topPerformers);
    }

    protected function buildAvatarUrl(?string $path): string
    {
        return $path
            ? 'https://media.cricclubs.com'.$path
            : asset('images/dummy/live-score-card/dummy-logo-live-score-1.webp');
    }
}
