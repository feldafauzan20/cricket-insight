<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StreamingPartner;

class StreamingPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'title' => 'Facebook Live',
                'image' => 'images/logo/streaming-partner-logo/facebook-live-logo.svg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'FanCode',
                'image' => 'images/logo/streaming-partner-logo/fancode-logo.svg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'ICC TV',
                'image' => 'images/logo/streaming-partner-logo/icc-tv-logo.svg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'IMG Arena',
                'image' => 'images/logo/streaming-partner-logo/img-arena-logo.svg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Styx Sport',
                'image' => 'images/logo/streaming-partner-logo/styx-sport-logo.svg',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'YouTube',
                'image' => 'images/logo/streaming-partner-logo/youtube-logo.svg',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            StreamingPartner::firstOrCreate(
                ['title' => $partner['title']],
                $partner
            );
        }
    }
}
