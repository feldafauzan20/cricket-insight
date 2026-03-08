@extends('layout.main-layout')

@section('title', 'Home - Cricket Insight')

@section('content')

    {{-- LIVE SCORE CARD START --}}
    <div class="mt-29 md:mt-43 lg:mx-10 2xl:container 2xl:mx-auto mx-6 mb-7.5">
        <div class="swiper live-score-swiper overflow-hidden">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 15; $i++)
                    <div class="swiper-slide w-auto!">
                        <x-live-score-card />
                    </div>
                @endfor
            </div>
        </div>
    </div>
    {{-- LIVE SCORE CARD END --}}

    {{-- HERO SECTION START --}}
    <x-hero />
    {{-- HERO SECTION END --}}

@endsection
