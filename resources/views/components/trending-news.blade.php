@php
    use App\Models\Article;

    $fetchedTrending = Article::with(['category', 'uploader'])
        ->where('is_trending_manual', true)
        ->where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->limit(3)
        ->get();

    $displayTrending = collect();
    if ($fetchedTrending->isNotEmpty()) {
        while ($displayTrending->count() < 3) {
            foreach ($fetchedTrending as $news) {
                if ($displayTrending->count() >= 3) break;
                $displayTrending->push($news);
            }
        }
    }
@endphp

<div>
    <h1 class="font-semibold text-[24px] md:text-[22px] text-[#121212] dark:text-[#EEEEEE] 2xl:hidden">
        Trending
    </h1>
    <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2] mb-4 2xl:hidden">
        Don't miss daily news
    </p>

    <div class="2xl:hidden flex my-4 md:my-0 md:mt-4 md:mb-8">
        <div class="w-48.5 md:w-88.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    @if($displayTrending->count() == 3)
        {{-- Trending cards container --}}
        <div class="2xl:flex 2xl:gap-x-2.5">
            
            {{-- Trending 1 - Big card (Kiri) --}}
            <div class="mb-2.5 2xl:mb-0 2xl:w-1/2">
                <x-cards.trending-card 
                    :news="$displayTrending[0]" 
                    trendingNumber="1" 
                    height="h-100.25 md:h-[435px] lg:h-[691px] 2xl:h-[593px]"
                    fontSize="text-[32px]" />
            </div>

            {{-- Trending 2 & 3 - Small cards stacked (Kanan) --}}
            <div class="flex flex-col md:flex-row 2xl:flex-col gap-y-2.5 md:gap-y-0 md:gap-x-2.5 2xl:gap-y-2.5 2xl:gap-x-0 2xl:w-1/2">
                
                {{-- Trending 2 (Kanan Atas) --}}
                <x-cards.trending-card 
                    :news="$displayTrending[1]" 
                    trendingNumber="2" 
                    height="h-[300px] 2xl:h-[290px]"
                    fontSize="text-[18px]" />
                
                {{-- Trending 3 (Kanan Bawah) --}}
                <x-cards.trending-card 
                    :news="$displayTrending[2]" 
                    trendingNumber="3" 
                    height="h-[300px] 2xl:h-[290px]"
                    fontSize="text-[18px]" />

            </div>
        </div>
    @else
        <div class="w-full py-10 text-center">
            <p class="text-gray-500 font-medium">Belum ada berita trending saat ini.</p>
        </div>
    @endif
</div>