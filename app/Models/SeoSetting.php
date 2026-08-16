<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $table = 'seo_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'enable_canonical_link' => 'boolean',
        'enable_open_graph' => 'boolean',
        'enable_twitter_card' => 'boolean',
        'enable_json_ld' => 'boolean',
        'auto_schema_generation' => 'boolean',
    ];

    public static function getSettings(): static
    {
        return static::firstOrCreate([], [
            'site_name' => config('seo.site_name', 'insightcricket.com'),
            'title_suffix' => config('seo.title.suffix', ' | insightcricket.com'),
            'homepage_title' => config('seo.title.homepage_title', 'insightcricket.com - Premier Cricket Insights & News'),
            'meta_description' => config('seo.description.fallback', 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.'),
            'meta_keywords' => 'cricket, cricket insights, match schedules, tournament news, player rankings, live scores, ball by ball',
            'enable_canonical_link' => true,
            'robots_default' => 'max-snippet:-1,max-image-preview:large,max-video-preview:-1',
            'author_default' => config('seo.author.fallback', 'insightcricket.com Editorial Team'),
            'favicon' => '/favicon.ico',
            'enable_open_graph' => true,
            'og_title' => 'insightcricket.com',
            'og_description' => 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.',
            'og_image' => config('seo.image.fallback', '/images/default-og.png'),
            'og_type' => 'website',
            'og_site_name' => 'insightcricket.com',
            'enable_twitter_card' => true,
            'twitter_card_type' => 'summary_large_image',
            'twitter_username' => 'insightcricket',
            'twitter_creator' => '@insightcricket',
            'enable_json_ld' => true,
            'auto_schema_generation' => true,
            'schema_type' => 'Organization',
            'schema_name' => 'insightcricket.com',
            'schema_url' => config('app.url', 'https://insightcricket.com'),
            'schema_logo' => config('seo.image.fallback', '/images/default-og.png'),
            'schema_description' => 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.',
        ]);
    }
}
