@extends('layout.blank-layout')

@section('title', __('seo.bbi_wbbi_title'))

@php
    $seoDescription = __('seo.bbi_wbbi_description');
    $seoCanonicalRoute = 'bbi-wbbi';
    $seoHreflangRoute = 'bbi-wbbi';
@endphp

@section('navbar')
    @include('components.navbar.bbi-wbbi-navbar')
@endsection

@section('content')

    {{-- HERO SECTION START --}}
    <x-hero.bbi-wbbi-hero />
    {{-- HERO SECTION END --}}

    {{-- INFORMATION SECTION START --}}
    <section class="border-b border-[#B6B6B6] dark:bg-[#1F2022]">
        <x-bbi-wbbi-information :setting="$setting ?? null" />
    </section>
    {{-- INFORMATION SECTION END --}}

    {{-- SCHEDULE SECTION START --}}
    <section id="schedule" class="pt-12.5 md:pt-25 2xl:pt-30 pb-12.5 md:pb-34.75 2xl:pb-27.25 dark:bg-[#1F2022]">
        <div class="lg:mx-30 mx-2.5 2xl:container md:mx-10 2xl:mx-auto">
            <x-bbi-wbbi-schedule :setting="$setting ?? null" />
        </div>
    </section>
    {{-- SCHEDULE SECTION END --}}

    {{-- MARQUEE SECTION START --}}
    <section class="dark:bg-[#1F2022]">
        <x-ticker.top-stories-ticker />
    </section>
    {{-- MARQUEE SECTION END --}}

    <section class="pt-12.5 md:pt-25 pb-12.5 md:pb-25 bg-[#FAF8F3] dark:bg-[#080907]">
        {{-- BRAND NEW STORIES SECTION START --}}
        <x-brand-new-stories :setting="$setting ?? null" id="top-stories"/>
        {{-- BRAND NEW STORIES SECTION END --}}

        {{-- HIGHLIGHT SECTION START --}}
        <x-highlighted-games-bbi-wbbi :setting="$setting ?? null" id="highlighted-games" />
        {{-- HIGHLIGHT SECTION END --}}

        {{-- BBI WBBI ARTICLES SECTION START --}}
        <x-bbi-wbbi-articles :setting="$setting ?? null" :latestBbiArticles="$latestBbiArticles ?? null" id="article" />
        {{-- BBI WBBI ARTICLES SECTION END --}}

        {{-- YOUTUBE VIDEO SECTION START --}}
        <x-youtube-video-bbi-wbbi :setting="$setting ?? null" />
        {{-- YOUTUBE VIDEO SECTION END --}}

    </section>

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video.bbi-wbbi-featured-video />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- STREAMING PARTNER LOGO MARQUEE SECTION START --}}
    <section>
        <x-streaming-partner-bbi-wbbi />
    </section>
    {{-- STREAMING PARTNER LOGO MARQUEE SECTION END --}}

    {{-- MARQUEE 2 SECTION START --}}
    <section class="md:mt-8.75 lg:mt-25">
        <x-second-marquee-bbi-wbbi />
    </section>
    {{-- MARQUEE 2 SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="md:mx-7.5 mt-12.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
        <x-footer-bbi-wbbi />
    </section>
    {{-- FOOTER SECTION END --}}

@endsection
