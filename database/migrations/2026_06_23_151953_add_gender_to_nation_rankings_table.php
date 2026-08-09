<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nation_rankings', function (Blueprint $table) {
            // 1. Hapus unique constraint lama pada rank agar tidak bentrok antara cowok & cewek
            $table->dropUnique(['rank']);

            // 2. Tambahkan kolom gender setelah rank
            $table->string('gender')->default('mens')->after('rank'); // Isinya nanti: 'mens' atau 'womens'

            // 3. Buat aturan unique baru (gabungan rank + gender)
            $table->unique(['rank', 'gender']);
        });
    }

    public function down(): void
    {
        Schema::table('nation_rankings', function (Blueprint $table) {
            $table->dropUnique(['rank', 'gender']);
            $table->dropColumn('gender');
            $table->integer('rank')->unique()->change();
        });
    }
};