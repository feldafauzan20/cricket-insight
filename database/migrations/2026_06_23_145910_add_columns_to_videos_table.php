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
        Schema::table('videos', function (Blueprint $table) {
            // Menambahkan kolom user_id, category_id, dan views tepat setelah video_type
            $table->foreignId('user_id')->nullable()->after('video_type')->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained('categories')->nullOnDelete();
            $table->integer('views')->default(0)->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu sebelum menghapus kolomnya
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
            
            // Hapus kolom
            $table->dropColumn(['user_id', 'category_id', 'views']);
        });
    }
};