<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BbiWbbiSetting;
use App\Models\Article;

class BbiWbbiSettingSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::take(3)->get();

        BbiWbbiSetting::firstOrCreate(
            ['id' => 1],
            [
                'latest_bbi_title' => 'BALI BASH INTERNATIONAL: SWEDEN TOUR TO INDONESIA',
                'latest_bbi_date' => now()->toDateString(),
                'latest_bbi_description' => 'Experience the high-stakes cricket series between Bali Bash International and Sweden National Team.',
                'latest_bbi_thumbnail_1' => null,
                'latest_bbi_thumbnail_2' => null,
                'latest_bbi_logo' => null,
                'latest_bbi_livestream_link_1' => 'https://youtube.com/live/example1',
                'latest_bbi_livestream_link_2' => 'https://youtube.com/live/example2',
                
                'article_1_id' => $articles[0]->id ?? null,
                'article_2_id' => $articles[1]->id ?? null,
                'article_3_id' => $articles[2]->id ?? null,
                'article_redirect_link' => 'https://cricketinsight.com/news',
                
                'highlight_youtube_link' => 'https://youtube.com/watch?v=dQw4w9WgXcQ',
                'highlights' => [
                    [
                        'title' => 'Match 1 Highlights',
                        'description' => 'Thrilling finish in the final over of the opening T20 match.',
                        'thumbnail' => null,
                        'redirect_link' => 'https://youtube.com/watch?v=highlight1',
                    ],
                    [
                        'title' => 'Century Special Performance',
                        'description' => 'Incredible 100 runs scored by top order batsman.',
                        'thumbnail' => null,
                        'redirect_link' => 'https://youtube.com/watch?v=highlight2',
                    ],
                    [
                        'title' => 'Bowling Masterclass',
                        'description' => '5-wicket haul performance breakdown.',
                        'thumbnail' => null,
                        'redirect_link' => 'https://youtube.com/watch?v=highlight3',
                    ],
                    [
                        'title' => 'Final Trophy Ceremony',
                        'description' => 'Highlights from the awards and trophy presentation.',
                        'thumbnail' => null,
                        'redirect_link' => 'https://youtube.com/watch?v=highlight4',
                    ],
                ],
                
                'loop_video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1',
            ]
        );
    }
}
