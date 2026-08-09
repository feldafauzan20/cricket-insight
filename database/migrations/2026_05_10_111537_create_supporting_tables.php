<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Nation Rankings
        Schema::create('nation_rankings', function (Blueprint $table) {
            $table->id();
            $table->integer('rank')->unique();
            $table->string('country_name');
            $table->string('flag_image')->nullable();
            $table->timestamps();
        });

        // Tabel News Flash
        Schema::create('news_flashes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        // Tabel Social Media Embeds
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->string('platform_name');
            $table->text('embed_url');
            $table->integer('sort_order')->default(0); 
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_medias');
        Schema::dropIfExists('news_flashes');
        Schema::dropIfExists('nation_rankings');
    }
};