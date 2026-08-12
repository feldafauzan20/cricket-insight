@props(['news'])

<a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $news->slug]) }}"
    class="not-first:pt-2 lg:not-first:pt-5 not-last:pb-2 lg:not-last:pb-5.5 flex gap-x-4 border-b border-b-[#C7C7C7] px-6 last:border-b-0 md:mx-1.5 md:px-0 lg:mx-5">
    <div class="w-29 h-18 lg:w-66.25 lg:h-41 2xl:w-29 2xl:h-18 shrink-0 overflow-hidden rounded-[3px]">
        <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('images/dummy/popular-recent-news/dummy-popular-recent-news.webp') }}"
            alt="{{ $news->title }}" class="h-full w-full object-cover" loading="lazy">
    </div>
    <div class="flex w-full flex-col justify-between">
        <div class="md:w-42 lg:mb-1 lg:mt-2.5 lg:w-full 2xl:mt-0">
            <h1
                class="line-clamp-2 text-[13px] font-semibold text-[#121212] md:line-clamp-3 2xl:line-clamp-2 dark:text-white">
                {{ $news->title }}
            </h1>
        </div>
        <div class="mt-2 flex h-full items-end gap-x-4 md:mt-0 lg:items-start">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
                <span class="text-[10px] font-semibold text-[#666]">
                    {{ strtoupper($news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y')) }}
                </span>
            </div>
            <div class="flex items-center gap-x-1.5">
                <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                <span class="text-[10px] font-semibold text-[#666] dark:text-[#989292]">{{ number_format($news->views_count ?? 0) }}</span>
            </div>
        </div>
    </div>
</a>
