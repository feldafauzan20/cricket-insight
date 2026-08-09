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
        Schema::create('bbi_wbbi_settings', function (Blueprint $table) {
            $table->id();

            // 1. Latest BBI CMS
            $table->string('latest_bbi_title')->nullable();
            $table->date('latest_bbi_date')->nullable();
            $table->text('latest_bbi_description')->nullable();
            $table->string('latest_bbi_thumbnail_1')->nullable();
            $table->string('latest_bbi_thumbnail_2')->nullable();
            $table->string('latest_bbi_logo')->nullable();
            $table->string('latest_bbi_livestream_link_1')->nullable();
            $table->string('latest_bbi_livestream_link_2')->nullable();

            // 2. BBI Article CMS (3 Articles)
            $table->foreignId('article_1_id')->nullable()->constrained('articles')->nullOnDelete();
            $table->foreignId('article_2_id')->nullable()->constrained('articles')->nullOnDelete();
            $table->foreignId('article_3_id')->nullable()->constrained('articles')->nullOnDelete();
            $table->string('article_redirect_link')->nullable();

            // 3. Highlight CMS
            $table->string('highlight_youtube_link')->nullable();
            $table->json('highlights')->nullable();

            // 4. Video Highlight CMS
            $table->string('loop_video_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bbi_wbbi_settings');
    }
};
