<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nation_rankings', function (Blueprint $table) {
            // Menambahkan kolom score, default 0 kalau kosong
            $table->integer('score')->default(0)->after('country_name');
        });
    }

    public function down(): void
    {
        Schema::table('nation_rankings', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }
};