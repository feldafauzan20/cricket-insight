@extends('layout.main-layout')

@section('title', 'Search - Cricket Insight')

@section('content')
    @php
        $seoNoindex = true;
    @endphp
    <section class="pt-29 lg:pt-35 pb-7.5 mx-6 xl:mx-30 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">
        <div class="mb-2.5">
            <x-bread-crumb :items="[
                ['title' => 'Home', 'url' => route('home', ['locale' => app()->getLocale()])],
                ['title' => 'Search'],
            ]" />
        </div>

        <h1 class="text-2xl font-semibold text-[#121212] md:text-3xl dark:text-white">
            @if ($q !== '')
                Search results for "{{ $q }}"
            @else
                Search
            @endif
        </h1>
    </section>

    <section class="mx-6 md:mx-8 xl:mx-30 lg:mx-10 2xl:container 2xl:mx-auto mb-10">
        @if ($q === '')
            <p class="text-[#666] dark:text-[#D8D8D8]">Type a keyword in the search bar to get started.</p>
        @elseif ($news->isEmpty() && $interviews->isEmpty() && $tournaments->isEmpty())
            <p class="text-[#666] dark:text-[#D8D8D8]">No results found for "{{ $q }}".</p>
        @else
            @if ($news->isNotEmpty())
                <div class="mb-10">
                    <div class="mb-5 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-[#121212] dark:text-white">News</h2>
                        <a href="{{ route('news.index', ['locale' => app()->getLocale()]) }}"
                            class="text-xs font-semibold text-[#EC0226]">See all news &raquo;</a>
                    </div>
                    <div class="flex flex-col gap-y-7.5">
                        @foreach ($news as $article)
                            <x-cards.news-card :article="$article" />
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($interviews->isNotEmpty())
                <div class="mb-10">
                    <div class="mb-5 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-[#121212] dark:text-white">Interviews</h2>
                        <a href="{{ route('interviews.index', ['locale' => app()->getLocale()]) }}"
                            class="text-xs font-semibold text-[#EC0226]">See all interviews &raquo;</a>
                    </div>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        @foreach ($interviews as $article)
                            <x-cards.all-interview-card :article="$article" />
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($tournaments->isNotEmpty())
                <div class="mb-10">
                    <div class="mb-5 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-[#121212] dark:text-white">Tournaments</h2>
                        <a href="{{ route('tournaments.index', ['locale' => app()->getLocale()]) }}"
                            class="text-xs font-semibold text-[#EC0226]">See all tournaments &raquo;</a>
                    </div>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($tournaments as $tournament)
                            <x-cards.ongoing-tournament-card :tournament="$tournament" />
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </section>
@endsection
