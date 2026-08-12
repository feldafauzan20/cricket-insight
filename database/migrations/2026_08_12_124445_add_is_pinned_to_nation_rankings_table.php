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
        Schema::table('nation_rankings', function (Blueprint $table) {
            $table->boolean('is_pinned')->default(false)->after('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nation_rankings', function (Blueprint $table) {
            $table->dropColumn('is_pinned');
        });
    }
};
