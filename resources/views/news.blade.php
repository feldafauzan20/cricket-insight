@extends('layout.main-layout')

@section('title', 'News - Cricket Insight')

@section('content')
    {{-- LIVE SCORE CARD START --}}
    <div class="bg-[#F3F3F3] dark:bg-[#171717]">
        <div class="pt-29 lg:pt-35 pb-7.5 mx-6 xl:mx-30 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
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

    {{-- BREADCRUM AND HEADER SECTION START --}}
    <section class="mx-6 md:mx-8 lg:mx-10 xl:mx-30 2xl:container 2xl:mx-auto">
        <div class="mb-2.5">
            <x-bread-crumb :items="[
                ['title' => 'Home', 'url' => route('home', ['locale' => app()->getLocale()])],
                ['title' => 'News', 'url' => route('news.index', ['locale' => app()->getLocale()])],
                ['title' => 'Global'],
            ]" />
        </div>
        <div class="mb-5 md:mb-3.75 lg:mb-2.5">
            <x-news-header />
        </div>
        <div>
            <x-filter.filter
                :categories="$categories"
                :tags="$tags"
                :sort-options="$sortOptions"
                :time-frames="$timeFrames"
                :popularity-options="$popularityOptions"
                :region-options="$regionOptions"
                :filters="$filters"
            />
        </div>
    </section>
    {{-- BREADCRUM AND HEADER SECTION END --}}

    {{-- SEPARATOR LINE SECTION START --}}
    <section class="mx-6 md:mx-8 lg:mx-10 xl:mx-30 2xl:container 2xl:mx-auto">
        <div class="flex my-4 md:my-0 md:mt-4 2xl:mt-5 md:mb-5.75 lg:mb-10.5 2xl:mb-8.25 ">
            <div class="w-48.5 2xl:w-88.5 h-px bg-[#EC0226]"></div>
            <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
        </div>
    </section>
    {{-- SEPARATOR LINE SECTION END --}}

    <x-layout.two-column-layout paddingRight="2xl:pr-9.25" marginRight="2xl:mr-9.25">
        <x-slot name="main">
            {{-- NEWS CONTENT SECTION START --}}
            <section class="mx-6 md:mx-8 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto mb-5 md:mb-7.5 2xl:mb-6.25">
                <div class="flex flex-col gap-y-7.5">
                    @forelse ($news as $newsItem)
                        <x-cards.news-card :article="$newsItem" />
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400">No news available.</p>
                    @endforelse
                </div>
            </section>
            {{-- NEWS CONTENT SECTION END --}}

            {{-- ADS SECTION START --}}
            <section class="mx-6 md:mx-8 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto">
                {{-- ADS HEADER --}}
                <x-ads.ads-header />

                {{-- ADS SEPARATOR --}}
                <div class="flex my-5 md:my-0 md:mt-5 2xl:mt-5 md:mb-10 2xl:mb-6.25 ">
                    <div class="w-17.5 h-px bg-[#EC0226]"></div>
                    <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
                </div>

                {{-- ADS CONTENT --}}
                <div class="flex flex-col 2xl:flex-row gap-y-5 2xl:gap-y-0 2xl:gap-x-7.5 mb-7.5">
                    <x-ads position="news_slot_1" />
                    <x-ads position="news_slot_2" />
                </div>

                <div class="mb-7.5">
                    <x-ads position="news_slot_3" />
                </div>

                <div class="flex flex-col 2xl:flex-row gap-y-5 2xl:gap-y-0 2xl:gap-x-7.5 mb-5 2xl:mb-7.5">
                    <x-ads position="news_slot_4" />
                    <x-ads position="news_slot_5" />
                </div>

                <div class="flex flex-col gap-y-5 mb-7.5">
                    <x-ads position="news_slot_6" />
                    <x-ads position="news_slot_7" />
                </div>
                <div class="mb-5 md:mb-7.5">
                    <x-ads position="news_slot_8" />
                </div>
                <div class="mb-7.5">
                    <x-pagination.pagination :paginator="$news" />
                </div>
            </section>
            {{-- ADS SECTION END --}}
        </x-slot>
        <x-slot name="sidebar">
            {{-- POPULAR AND RECENT NEWS RANKING SECTION START --}}
            <div
                class="md:flex xl:mx-30 lg:flex-col md:gap-x-2.5 md:items-stretch md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-7 2xl:mb-6">
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
            <section class="mx-6 md:mx-7.5 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
                <x-social-media />
            </section>
            {{-- SOCIAL MEDIA SECTION END --}}
            {{-- ADS SECTION START --}}
            <section class="mt-6 lg:mt-7.5 mx-6 xl:mx-30 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
                <x-ads position="news_sidebar" />
            </section>
            {{-- ADS SECTION END --}}
        </x-slot>
    </x-layout.two-column-layout>

    {{-- ADS SECTION START --}}
    <section class="mx-6 md:mx-7.5 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
        <x-ads position="news_bottom" />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717] pb-5 md:pb-10 lg:pb-12.5 2xl:pb-20">
        <div class="mx-6 md:mx-7.5 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="mx-6 md:mx-7.5 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto">
            <x-footer />
        </div>
    </section>
    {{-- FOOTER SECTION END --}}

@endsection
