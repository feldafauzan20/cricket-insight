<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Utama Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            
            // Relasi User (Writer) dan Category
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            
            // Konten Utama
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('source_link')->nullable(); // Untuk link berita eksternal
            
            // Metrik & Klasifikasi
            $table->unsignedBigInteger('views_count')->default(0)->index();
            $table->boolean('is_editor_choice')->default(false)->index();
            $table->boolean('is_trending_manual')->default(false)->index();
            
            // Kolom Spesifik Halaman (Nullable)
            $table->dateTime('match_date')->nullable(); // Khusus Tournament
            $table->year('visual_year')->nullable();    // Khusus Explore Visual
            
            // Status & Timestamps
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot table untuk relasi Many-to-Many (Articles & Tags)
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->unique(['article_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('articles');
    }
};