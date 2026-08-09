<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        $ads = [
            [
                'title' => 'Iklan Peralatan Kriket',
                'position' => 'home_top',
                'image' => 'images/dummy/ads/ads-horizontal.webp', 
                'link' => 'https://google.com',
                'is_active' => true,
            ],
            [
                'title' => 'Iklan Minuman Energi',
                'position' => 'home_middle',
                'image' => 'images/dummy/ads/ads-horizontal.webp',
                'link' => 'https://google.com',
                'is_active' => true,
            ],
            [
                'title' => 'Iklan Sepatu Olahraga',
                'position' => 'home_bottom',
                'image' => 'images/dummy/ads/ads-square.webp',
                'link' => 'https://google.com',
                'is_active' => true,
            ],
        ];

        foreach ($ads as $ad) {
            Advertisement::firstOrCreate(['position' => $ad['position']], $ad);
        }
    }
}