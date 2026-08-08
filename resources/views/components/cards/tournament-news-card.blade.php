@props(['news' => null])

@php
    use Illuminate\Support\Str;
    $news = $news ?? null;
    $title = $news->title ?? 'PCI has made history by successfully hosting the tournament';
    $desc = !empty($news?->content) ? strip_tags($news->content) : ($news->description ?? 'Lorem ipsum dolor sit amet consectetur adpiscing elit.');

    if (!empty($news?->thumbnail)) {
        $img = Str::startsWith($news->thumbnail, ['http://', 'https://', 'images/']) ? asset($news->thumbnail) : asset('storage/' . $news->thumbnail);
    } elseif (!empty($news?->hero_image)) {
        $img = Str::startsWith($news->hero_image, ['http://', 'https://', 'images/']) ? asset($news->hero_image) : asset('storage/' . $news->hero_image);
    } else {
        $img = asset('images/dummy/latest-news-card/dummy-latest-news-card.webp');
    }

    $dateStr = isset($news?->published_at) ? strtoupper(\Carbon\Carbon::parse($news->published_at)->format('d M Y')) : '19 JAN 2026';
    $categoryName = $news?->category->name ?? ($news?->tags->first()->name ?? 'Tournament');
    $url = !empty($news?->slug) ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $news->slug]) : '#';
@endphp

<a href="{{ $url }}" class="h-61.75 md:h-85.25 group relative block overflow-hidden rounded-md">

    <img src="{{ $img }}" alt="{{ $title }}" width="1920"
        height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 via-black/20 to-black"></div>

    {{-- Content --}}
    <div class="relative flex h-full flex-col justify-end px-3 pb-3">
        <div class="mb-1.5 flex h-fit w-full items-center justify-between">
            <div class="w-58.75">
                <h1 class="line-clamp-2 text-lg font-semibold text-white transition-colors group-hover:text-gray-200">
                    {{ Str::words($title, 8, '...') }}
                </h1>
            </div>
            <div
                class="w-7.5 h-7.5 flex shrink-0 items-center justify-center rounded-full bg-white transition-transform duration-300 group-hover:-rotate-45">
                <x-fas-arrow-right class="h-3 w-3 text-black" />
            </div>
        </div>

        <p class="mb-5.5 line-clamp-3 text-[10px] leading-[129.4%] tracking-[-3%] text-white/90">
            {{ Str::words($desc, 20, '...') }}
        </p>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="h-4 w-4 text-white" />
                <span class="text-[13px] font-semibold text-white">
                    {{ $dateStr }}
                </span>
            </div>

            <div class="rounded-full bg-white/20 px-3.5 py-1 backdrop-blur-sm">
                <p class="text-[13px] font-semibold text-white">
                    {{ $categoryName }}
                </p>
            </div>
        </div>
    </div>
</a>

