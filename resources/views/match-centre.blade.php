@extends('layout.main-layout')

@section('title', 'Match Centre - Cricket Insight')

@section('content')

    {{-- FEATURED VIDEO SECTION START --}}
    <section class="mb-7 md:mb-6 lg:mb-10">
        <x-featured-video />
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
