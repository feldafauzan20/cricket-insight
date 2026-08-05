@extends('layout.main-layout')

@section('title', 'Home - Cricket Insight')

@section('content')

    {{-- LIVE SCORE CARD START --}}
    <div class="bg-[#F3F3F3] dark:bg-[#171717]">
        <div class="pt-29 lg:pt-35 pb-7.5 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
            @if (isset($hasError) && $hasError)
                <div class="mb-4 rounded-md border border-red-300 bg-white p-4 dark:border-red-500 dark:bg-[#353434]">
                    <p class="text-sm text-red-500">{{ $error ?? 'Failed to load live scores' }}</p>
                </div>
            @endif

            @if (!empty($matches))
                <div class="swiper live-score-swiper overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach ($matches as $match)
                            <div class="swiper-slide w-76!">
                                <x-cards.live-score-card :match="$match" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div
                    class="rounded-md border border-[#F5F5F5] bg-white p-8 text-center dark:border-[#515050] dark:bg-[#353434]">
                    <p class="text-sm text-[#A2A6A9]">No live matches available at the moment</p>
                </div>
            @endif
        </div>
    </div>
    {{-- LIVE SCORE CARD END --}}

    {{-- HERO SECTION START --}}
    <x-hero />
    {{-- HERO SECTION END --}}

    {{-- LATEST NEWS SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <x-latest-news />
    </section>
    {{-- LATEST NEWS SECTION END --}}

    <section class="hidden 2xl:container 2xl:mx-auto 2xl:block 2xl:pt-6">
        <h1 class="text-[24px] font-semibold text-[#121212] md:text-[22px] 2xl:text-4xl dark:text-[#EEEEEE]">
            {{ __('home.trending_header') }}</h1>
        <p class="mb-4 text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">{{ __('home.trending_sub_header') }}</p>
        <div class="my-4 flex md:my-0 md:mb-8 md:mt-4">
            <div class="w-48.5 2xl:w-88.5 h-px bg-[#EC0226]"></div>
            <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
        </div>
    </section>

    {{-- TRENDING SECTION START --}}
    <x-layout.two-column-layout>
        <x-slot name="main">
            <section class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
                <x-trending-news />
            </section>
            {{-- EDITOR CHOICES START --}}
            <section class="lg:mt-7.5 md:mx-7.5 mt-6 2xl:container lg:mx-10 2xl:mx-auto">
                <x-editor-choices />
            </section>
            {{-- EDITOR CHOICES END --}}
            {{-- ADS SECTION START --}}
            <section
                class="lg:mt-7.5 md:mx-7.5 lg:mb-7.5 mx-6 mb-7 mt-6 2xl:container md:mb-6 lg:mx-10 2xl:mx-auto 2xl:mb-6">

                {{-- Panggil Iklan Atas --}}
                <x-ads position="home_top" />

            </section>
            {{-- ADS SECTION END --}}

            {{-- COMMENTARIES SECTION START --}}
            <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto 2xl:mb-0">
                <x-commentaries />
            </section>
            {{-- COMMENTARIES SECTION END --}}
        </x-slot>
        <x-slot name="sidebar">
            {{-- POPULAR AND RECENT NEWS RANKING SECTION START --}}
            <div
                class="md:mx-7.5 mb-7 2xl:container md:mb-6 md:flex md:items-stretch md:gap-x-2.5 lg:mx-10 lg:mb-7 lg:flex-col 2xl:mx-auto 2xl:mb-6">
                <section class="mx-6 mb-7 md:mx-0 md:mb-0 md:flex md:w-1/2 md:flex-col md:items-stretch lg:mb-7 lg:w-full">
                    <x-popular-recent-news />
                </section>

                {{-- MENS AND WOMENS RANKING START --}}
                <section class="mx-6 md:mx-0 md:w-1/2 lg:w-full">
                    <x-mens-womens-ranking />
                </section>
                {{-- MENS AND WOMENS RANKING END --}}
            </div>
            {{-- POPULAR AND RECENT NEWS RANKING SECTION END --}}
            {{-- SOCIAL MEDIA SECTION START --}}
            <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
                <x-social-media />
            </section>
            {{-- SOCIAL MEDIA SECTION END --}}
            {{-- ADS SECTION START --}}
            <section
                class="lg:mt-7.5 md:mx-7.5 lg:mb-7.5 mx-6 mb-7 mt-6 2xl:container md:mb-6 lg:mx-10 2xl:mx-auto 2xl:mb-6">

                {{-- Panggil Iklan Atas --}}
                <x-ads position="home_middle" />

            </section>
            {{-- ADS SECTION END --}}
        </x-slot>
    </x-layout.two-column-layout>
    {{-- TRENDING SECTION END --}}

    {{-- NEWS FLASH SECTION START --}}
    <section class="md:mx-7.5 hidden 2xl:container md:mb-6 md:block lg:mx-10 lg:mb-10 2xl:mx-auto">
        @php
            use App\Models\NewsFlash;
            $newsFlash = NewsFlash::where('is_active', true)->orderByDesc('updated_at')->first();
            $newsText = $newsFlash?->description ?? ($newsFlash?->title ?? 'No news at the moment.');
        @endphp
        <x-news-flash>{{ $newsText }}</x-news-flash>
    </section>
    {{-- NEWS FLASH SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video page-key="home_and_match_centre" />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads position="home_bottom" />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="lg:pb-12.5 pb-12.5 bg-[#FAFAFA] md:pb-10 2xl:pb-20 dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
            <x-footer />
        </div>
    </section>
    {{-- FOOTER SECTION END --}}

@endsection
