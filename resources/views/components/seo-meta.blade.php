@php
    $seo = \App\Models\SeoSetting::getSettings();
    $pageTitle = $title ?? trim($__env->yieldContent('title'));
    if (empty($pageTitle)) {
        $pageTitle = $seo->homepage_title ?? $seo->site_name;
    }
    $pageDescription = $description ?? $seo->meta_description;
    $pageKeywords = $keywords ?? $seo->meta_keywords;
    $canonical = $canonicalUrl ?? ($seo->canonical_url ?: url()->current());
    $ogImage = $image ?? ($seo->og_image ? (str_starts_with($seo->og_image, 'http') ? $seo->og_image : asset($seo->og_image)) : asset('images/logo/cricket-insight-logo-blue.webp'));
    $twitterSite = $seo->twitter_username ? (str_starts_with($seo->twitter_username, '@') ? $seo->twitter_username : '@' . $seo->twitter_username) : null;
    $twitterCreator = $seo->twitter_creator ? (str_starts_with($seo->twitter_creator, '@') ? $seo->twitter_creator : '@' . $seo->twitter_creator) : null;
    $googleVerification = $seo->google_site_verification ? str_replace('google-site-verification=', '', $seo->google_site_verification) : null;

    $schemaData = [
        '@context' => 'https://schema.org',
        '@type' => $seo->schema_type ?: 'Organization',
        'name' => $seo->schema_name ?: $seo->site_name,
        'url' => $seo->schema_url ?: url('/'),
        'logo' => $seo->schema_logo ? (str_starts_with($seo->schema_logo, 'http') ? $seo->schema_logo : asset($seo->schema_logo)) : asset('images/logo/cricket-insight-logo-blue.webp'),
        'description' => $seo->schema_description ?: $seo->meta_description,
    ];
@endphp

<!-- Basic Meta Tags -->
@if(!empty($pageDescription))
<meta name="description" content="{{ $pageDescription }}">
@endif
@if(!empty($pageKeywords))
<meta name="keywords" content="{{ $pageKeywords }}">
@endif
@if(!empty($seo->author_default))
<meta name="author" content="{{ $seo->author_default }}">
@endif
@if(!empty($seo->robots_default))
<meta name="robots" content="{{ $seo->robots_default }}">
@endif
@if($seo->enable_canonical_link)
<link rel="canonical" href="{{ $canonical }}">
@endif

<!-- Open Graph Meta Tags -->
@if($seo->enable_open_graph)
<meta property="og:site_name" content="{{ $seo->og_site_name ?: $seo->site_name }}">
<meta property="og:type" content="{{ $seo->og_type ?: 'website' }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonical }}">
@if(!empty($ogImage))
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:alt" content="{{ $pageTitle }}">
@endif
@endif

<!-- Twitter Cards Meta Tags -->
@if($seo->enable_twitter_card)
<meta name="twitter:card" content="{{ $seo->twitter_card_type ?: 'summary_large_image' }}">
@if(!empty($twitterSite))
<meta name="twitter:site" content="{{ $twitterSite }}">
@endif
@if(!empty($twitterCreator))
<meta name="twitter:creator" content="{{ $twitterCreator }}">
@endif
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
@if(!empty($ogImage))
<meta name="twitter:image" content="{{ $ogImage }}">
@endif
@endif

<!-- Webmaster Verification -->
@if(!empty($googleVerification))
<meta name="google-site-verification" content="{{ $googleVerification }}">
@endif
@if(!empty($seo->bing_site_verification))
<meta name="msvalidate.01" content="{{ $seo->bing_site_verification }}">
@endif

<!-- JSON-LD Schema Structured Data -->
@if($seo->enable_json_ld && $seo->auto_schema_generation)
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if(!empty($seo->custom_json_ld))
<script type="application/ld+json">
{!! $seo->custom_json_ld !!}
</script>
@endif
