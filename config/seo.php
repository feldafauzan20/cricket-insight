<?php

use RalphJSmit\Laravel\SEO\Models\SEO;

return [
    /**
     * The SEO model. You can use this setting to override the model used by the package.
     * Make sure to always extend the old model, so that you'll not lose functionality during upgrades.
     */
    'model' => SEO::class,

    /**
     * Use this setting to specify the site name that will be used in OpenGraph tags.
     */
    'site_name' => 'insightcricket.com',

    /**
     * Use this setting to specify the path to the sitemap of your website.
     * Example: '/sitemap.xml'
     */
    'sitemap' => '/sitemap.xml',

    /**
     * Use this setting to specify whether you want self-referencing `<link rel="canonical" href="$url">` tags to
     * be added to the head of every page.
     */
    'canonical_link' => true,

    'robots' => [
        /**
         * Use this setting to specify the default value of the robots meta tag.
         */
        'default' => 'max-snippet:-1,max-image-preview:large,max-video-preview:-1',

        /**
         * Force set the robots `default` value.
         */
        'force_default' => false,
    ],

    /**
     * Path to the favicon for your website.
     */
    'favicon' => '/favicon.ico',

    'title' => [
        /**
         * Automatically infer a title from URL / content if no other title is specified.
         */
        'infer_title_from_url' => true,

        /**
         * Enable automatic fallback from content/model title.
         */
        'fallback_from_content' => true,

        /**
         * Suffix added after the title on each page.
         */
        'suffix' => ' | insightcricket.com',

        /**
         * Custom title for the homepage.
         */
        'homepage_title' => 'insightcricket.com - Premier Cricket Insights & News',
    ],

    'description' => [
        /**
         * Fallback description used when no specific model/page description is provided.
         */
        'fallback' => 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.',

        /**
         * Enable automatic meta description generation/fallback from content.
         */
        'fallback_from_content' => true,
    ],

    'image' => [
        /**
         * Fallback Open Graph image used when no specific image is provided.
         */
        'fallback' => '/images/default-og.png',
    ],

    'author' => [
        /**
         * Fallback author.
         */
        'fallback' => 'insightcricket.com Editorial Team',
    ],

    'twitter' => [
        /**
         * Twitter Card @username.
         */
        '@username' => 'insightcricket',
    ],

    /**
     * Schema.org Structured Data Settings
     */
    'schema' => [
        'auto_generate' => true,
        'articles_enabled' => true,
        'pages_enabled' => true,
        'type' => 'Organization',
        'name' => 'insightcricket.com',
        'url' => env('APP_URL', 'https://insightcricket.com'),
        'logo' => '/images/default-og.png',
        'description' => 'Welcome to insightcricket.com — modern, fast, and SEO‑ready.',
    ],

    /**
     * Webmaster Verification Codes
     */
    'google_site_verification' => env('GOOGLE_SITE_VERIFICATION', '1_8EBXxTjfBYjhqOm2f8gV6SDoQ8H8-9vZs8ELIwP8o'),
    'bing_site_verification' => env('BING_SITE_VERIFICATION', null),
];
