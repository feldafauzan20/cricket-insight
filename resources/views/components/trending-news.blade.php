@php
    use App\Models\Article;
    use App\Models\PageSlot;

    $slotTrending = PageSlot::with(['article.category', 'article.uploader'])
        ->where('page_key', 'homepage')
        ->whereIn('section_key', ['trending_1', 'trending_2', 'trending_3'])
        ->whereNotNull('article_id')
        ->get()
        ->keyBy('section_key');

    $displayTrending = collect([
        $slotTrending->get('trending_1')?->article,
        $slotTrending->get('trending_2')?->article,
        $slotTrending->get('trending_3')?->article,
    ])->filter(fn ($art) => $art && $art->status === 'published')->values();

    if ($displayTrending->count() < 3) {
        $fallbacks = Article::with(['category', 'uploader'])
            ->where('status', 'published')
            ->whereNotIn('id', $displayTrending->pluck('id')->filter())
            ->orderBy('published_at', 'desc')
            ->limit(3 - $displayTrending->count())
            ->get();
        $displayTrending = $displayTrending->concat($fallbacks);
    }
@endphp

<div>
    <h1 class="text-[24px] font-semibold text-[#121212] md:text-[22px] 2xl:hidden dark:text-[#EEEEEE]">
        {{ __('home.trending_header') }}
    </h1>
    <p class="mb-4 text-[13px] font-semibold text-[#666] 2xl:hidden dark:text-[#B2B2B2]">
        {{ __('home.trending_sub_header') }}
    </p>

    <div class="my-4 flex md:my-0 md:mb-8 md:mt-4 2xl:hidden">
        <div class="w-48.5 md:w-88.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    @if ($displayTrending->count() >= 3)
        {{-- Trending cards container --}}
        <div class="2xl:flex 2xl:gap-x-2.5">

            {{-- Trending 1 - Big card (Kiri) --}}
            <div class="mb-2.5 2xl:mb-0 2xl:w-1/2">
                <x-cards.trending-card :news="$displayTrending[0]" trendingNumber="1"
                    height="h-100.25 md:h-[435px] lg:h-[691px] 2xl:h-[593px]" fontSize="text-[32px]" />
            </div>

            {{-- Trending 2 & 3 - Small cards stacked (Kanan) --}}
            <div
                class="flex flex-col gap-y-2.5 md:flex-row md:gap-x-2.5 md:gap-y-0 2xl:w-1/2 2xl:flex-col 2xl:gap-x-0 2xl:gap-y-2.5">

                {{-- Trending 2 (Kanan Atas) --}}
                <x-cards.trending-card :news="$displayTrending[1]" trendingNumber="2" height="h-[300px] md:h-[500px] 2xl:h-[290px]"
                    fontSize="text-[18px]" />

                {{-- Trending 3 (Kanan Bawah) --}}
                <x-cards.trending-card :news="$displayTrending[2]" trendingNumber="3" height="h-[300px] md:h-[500px] 2xl:h-[290px]"
                    fontSize="text-[18px]" />

            </div>
        </div>
    @else
        <div class="w-full py-10 text-center">
            <p class="font-medium text-gray-500"> {{ __('home.empty_trending_news') }} </p>
        </div>
    @endif
</div>
