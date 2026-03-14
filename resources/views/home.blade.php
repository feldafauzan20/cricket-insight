@extends('layout.main-layout')

@section('title', 'Home - Cricket Insight')

@section('content')

    {{-- LIVE SCORE CARD START --}}
    <div class="bg-[#F3F3F3] dark:bg-[#171717]">
        <div class="pt-29 lg:pt-35 2xl:container 2xl:mx-auto mx-6 md:mx-8 lg:mx-10 pb-7.5 ">
            <div class="swiper live-score-swiper overflow-hidden">
                <div class="swiper-wrapper">
                    @for ($i = 0; $i < 15; $i++)
                        <div class="swiper-slide w-auto!">
                            <x-cards.live-score-card />
                        </div>
                    @endfor
                </div>
            </div>
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

    <section class="hidden 2xl:block 2xl:container 2xl:mx-auto 2xl:pt-6">
        <h1 class="font-semibold text-[24px] md:text-[22px] 2xl:text-4xl text-[#121212] dark:text-[#EEEEEE] ">Trending</h1>
        <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2] mb-4">Don't miss daily news</p>
        <div class="flex my-4 md:my-0 md:mt-4 md:mb-8">
            <div class="w-48.5 2xl:w-88.5 h-px bg-[#EC0226]"></div>
            <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
        </div>
    </section>

    {{-- TRENDING SECTION START --}}
    <section class="2xl:container 2xl:mx-auto mt-4 md:mt-6 lg:mt-8.5 mb-6 lg:mb-7.5 2xl:flex">
        <div class="2xl:border-r 2xl:border-r-[#DEDEDE] dark:border-r-[#DEDEDE] 2xl:pr-5 2xl:mr-5 2xl:w-7/10">
            <section class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
                <x-trending-news />
            </section>
            {{-- EDITOR CHOICES START --}}
            <section class="mt-6 lg:mt-7.5 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
                <x-editor-choices />
            </section>
            {{-- EDITOR CHOICES END --}}
            {{-- ADS SECTION START --}}
            <section
                class="mt-6 lg:mt-7.5 mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-7.5 2xl:mb-6">
                <x-ads />
            </section>
            {{-- ADS SECTION END --}}

            {{-- COMMENTARIES SECTION START --}}
            <section class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10 2xl:mb-0">
                <x-commentaries />
            </section>
            {{-- COMMENTARIES SECTION END --}}
        </div>
        <div class="2xl:w-3/10">
            {{-- POPULAR AND RECENT NEWS RANKING SECTION START --}}
            <div
                class="md:flex lg:flex-col md:gap-x-2.5 md:items-stretch md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-7 2xl:mb-6">
                <section class="mx-6 md:mx-0 mb-7 md:mb-0 lg:mb-7 md:w-1/2 lg:w-full md:flex md:flex-col md:items-stretch">
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
            <section class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
                <x-social-media />
            </section>
            {{-- SOCIAL MEDIA SECTION END --}}
            {{-- ADS SECTION START --}}
            <section class="mt-6 lg:mt-7.5 mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
                <x-ads />
            </section>
            {{-- ADS SECTION END --}}
        </div>
    </section>
    {{-- TRENDING SECTION END --}}

    {{-- NEWS FLASH SECTION START --}}
    <section class="hidden md:block md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto md:mb-6 lg:mb-10">
        <x-news-flash>
            Breaking News: India wins the cricket world cup! • England defeats Australia • New tournament announced
        </x-news-flash>
    </section>
    {{-- NEWS FLASH SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717] pb-5 md:pb-10 lg:pb-12.5 2xl:pb-20">
        <div class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
            <x-footer />
        </div>
    </section>
    {{-- FOOTER SECTION END --}}

@endsection
