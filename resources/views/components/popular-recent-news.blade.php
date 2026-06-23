@php
    use App\Models\Article;

    // --- LOGIKA POPULAR NEWS (Sementara tanpa 'views') ---
    $fetchedPopular = Article::with(['category', 'uploader'])
        ->where('status', 'published')
        ->inRandomOrder() // Diacak sementara sebagai pengganti views
        ->limit(4)
        ->get();

    $displayPopular = collect();
    if ($fetchedPopular->isNotEmpty()) {
        while ($displayPopular->count() < 4) {
            foreach ($fetchedPopular as $news) {
                if ($displayPopular->count() >= 4) break;
                $displayPopular->push($news);
            }
        }
    }

    // --- LOGIKA RECENT NEWS (Berdasarkan Tanggal Terbaru) ---
    $fetchedRecent = Article::with(['category', 'uploader'])
        ->where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->limit(4)
        ->get();

    $displayRecent = collect();
    if ($fetchedRecent->isNotEmpty()) {
        while ($displayRecent->count() < 4) {
            foreach ($fetchedRecent as $news) {
                if ($displayRecent->count() >= 4) break;
                $displayRecent->push($news);
            }
        }
    }
@endphp

<div x-data="{ activeNewsTab: 'popular' }" class="flex flex-col h-full">
    {{-- Popular and recent news button --}}
    <div class="flex justify-center rounded-t-[3px] overflow-hidden">
        <a href="#" @click.prevent="activeNewsTab = 'popular'"
            class="block w-1/2 text-center font-semibold text-[10px] py-2.5 2xl:py-4 text-white"
            :class="activeNewsTab === 'popular' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            POPULAR NEWS
        </a>
        <a href="#" @click.prevent="activeNewsTab = 'recent'" 
            class="block w-1/2 text-center font-semibold text-[10px] py-2.5 2xl:py-4 text-white"
            :class="activeNewsTab === 'recent' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            RECENT NEWS
        </a>
    </div>

    {{-- News content --}}
    <div class="bg-[#F9F9F9] dark:bg-[#1F1F1F] py-3.5 lg:py-6 rounded-b-[3px] flex flex-col 2xl:gap-y-5 border border-[#C7C7C7] dark:border-[#373737] flex-1">
        
        {{-- TAB: POPULAR NEWS --}}
        <div x-show="activeNewsTab === 'popular'" class="flex flex-col 2xl:gap-y-5">
            @if($displayPopular->count() == 4)
                @foreach ($displayPopular as $news)
                    <x-cards.popular-and-recent-news-card :news="$news" />
                @endforeach
            @else
                <p class="text-center text-xs text-gray-500 py-4">Belum ada berita populer.</p>
            @endif
        </div>

        {{-- TAB: RECENT NEWS --}}
        <div x-show="activeNewsTab === 'recent'" style="display: none;" class="flex flex-col 2xl:gap-y-5">
            @if($displayRecent->count() == 4)
                @foreach ($displayRecent as $news)
                    <x-cards.popular-and-recent-news-card :news="$news" />
                @endforeach
            @else
                <p class="text-center text-xs text-gray-500 py-4">Belum ada berita terbaru.</p>
            @endif
        </div>

    </div>
</div>