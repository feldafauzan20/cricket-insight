<?php

namespace App\Support\Seo;

use App\Models\Article;
use Illuminate\Support\Str;

class JsonLd
{
    public static function newsArticle(Article $article, string $canonicalUrl): array
    {
        $images = collect([$article->thumbnail, $article->foto1, $article->foto2])
            ->filter()
            ->map(fn (string $path) => Str::startsWith($path, ['http://', 'https://'])
                ? $path
                : asset('storage/' . $path))
            ->values()
            ->all();

        $authorName = $article->uploader->name ?? null;

        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article->title,
            'description' => strip_tags((string) $article->description),
            'image' => $images,
            'datePublished' => optional($article->published_at)->toIso8601String(),
            'dateModified' => optional($article->updated_at)->toIso8601String(),
            'author' => $authorName
                ? ['@type' => 'Person', 'name' => $authorName]
                : ['@type' => 'Organization', 'name' => 'Cricket Insight'],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Cricket Insight',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo/cricket-insight-logo-blue.webp'),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl,
            ],
            'articleSection' => $article->category->name ?? null,
            'keywords' => $article->tags->pluck('name')->implode(', ') ?: null,
            'inLanguage' => app()->getLocale() === 'en' ? 'en-US' : 'id-ID',
        ];
    }

    public static function imageGallery(array $galleries): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'ImageGallery',
            'image' => array_map(fn (array $item) => [
                '@type' => 'ImageObject',
                'contentUrl' => $item['image_url'] ?? null,
                'name' => $item['title'] ?? null,
                'description' => strip_tags((string) ($item['description'] ?? '')) ?: null,
            ], $galleries),
        ];
    }

    public static function breadcrumbList(array $items, string $pageUrl): array
    {
        $itemListElement = [];

        foreach ($items as $index => $item) {
            $isLast = $index === array_key_last($items);
            $url = $isLast ? $pageUrl : ($item['url'] ?? $pageUrl);

            $itemListElement[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'] ?? null,
                'item' => $url,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemListElement,
        ];
    }
}
