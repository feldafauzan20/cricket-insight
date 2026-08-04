<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CricclubsPointsTableService
{
    protected int $clubId = 18330;

    /**
     * Ambil points table untuk satu series, dikelompokkan per group,
     * masing-masing tim sudah dihitung Win% dan NRR, serta diberi ranking
     * di dalam groupnya masing-masing.
     */
    public function getPointsTable(int $seriesId): array
    {
        return Cache::remember("points-table-{$seriesId}", now()->addMinutes(10), function () use ($seriesId) {
            $response = Http::withHeaders([
                'X-Consumer-Key'  => config('app.x_consumer_key'),
                'X-API-Key'       => config('app.x_api_key'),
                'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept'          => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])->timeout(30)->get('https://core-prod-origin.cricclubs.com/core/team/getPointsTable', [
                'v'            => '5.0.29',
                'X-Auth-Token' => 'null',
                'clubId'       => $this->clubId,
                'seriesId'     => $seriesId,
            ]);

            if ($response->failed()) {
                Log::error('Failed to fetch points table from Cricclubs API', [
                    'seriesId' => $seriesId,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [];
            }

            return collect($response->json('data') ?? [])
                ->map(fn ($group) => $this->formatGroup($group))
                ->values()
                ->toArray();

        });
    }

    protected function formatGroup(array $group): array
    {
        $teams = collect($group['teams'] ?? [])
            ->map(fn ($entry) => $this->formatTeam($entry['team'] ?? []))
            ->toArray();

        // Urutkan berdasarkan points tertinggi, tie-break pakai NRR tertinggi
        usort($teams, function ($a, $b) {
            if ($a['points'] === $b['points']) {
                return $b['netRunRate'] <=> $a['netRunRate'];
            }

            return $b['points'] <=> $a['points'];
        });

        foreach ($teams as $index => &$team) {
            $team['rank'] = $index + 1;
        }

        return [
            'groupId'   => $group['groupId'] ?? null,
            'groupName' => $group['groupName'] ?? 'Group',
            'teams'     => $teams,
        ];
    }

    protected function formatTeam(array $team): array
    {
        $matches = (int) ($team['matches'] ?? 0);
        $won = (int) ($team['won'] ?? 0);

        // API sering mengirim winPercentage = 0 walau ada kemenangan,
        // jadi kita hitung ulang manual dari matches & won.
        $winPercentage = $matches > 0
            ? round(($won / $matches) * 100, 2)
            : 0.0;

        $netRunRate = (float) ($team['netRunRate'] ?? 0.0);
        $netRunRateRounded = ceil($netRunRate * 100) / 100; // dibulatkan ke atas, 2 desimal

        return [
            'teamId'        => $team['teamID'] ?? null,
            'name'          => $team['teamName'] ?? 'TBA',
            'logo'          => $this->buildLogoUrl($team['logo_file_path'] ?? null),
            'matches'       => $matches,
            'won'           => $won,
            'lost'          => (int) ($team['lost'] ?? 0),
            'noResult'      => (int) ($team['noResult'] ?? 0),
            'points'        => (float) ($team['points'] ?? 0),
            'winPercentage' => $winPercentage,
            'netRunRate'    => $netRunRateRounded,
        ];
    }

    protected function buildLogoUrl(?string $path): string
    {
        return $path
            ? 'https://media.cricclubs.com'.$path
            : asset('images/dummy/live-score-card/dummy-logo-live-score-1.webp');
    }
}
