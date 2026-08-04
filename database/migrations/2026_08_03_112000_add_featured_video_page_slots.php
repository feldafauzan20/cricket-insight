<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\PageSlot;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sections = [
            'home_and_match_centre' => [
                'page_label' => 'Home Page & Match Centre',
                'prefix' => 'featured_video_home_match_',
                'slot_title' => 'Home & Match Centre Featured Video Slot',
            ],
            'tournament' => [
                'page_label' => 'Tournament Page',
                'prefix' => 'featured_video_tournament_',
                'slot_title' => 'Tournament Featured Video Slot',
            ],
            'interview' => [
                'page_label' => 'Interview Page',
                'prefix' => 'featured_video_interview_',
                'slot_title' => 'Interview Featured Video Slot',
            ],
            'bbi_wbbi' => [
                'page_label' => 'BBI / WBBI Page',
                'prefix' => 'featured_video_bbi_wbbi_',
                'slot_title' => 'BBI / WBBI Featured Video Slot',
            ],
        ];

        foreach ($sections as $pageKey => $config) {
            for ($i = 1; $i <= 10; $i++) {
                $sectionKey = $config['prefix'] . $i;
                $label = $config['slot_title'] . ' ' . $i;

                PageSlot::firstOrCreate(
                    ['section_key' => $sectionKey],
                    [
                        'page_key' => $pageKey,
                        'label' => $label,
                    ]
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_slots')
            ->where('section_key', 'like', 'featured_video_%')
            ->delete();
    }
};
