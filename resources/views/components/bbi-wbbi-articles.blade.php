@props(['setting' => null])

@php
    $readMoreUrl = $setting?->article_redirect_link ?? route('news.index');
    $article1 = $setting?->article1;
    $article2 = $setting?->article2;
    $article3 = $setting?->article3;
@endphp

<div
    class="mt-25 mb-16.25 lg:mb-8.75 flex flex-col items-center 2xl:container md:mx-10 md:items-start lg:flex-row lg:items-center lg:justify-between 2xl:mx-auto">
    <h1
        class="font-barlow-semi-condensed md:w-172.5 lg:w-124 mb-5 text-center text-2xl font-bold uppercase text-[#434343] md:block md:text-left md:text-[54px] dark:text-white">
        read our latest bbi’s article
    </h1>
    <a href="{{ $readMoreUrl }}" class="py-4.5 flex w-fit items-center justify-center gap-x-1.5 bg-[#97775B] px-8 text-white">
        Read More
        <svg width="13" height="13" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.4 13L0 11.6L9.6 2H1V0H13V12H11V3.4L1.4 13Z" fill="currentColor" />
        </svg>
    </a>
</div>

<div
    class="gap-y-3.75 md:gap-y-12.5 lg:gap-x-8.75 grid grid-cols-1 2xl:container md:mx-10 lg:grid-cols-3 lg:gap-y-0 2xl:mx-auto">
    <x-cards.bbi-wbbi-article-card :article="$article1" />
    <x-cards.bbi-wbbi-article-card :article="$article2" />
    <x-cards.bbi-wbbi-article-card :article="$article3" />
</div>
