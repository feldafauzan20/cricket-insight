@extends('layout.main-layout')

@section('title', isset($article) ? $article->title . ' - Cricket Insight' : __('seo.matches_title'))

@section('content')
    @if (isset($article))
        @php
            $seoTitle = $article->title;
            $seoDescription = $article->description;
            $seoImage = $article->thumbnail ? asset('storage/' . $article->thumbnail) : null;
            $seoType = 'article';
            $seoPublishedTime = optional($article->published_at)->toIso8601String();
            $seoModifiedTime = optional($article->updated_at)->toIso8601String();
            $seoCanonicalRoute = 'matches.show';
            $seoCanonicalParams = ['slug' => $article->slug];
            $seoHreflangRoute = $seoCanonicalRoute;
            $seoHreflangParams = $seoCanonicalParams;
            $seoJsonLd = \App\Support\Seo\JsonLd::newsArticle($article, route($seoCanonicalRoute, array_merge($seoCanonicalParams, ['locale' => app()->getLocale()])));
        @endphp
    @else
        @php
            $seoDescription = __('seo.matches_description');
            $seoCanonicalRoute = 'matches.index';
            $seoHreflangRoute = 'matches.index';
        @endphp
    @endif

    {{-- ONGOING TOURNAMENT SECTION START --}}
    <section class="lg:pt-35 pb-7.5 md:pt-35 mx-6 mb-7 xl:mx-30 pt-44 2xl:container md:mx-8 md:mb-6 lg:mx-9 lg:mb-10 2xl:mx-auto">
        <x-ongoing-tournament :tournaments="$ongoingMatches ?? []" />
    </section>
    {{-- ONGOING TOURNAMENT SECTION END --}}

    {{-- FIXTURES AND RESULTS SECTION START --}}
    <section class="lg:mb-17.5 mx-6 mb-7 2xl:container xl:mx-30 md:mx-8 md:mb-6 lg:mx-10 2xl:mx-auto">
        <x-fixtures-results :seriesList="$seriesList ?? []" :currentYear="$currentYear ?? now()->year"  />
    </section>
    {{-- FIXTURES AND RESULTS SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 lg:mb-12.5 mx-6 mb-7 xl:mx-30 2xl:container md:mb-6 lg:mx-10 2xl:mx-auto">
        <x-ads position="match_centre_top" />
    </section>
    {{-- ADS SECTION END --}}

    {{-- POINTS TABLE SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 xl:mx-30 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-points-table :seriesList="$seriesList ?? []" :currentYear="$currentYear ?? now()->year" />
    </section>
    {{-- POINTS TABLE SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video.match-centre-featured-video />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 xl:mx-30 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads position="match_centre_bottom" />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="lg:pb-12.5 pb-12.5 bg-[#FAFAFA] md:pb-10 2xl:pb-20 dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 xl:mx-30 2xl:container lg:mx-10 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 xl:mx-30 2xl:container lg:mx-10 2xl:mx-auto">
            <x-footer />
        </div>
    </section>
    {{-- FOOTER SECTION END --}}

@endsection
