@extends('layout.main-layout')

@section('title', 'Interview - Cricket Insight')

@section('content')
    {{-- LIVE SCORE CARD START --}}
    <section class="md:mb-7.5 mb-5 bg-[#F3F3F3] dark:bg-[#171717]">
        <div class="pt-29 lg:pt-35 pb-7.5 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
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
    </section>
    {{-- LIVE SCORE CARD END --}}

    {{-- BEST INTERVIEW SECTION START --}}
    <section class="md:mb-7.5 mx-6 mb-7 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
        <x-interview.interview-header header="Interview"
            description="Explore the most insightful interviews with cricket players and experts." />
        <x-interview.best-interview />
    </section>
    {{-- BEST INTERVIEW SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 md:mb-7.5 mx-6 mb-7 2xl:container lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- INTERVIEW VIDEOS SECTION START --}}
    <section class="md:mb-7.5 2xl:mb-12.5 mx-6 mb-7 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
        <x-interview.interview-videos />
    </section>
    {{-- INTERVIEW VIDEOS SECTION END --}}

    {{-- ALL INTERVIEW SECTION START --}}
    <section class="md:mb-7.5 2xl:mb-12.5 mx-6 mb-7 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
        <x-interview.all-interview />
    </section>
    {{-- ALL INTERVIEW SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video page-key="interview" />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="lg:pb-12.5 bg-[#FAFAFA] pb-5 md:pb-10 2xl:pb-20 dark:bg-[#171717]">
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
