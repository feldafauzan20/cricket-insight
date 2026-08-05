@props(['article' => null])

@php
    $title = $article?->title ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing.';
    $image = $article?->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/dummy/latest-news-card/dummy-latest-news-card.webp');
    $dateDay = $article?->published_at ? $article->published_at->format('d') : '23';
    $dateMonthYear = $article?->published_at ? strtoupper($article->published_at->format('M Y')) : 'APRIL 2026';
    $url = $article?->slug ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) : '#';
@endphp

<div class="mx-2.25 border border-[#A9A9A9] md:mx-0 dark:border-[#353737]">
    {{-- Card Image --}}
    <img src="{{ $image }}" alt="{{ $title }}"
        class="h-68 md:h-162.75 lg:h-68 2xl:h-102.75 w-full object-cover">

    {{-- Content --}}
    <div
        class="py-13.5 md:py-11.25 md:px-6.5 border border-t border-[#A9A9A9] px-5 dark:border-[#353737] dark:bg-[#1E1F1F]">
        <div class="gap-x-4.25 mb-7.5 md:mb-8.5 flex items-center">
            <div class="flex w-20 flex-col items-center justify-center bg-[#A6A182]/10 px-2.5 py-5 dark:bg-white/10">
                <p class="font-barlow-semi-condensed mb-2 text-[22px] font-bold text-[#B90F16] dark:text-white">{{ $dateDay }}</p>
                <p
                    class="font-figtree whitespace-nowrap text-xs font-bold leading-[135%] tracking-[-0.05em] text-[#AEB0B4]">
                    {{ $dateMonthYear }}</p>
            </div>
            <p
                class="font-barlow-semi-condensed md:w-63.5 line-clamp-2 text-xl font-bold uppercase leading-[130%] text-[#434343] md:block dark:text-white">
                {{ $title }}</p>
        </div>
        <a href="{{ $url }}"
            class="py-4.5 flex w-fit items-center justify-center gap-x-1.5 bg-[#97775B] px-8 text-white lg:w-full">
            Read More
            <svg width="13" height="13" viewBox="0 0 13 13" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M1.4 13L0 11.6L9.6 2H1V0H13V12H11V3.4L1.4 13Z" fill="currentColor" />
            </svg>
        </a>
    </div>
</div>
