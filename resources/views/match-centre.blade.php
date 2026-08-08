@extends('layout.main-layout')

@section('title', 'Match Centre - Cricket Insight')

@section('content')

    {{-- ONGOING TOURNAMENT SECTION START --}}
    <section class="lg:pt-35 pb-7.5 md:pt-35 mx-6 mb-7 pt-44 2xl:container md:mx-8 md:mb-6 lg:mx-9 lg:mb-10 2xl:mx-auto">
        <x-ongoing-tournament />
    </section>
    {{-- ONGOING TOURNAMENT SECTION END --}}

    {{-- FIXTURES AND RESULTS SECTION START --}}
    <section class="lg:mb-17.5 mx-6 mb-7 2xl:container md:mx-8 md:mb-6 lg:mx-10 2xl:mx-auto">
        <x-fixtures-results :seriesList="$seriesList" :currentYear="$currentYear"  />
    </section>
    {{-- FIXTURES AND RESULTS SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 lg:mb-12.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 2xl:mx-auto">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- POINTS TABLE SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-points-table :seriesList="$seriesList" :currentYear="$currentYear" />
    </section>
    {{-- POINTS TABLE SECTION END --}}

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video page-key="home_and_match_centre" />
    </section>
    {{-- FEATURED VIDEO SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads />
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
