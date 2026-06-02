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
            ['page_key' => 'homepage', 'section_key' => 'trending_side_1', 'label' => 'Homepage Trending Sidebar 1'],
            
            // --- INTERVIEW PAGE ---
            ['page_key' => 'interview', 'section_key' => 'main_highlight', 'label' => 'Interview Highlight Paling Atas'],
            
            // --- TOURNAMENT PAGE ---
            ['page_key' => 'tournament', 'section_key' => 'upcoming_match', 'label' => 'Turnamen Utama Terdekat'],
        ];

        foreach ($slots as $slot) {
            PageSlot::firstOrCreate(
                ['section_key' => $slot['section_key']], 
                $slot
            );
        }
    }
}