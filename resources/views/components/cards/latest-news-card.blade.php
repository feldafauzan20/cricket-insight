@props(['news'])

<a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $news->slug]) }}"
    class="h-61.75 md:h-85.25 group relative block overflow-hidden rounded-md">

    <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}"
        alt="{{ $news->title }}" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 via-black/20 to-black"></div>

    {{-- Content --}}
    <div class="relative flex h-full flex-col justify-end px-3 pb-3">
        <div class="mb-1.5 flex h-fit w-full items-center justify-between">
            <div class="w-58.75">
                <h1 class="line-clamp-2 text-lg font-semibold text-white transition-colors group-hover:text-gray-200">
                    {{ \Illuminate\Support\Str::words($news->title, 8, '...') }}
                </h1>
            </div>
            <div
                class="w-7.5 h-7.5 flex shrink-0 items-center justify-center rounded-full bg-white transition-transform duration-300 group-hover:-rotate-45">
                <x-fas-arrow-right class="h-3 w-3 text-black" />
            </div>
        </div>

        <p class="mb-5.5 line-clamp-3 text-[10px] leading-[129.4%] tracking-[-3%] text-white/90">
            {{ \Illuminate\Support\Str::words(strip_tags($news->description ?? $news->content), 20, '...') }}
        </p>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="h-4 w-4 text-white" />
                <span class="text-[13px] font-semibold text-white">
                    {{ strtoupper($news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y')) }}
                </span>
            </div>

            <div class="rounded-full bg-white/20 px-3.5 py-1 backdrop-blur-sm">
                <p class="text-[13px] font-semibold text-white">
                    {{ $news->category ? $news->category->name : __('cards.default_category') }}
                </p>
            </div>
        </div>
    </div>
</a>
