<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 100 news records for comprehensive pagination testing
        // This allows testing all 4 pagination scenarios:
        // - Pages 1-3 (first scenario)
        // - Middle pages (middle scenario)
        // - Last 3 pages (last scenario)
        // - Total pages <= 7 (if we adjust items per page)
        News::factory()->count(100)->create();
    }
}
