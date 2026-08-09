<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageSlot;

class PageSlotSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            // --- HOMEPAGE ---
            ['page_key' => 'homepage', 'section_key' => 'hero_carousel_1', 'label' => 'Homepage Hero Carousel 1'],
            ['page_key' => 'homepage', 'section_key' => 'hero_carousel_2', 'label' => 'Homepage Hero Carousel 2'],
            ['page_key' => 'homepage', 'section_key' => 'hero_carousel_3', 'label' => 'Homepage Hero Carousel 3'],
            ['page_key' => 'homepage', 'section_key' => 'featured_video', 'label' => 'Homepage Featured Video Utama'],
            ['page_key' => 'homepage', 'section_key' => 'trending_1', 'label' => 'Homepage Trending Main 1 (Big Card Left)'],
            ['page_key' => 'homepage', 'section_key' => 'trending_2', 'label' => 'Homepage Trending Main 2 (Small Card Right Top)'],
            ['page_key' => 'homepage', 'section_key' => 'trending_3', 'label' => 'Homepage Trending Main 3 (Small Card Right Bottom)'],
            ['page_key' => 'homepage', 'section_key' => 'editor_choice', 'label' => 'Homepage Editor Choice Main Article'],
            ['page_key' => 'homepage', 'section_key' => 'trending_side_1', 'label' => 'Homepage Trending Sidebar 1'],
            ['page_key' => 'homepage', 'section_key' => 'trending_side_2', 'label' => 'Homepage Trending Sidebar 2'],
            ['page_key' => 'homepage', 'section_key' => 'trending_side_3', 'label' => 'Homepage Trending Sidebar 3'],
            ['page_key' => 'homepage', 'section_key' => 'trending_side_4', 'label' => 'Homepage Trending Sidebar 4'],
            // --- BBI / WBBI PAGE ---
            ['page_key' => 'bbi_wbbi', 'section_key' => 'bbi_wbbi_hero_1', 'label' => 'BBI / WBBI Hero Carousel 1'],
            ['page_key' => 'bbi_wbbi', 'section_key' => 'bbi_wbbi_hero_2', 'label' => 'BBI / WBBI Hero Carousel 2'],
            ['page_key' => 'bbi_wbbi', 'section_key' => 'bbi_wbbi_hero_3', 'label' => 'BBI / WBBI Hero Carousel 3'],
            // --- INTERVIEW PAGE ---
            ['page_key' => 'interview', 'section_key' => 'main_highlight', 'label' => 'Interview Highlight Paling Atas'],
            // --- TOURNAMENT PAGE ---
            ['page_key' => 'tournament', 'section_key' => 'hero_carousel_1', 'label' => 'Tournament Hero Carousel 1'],
            ['page_key' => 'tournament', 'section_key' => 'hero_carousel_2', 'label' => 'Tournament Hero Carousel 2'],
            ['page_key' => 'tournament', 'section_key' => 'hero_carousel_3', 'label' => 'Tournament Hero Carousel 3'],
            ['page_key' => 'tournament', 'section_key' => 'hero_carousel_4', 'label' => 'Tournament Hero Carousel 4'],
            ['page_key' => 'tournament', 'section_key' => 'upcoming_match', 'label' => 'Turnamen Utama Terdekat'],
        ];

        $sections = [
            'home_and_match_centre' => [
                'prefix' => 'featured_video_home_match_',
                'slot_title' => 'Home & Match Centre Featured Video Slot',
            ],
            'tournament' => [
                'prefix' => 'featured_video_tournament_',
                'slot_title' => 'Tournament Featured Video Slot',
            ],
            'interview' => [
                'prefix' => 'featured_video_interview_',
                'slot_title' => 'Interview Featured Video Slot',
            ],
            'bbi_wbbi' => [
                'prefix' => 'featured_video_bbi_wbbi_',
                'slot_title' => 'BBI / WBBI Featured Video Slot',
            ],
        ];

        foreach ($sections as $pageKey => $config) {
            for ($i = 1; $i <= 10; $i++) {
                $slots[] = [
                    'page_key' => $pageKey,
                    'section_key' => $config['prefix'] . $i,
                    'label' => $config['slot_title'] . ' ' . $i,
                ];
            }
        }

        foreach ($slots as $slot) {
            PageSlot::firstOrCreate(
                ['section_key' => $slot['section_key']], 
                $slot
            );
        }
    }
}