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
        Schema::create('ongoing_tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('tournament_title');
            $table->string('image')->nullable();
            $table->string('redirect_link')->nullable();
            $table->dateTime('time_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ongoing_tournaments');
    }
};
