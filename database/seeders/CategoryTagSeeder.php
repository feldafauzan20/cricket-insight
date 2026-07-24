<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class CategoryTagSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori Wajib (Slug TIDAK BOLEH diubah karena dipakai di Resource)
        $categories = [
            ['name' => 'Berita Utama', 'slug' => 'news'],
            ['name' => 'Turnamen', 'slug' => 'tournament'],
            ['name' => 'Visual Story', 'slug' => 'visual-story'],
            ['name' => 'Gallery', 'slug' => 'gallery'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Buat Tag Dummy
        $tags = ['Cricket', 'World Cup', 'T20', 'Highlight', 'Timnas Indonesia', 'Ashes'];
        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag], ['name' => $tag, 'slug' => Str::slug($tag)]);
        }
    }
}