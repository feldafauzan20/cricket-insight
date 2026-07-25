<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Video;
use App\Models\NationRanking;
use App\Models\NewsFlash;
use App\Models\SocialMedia;

class DummyContentSeeder extends Seeder
{
    public function run(): void
    {
        $newsCategory = Category::query()->where('slug', 'news')->value('id');
        $tournamentCategory = Category::query()->where('slug', 'tournament')->value('id');
        $commentaryCategory = Category::query()->where('slug', 'commentaries')->value('id');

        Article::create([
            'category_id' => $newsCategory,
            'title' => 'Timnas Cricket Indonesia Siap Hadapi Kualifikasi Piala Dunia',
            'slug' => 'timnas-cricket-indonesia-siap-hadapi-kualifikasi',
            'description' => 'Persiapan matang telah dilakukan oleh skuad garuda.',
            'content' => '<p>Ini adalah konten berita lengkap mengenai persiapan timnas.</p>',
            'status' => 'published',
            'published_at' => now(),
            'is_editor_choice' => true,
        ]);

        Article::create([
            'category_id' => $commentaryCategory,
            'title' => 'Commentary: Indonesia Siap Tampil di Ajang Internasional',
            'slug' => 'commentary-indonesia-siap-tampil-di-ajang-internasional',
            'description' => 'Komentar singkat tentang performa tim Indonesia.',
            'content' => '<p>Ini adalah contoh commentary.</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Article::create([
            'category_id' => $tournamentCategory,
            'title' => 'ICC T20 World Cup 2026',
            'slug' => 'icc-t20-world-cup-2026',
            'content' => '<p>Turnamen terbesar kriket format T20 kembali hadir.</p>',
            'match_date' => now()->addDays(30),
            'status' => 'published',
        ]);

        Video::create([
            'title' => 'Highlight: Final Mendebarkan T20',
            'video_type' => 'featured',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Pertandingan sengit antara dua rival abadi.',
            'is_active' => true,
        ]);

        $rankings = [
            ['rank' => 1, 'country_name' => 'India'],
            ['rank' => 2, 'country_name' => 'Australia'],
            ['rank' => 3, 'country_name' => 'England'],
            ['rank' => 56, 'country_name' => 'Indonesia'],
        ];

        foreach ($rankings as $rank) {
            NationRanking::firstOrCreate(['rank' => $rank['rank']], $rank);
        }

        NewsFlash::create([
            'title' => 'BREAKING: Rekor dunia baru tercipta di pertandingan hari ini!',
            'is_active' => true,
        ]);

        SocialMedia::create([
            'platform_name' => 'Instagram',
            'embed_url' => '<blockquote class="instagram-media" data-instgrm-permalink="..."></blockquote>',
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
