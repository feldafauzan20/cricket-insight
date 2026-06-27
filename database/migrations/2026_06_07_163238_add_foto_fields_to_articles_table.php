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
        $table->string('foto1')->nullable()->after('thumbnail');
        $table->string('foto2')->nullable()->after('foto1');
    });
}

public function down(): void
{
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn(['foto1', 'foto2']);
    });
}
};
