@props(['article' => null])

@php
    $title = $article?->title ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing.';
    $image = $article?->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://placehold.co/291x213?text=Dummy';
    $description = $article?->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.';
    $url = $article?->slug ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) : '#';
@endphp

<div class="rounded-[30px] bg-white dark:bg-[#1E1F1F]">
    <div class="px-4.5 md:px-8.75 border-b border-[#B6B6B6] py-5">
        <h1
            class="font-barlow-semi-condensed lg:py-8.75 mb-3.5 text-center text-xl font-bold tracking-[0.09em] text-[#434343] lg:mb-0 dark:text-white">
            {{ Str::words($title, 10, '...') }}</h1>
        <div class="lg:mb-9.75 mb-3.5 overflow-hidden rounded-[20px] w-72.75 md:w-full lg:h-41 h-53.25 md:h-133.5 xl:h-62.5">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover">
        </div>
        <p
            class="font-figtree md:w-132 text-center font-medium leading-[135%] tracking-[-0.05em] text-[#969696] md:mx-auto md:block lg:w-full">
            {{ Str::words($description, 16, '...') }}</p>
    </div>
    <a class="py-6.5 flex items-center justify-center gap-x-4 text-[#434343] dark:text-[#E3E3E3]" href="{{ $url }}">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="curentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.175 9L6.575 14.6L8 16L16 8L8 0L6.575 1.4L12.175 7H0V9H12.175Z" fill="currentColor" />
        </svg>
        <p class="font-figtree font-semibold leading-[135%] tracking-[-0.05em] text-[#B90F16] dark:text-white">MORE
            DETAILS</p>
    </a>
</div>
