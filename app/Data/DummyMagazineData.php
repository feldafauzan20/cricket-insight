<?php

namespace App\Data;

class DummyMagazineData {
    public static function all(): array {
        $categories = ['Matches', 'Interview', 'Analysis'];

        return array_map(function ($i) use ($categories) {
            return [
                'id' => $i,
                'title' => "PCI has made history by successfully hosting the event #{$i}",
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque faucibus ex sapien vitae.',
                'thumbnail_url' => "https://placehold.co/600x800?text=Issue+{$i}",
                'pdf_url' => "/dummy/magazines/issue-{$i}.pdf",
                'category' => $categories[$i % 3],
                'published_date' => now()->subDays($i * 3)->format('d M, Y'),
            ];
        }, range(1, 20));
    }
}
