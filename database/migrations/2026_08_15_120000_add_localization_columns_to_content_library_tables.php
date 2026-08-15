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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->longText('content_en')->nullable()->after('content');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('ongoing_tournaments', function (Blueprint $table) {
            $table->string('tournament_title_en')->nullable()->after('tournament_title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('ongoing_matches', function (Blueprint $table) {
            $table->string('tournament_title_en')->nullable()->after('tournament_title');
            $table->longText('description_en')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en', 'content_en']);
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('ongoing_tournaments', function (Blueprint $table) {
            $table->dropColumn(['tournament_title_en', 'description_en']);
        });

        Schema::table('ongoing_matches', function (Blueprint $table) {
            $table->dropColumn(['tournament_title_en', 'description_en']);
        });
    }
};
