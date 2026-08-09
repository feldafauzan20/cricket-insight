@props(['article'])

<a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}"
    class="h-61.75 md:h-85.25 relative block overflow-hidden rounded-md">
    <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/dummy/news-card/dummy-news-card.webp') }}"
        alt="{{ $article->title }}" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover">

    <!-- Overlay gradient -->
    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

    {{-- content --}}
    <div class="relative flex h-full flex-col justify-end px-3 pb-3">
        <div class="mb-1.5 flex h-fit w-full items-center justify-between">
            <div class="w-58.75">
                <h1 class="text-lg font-semibold text-white">
                    {{ Str::words($article->title, 8, '...') }}
                </h1>
            </div>
            <div class="w-7.5 h-7.5 flex shrink-0 items-center justify-center rounded-full bg-white">
                <x-fas-arrow-right class="h-3 w-3" />
            </div>
        </div>

        <p class="mb-5.5 text-[10px] leading-[129.4%] tracking-[-3%] text-white line-clamp-3">
            {{ Str::words($article->description ?? strip_tags($article->content ?? ''), 20, '...') }}
        </p>

        <div class="flex justify-between">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="h-4 w-4 text-white" />
                <span
                    class="text-[13px] font-semibold text-white">{{ strtoupper(optional($article->published_at)->format('d M Y') ?? 'N/A') }}</span>
            </div>
            <div class="rounded-full bg-white/20 px-3.5 py-1">
                <p class="text-[13px] font-semibold text-white">{{ $article->category?->name ?? 'News' }}</p>
            </div>
        </div>

    </div>
</a>
