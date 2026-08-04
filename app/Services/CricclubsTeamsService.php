<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CricclubsTeamsService
{
    public function getTeamsList(?string $seriesId): array
    {
        if (! $seriesId) {
            return [];
        }

        $response = Http::withHeaders([
            'X-Consumer-Key' => config('app.x_consumer_key'),
            'X-API-Key' => config('app.x_api_key'),
            'User-Agent' => 'Mozilla/5.0',
        ])
            ->timeout(30)
            ->get('https://core-prod-origin.cricclubs.com/core/team/getTeamsList', [
                'clubId' => 18330,
                'seriesId' => $seriesId,
            ]);

        if ($response->failed()) {
            return [];
        }

        $groups = $response->json('data.teamsList', []);

        return collect($groups)
            ->flatMap(fn ($group) => $group['teams'] ?? [])
            ->map(fn ($team) => [
                'teamID' => $team['teamID'],
                'teamName' => $team['teamName'],
                'teamCode' => $team['teamCode'] ?? null,
                'logo_file_path' => $team['logo_file_path'] ?? null,
            ])
            ->values()
            ->all();
    }
}
