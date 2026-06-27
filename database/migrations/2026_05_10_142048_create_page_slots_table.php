<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_slots', function (Blueprint $table) {
            $table->id();
            
            // Lokasi penempatan (Hardcoded/Seeder nantinya)
            $table->string('page_key');    // cth: 'homepage', 'news_page', 'interview_page'
            $table->string('section_key'); // cth: 'hero_carousel', 'trending_side', 'featured_video'
            $table->string('label');       // cth: 'Homepage Hero Carousel 1' (Untuk dibaca Admin)
            
            // Relasi ke Gudang Konten (Bisa pilih salah satu tergantung jenis slotnya)
            $table->foreignId('article_id')->nullable()->constrained('articles')->nullOnDelete();
            $table->foreignId('video_id')->nullable()->constrained('videos')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_slots');
    }
};