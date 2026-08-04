<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CricclubsSeriesService
{
    protected int $clubId = 18330;

    /**
     * Ambil daftar series untuk tahun tertentu dari API Cricclubs.
     * Di-cache 30 menit per tahun biar gak hit API eksternal berulang.
     */

    public function getSeriesList(int $year): array
    {
        return Cache::remember("series-list-{$year}", now()->addMinutes(30), function () use ($year) {
            $timestamp = round(microtime(true) * 1000);

            $response = Http::withHeaders([
                'X-Consumer-Key' => config('app.x_consumer_key'),
                'X-API-Key' => config('app.x_api_key'),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
                'X-Timestamp' => $timestamp,
                'X-Timezone' => 'Asia/Jakarta',
            ])
                ->timeout(30)
                ->get('https://core-prod-origin.cricclubs.com/core/series/getSeriesList', [
                    'clubId' => $this->clubId,
                    'limit' => 1000,
                    'year' => $year,
                    'timestamp' => $timestamp,
                ]);

            if ($response->failed()) {
                Log::error('Failed to fetch series from Cricclubs API', [
                    'year' => $year,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return [];
            }

            return $response->json('data.seriesList') ?? [];
        });
    }

    /**
     * Ambil encryptedLeagueId (representasi terenkripsi seriesId) &
     * encryptedClubId, dipakai buat bangun URL "See All" ke halaman
     * records (batting/bowling/fielding) di cricclubs.com.
     */
    public function getSeriesDetails(int $seriesId): array
    {
        return Cache::remember("series-details-{$seriesId}", now()->addMinutes(30), function () use ($seriesId) {
            $response = Http::withHeaders([
                'X-Consumer-Key' => config('app.x_consumer_key'),
                'X-API-Key' => config('app.x_api_key'),
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept' => 'application/json, text/plain, */*',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])
                ->timeout(30)
                ->get('https://core-prod-origin.cricclubs.com/core/series/getSeriesDetails', [
                    'clubId' => $this->clubId,
                    'seriesId' => $seriesId,
                    'X-Auth-Token' => '',
                ]);

            if ($response->failed()) {
                Log::error('Failed to fetch series details from Cricclubs API', [
                    'seriesId' => $seriesId,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return ['encryptedLeagueId' => null, 'encryptedClubId' => null];
            }

            return [
                'encryptedLeagueId' => $response->json('data.encryptedLeagueId'),
                'encryptedClubId' => $response->json('data.encryptedClubId'),
            ];
        });
    }
}
