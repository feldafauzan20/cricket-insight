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
        Schema::table('social_medias', function (Blueprint $table) {
            $table->text('sosmed_link')->nullable()->after('platform_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_medias', function (Blueprint $table) {
            $table->dropColumn('sosmed_link');
        });
    }
};
