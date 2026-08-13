<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bbi_wbbi_settings', function (Blueprint $table) {
            $table->foreignId('brand_story_1_id')->nullable()->after('article_3_id')->constrained('articles')->nullOnDelete();
            $table->foreignId('brand_story_2_id')->nullable()->after('brand_story_1_id')->constrained('articles')->nullOnDelete();
            $table->foreignId('brand_story_3_id')->nullable()->after('brand_story_2_id')->constrained('articles')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bbi_wbbi_settings', function (Blueprint $table) {
            $table->dropForeign(['brand_story_1_id']);
            $table->dropForeign(['brand_story_2_id']);
            $table->dropForeign(['brand_story_3_id']);
            $table->dropColumn(['brand_story_1_id', 'brand_story_2_id', 'brand_story_3_id']);
        });
    }
};
