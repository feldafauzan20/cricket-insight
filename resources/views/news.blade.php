@extends('layout.main-layout')

@section('title', 'News - Cricket Insight')

@section('content')
    {{-- LIVE SCORE CARD START --}}
    <section class="bg-[#F3F3F3] dark:bg-[#171717]">
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
    </section>
    {{-- LIVE SCORE CARD END --}}

    {{-- BREADCRUM, HEADER, AND TOP PAGINATION SECTION START --}}
    <section class="mx-6">

    </section>
    {{-- BREADCRUM, HEADER, AND TOP PAGINATION SECTION END --}}

@endsection
