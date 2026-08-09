@php
    use App\Models\Article;
    use App\Models\PageSlot;

    // --- LOGIKA POPULAR / TRENDING NEWS ---
    $slotArticles = PageSlot::with(['article.category', 'article.uploader'])
        ->where('page_key', 'homepage')
        ->where('section_key', 'like', 'trending_side_%')
        ->whereNotNull('article_id')
        ->orderBy('section_key')
        ->get()
        ->pluck('article')
        ->filter(fn ($art) => $art && $art->status === 'published');

    if ($slotArticles->isNotEmpty()) {
        $fetchedPopular = $slotArticles;
    } else {
        $fetchedPopular = Article::with(['category', 'uploader'])
            ->where('status', 'published')
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    $displayPopular = collect();
    if ($fetchedPopular->isNotEmpty()) {
        while ($displayPopular->count() < 4) {
            foreach ($fetchedPopular as $news) {
                if ($displayPopular->count() >= 4) {
                    break;
                }
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
                if ($displayRecent->count() >= 4) {
                    break;
                }
                $displayRecent->push($news);
            }
        }
    }
@endphp

<div x-data="{ activeNewsTab: 'popular' }" class="flex h-full flex-col">
    {{-- Popular and recent news button --}}
    <div class="flex justify-center overflow-hidden rounded-t-[3px]">
        <a href="#" @click.prevent="activeNewsTab = 'popular'"
            class="block w-1/2 py-2.5 text-center text-[10px] font-semibold text-white 2xl:py-4"
            :class="activeNewsTab === 'popular' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            {{ __('home.popular_news_header') }}
        </a>
        <a href="#" @click.prevent="activeNewsTab = 'recent'"
            class="block w-1/2 py-2.5 text-center text-[10px] font-semibold text-white 2xl:py-4"
            :class="activeNewsTab === 'recent' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            {{ __('home.recent_news_header') }}
        </a>
    </div>

    {{-- News content --}}
    <div
        class="flex flex-1 flex-col rounded-b-[3px] border border-[#C7C7C7] bg-[#F9F9F9] py-3.5 lg:py-6 2xl:gap-y-5 dark:border-[#373737] dark:bg-[#1F1F1F]">

        {{-- TAB: POPULAR NEWS --}}
        <div x-show="activeNewsTab === 'popular'" class="flex flex-col 2xl:gap-y-5">
            @if ($displayPopular->count() == 4)
                @foreach ($displayPopular as $news)
                    <x-cards.popular-and-recent-news-card :news="$news" />
                @endforeach
            @else
                <p class="py-4 text-center text-xs text-gray-500">Belum ada berita populer.</p>
            @endif
        </div>

        {{-- TAB: RECENT NEWS --}}
        <div x-show="activeNewsTab === 'recent'" style="display: none;" class="flex flex-col 2xl:gap-y-5">
            @if ($displayRecent->count() == 4)
                @foreach ($displayRecent as $news)
                    <x-cards.popular-and-recent-news-card :news="$news" />
                @endforeach
            @else
                <p class="py-4 text-center text-xs text-gray-500">Belum ada berita terbaru.</p>
            @endif
        </div>

    </div>
</div>
