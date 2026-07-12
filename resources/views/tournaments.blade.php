@extends('layout.main-layout')

@section('title', 'Tournaments - Cricket Insight')

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
    <x-hero.tournament-hero />
    {{-- HERO SECTION END --}}

    {{-- FEATURED TOURNAMENTS SECTION START --}}
    <section class="mx-6 mt-5 2xl:container lg:mx-10 2xl:mx-auto">
        <x-featured-tournaments />
    </section>
    {{-- FEATURED TOURNAMENTS SECTION END --}}

    {{-- TRENDING SECTION START --}}
    <x-layout.two-column-layout>
        <x-slot name="main">

            {{-- TOURNAMENTS LIST AND ONGOING TOURNAMENT SECTION START --}}
            <section class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
                <x-tournaments-list />
            </section>
            {{-- TOURNAMENTS LIST AND ONGOING TOURNAMENT SECTION END --}}

            {{-- ADS SECTION START --}}
            <section
                class="lg:mt-7.5 md:mx-7.5 lg:mb-7.5 mx-6 mb-7 mt-6 2xl:container md:mb-6 lg:mx-10 2xl:mx-auto 2xl:mb-6">

                {{-- Panggil Iklan Atas --}}
                <x-ads position="home_top" />

            </section>
            {{-- ADS SECTION END --}}

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

    {{-- TOURNAMENT NEWS SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <x-tournament-news />
    </section>
    {{-- TOURNAMENT NEWS SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        @php
            use App\Models\PageSlot;
            $featuredSlot = PageSlot::where('page_key', 'homepage')->where('section_key', 'featured_video')->first();
        @endphp

        <x-featured-video :slot-id="$featuredSlot?->id" />
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
