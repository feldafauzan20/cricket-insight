@props(['news', 'trendingNumber' => '1', 'height' => 'h-auto', 'fontSize' => 'text-[32px]'])

@php
    use Illuminate\Support\Str;

    $image = $news->thumbnail
        ? asset('storage/' . $news->thumbnail)
        : asset('images/dummy/trending-card/dummy-trending-card-' . $trendingNumber . '.webp');
    $title = $news->title;
    $author = $news->uploader ? $news->uploader->name : 'Admin';
    $date = strtoupper($news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y'));

    $wordCount = str_word_count(strip_tags($news->content ?? ''));
    $timeRead = max(1, ceil($wordCount / 200));
@endphp

<a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $news->slug]) }}"
    class="{{ $height }} group relative block w-full overflow-hidden rounded-[3px] p-4">

    <!-- Background Image -->
    <img src="{{ $image }}" alt="{{ $title }}" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

    <!-- Overlay gradient -->
    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

    {{-- Content --}}
    <div class="relative flex h-full flex-col justify-between">

        <!-- Label Trending Number -->
        <div class="w-fit rounded-full border-2 border-white/20 bg-white/20 px-3.5 py-1 backdrop-blur-sm">
            <span class="text-[13px] font-semibold text-white">#{{ $trendingNumber }} Trending</span>
        </div>

        <div>
            <!-- Time Read Otomatis -->
            <p class="mb-2 text-[10px] font-medium leading-[129.4%] tracking-[-3%] text-[#A2A6A9]">
                {{ $timeRead }} Min read
            </p>

            <!-- Judul -->
            <div class="md:w-3/5 md:max-w-sm">
                <h1
                    class="font-playfair-display {{ $fontSize }} mb-2 font-bold text-white transition-colors group-hover:text-gray-200">
                    {{ Str::words($title, 8, '...') }}
                </h1>
            </div>

            <!-- Author & Date -->
            <div class="w-57 mt-4 flex items-center justify-between lg:h-fit">
                <div class="flex items-center gap-x-2.5 text-white">
                    <div class="h-9 w-9 shrink-0 overflow-hidden rounded-full border border-white/30">
                        <img src="{{ $news->uploader?->avatar_url ?? asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="{{ $author }}" class="h-full w-full object-cover">
                    </div>
                    <p class="line-clamp-1 text-[10px] font-semibold"><span class="font-normal">By
                        </span>{{ $author }}</p>
                </div>

                <div class="flex shrink-0 items-center gap-x-2 text-[#A2A6A9]">
                    <x-letsicon-time-atack class="h-4 w-4" />
                    <span class="text-[10px] font-semibold">{{ $date }}</span>
                </div>
            </div>

        </div>
    </div>
</a>
