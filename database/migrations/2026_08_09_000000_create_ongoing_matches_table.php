<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ongoing_matches', function (Blueprint $table) {
            $table->id();
            $table->string('tournament_title');
            $table->string('image')->nullable();
            $table->string('redirect_link')->nullable();
            $table->dateTime('time_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ongoing_matches');
    }
};
