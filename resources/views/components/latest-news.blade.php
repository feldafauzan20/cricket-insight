@php
    use App\Models\Article;
    use App\Models\Category;

    $newsCategoryId = Category::where('slug', 'news')->value('id');

    $fetchedNews = Article::with('category')
        ->where('category_id', $newsCategoryId)
        ->where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->limit(8)
        ->get();

    $displayNews = collect();
    if ($fetchedNews->isNotEmpty()) {
        while ($displayNews->count() < 8) {
            foreach ($fetchedNews as $news) {
                if ($displayNews->count() >= 8) {
                    break;
                }
                $displayNews->push($news);
            }
        }
    }
@endphp

<div class="md:px-7.5 md:pt-12.5 px-6 pb-4 pt-6 2xl:container md:pb-6 lg:px-10 xl:px-30 lg:pb-11 2xl:mx-auto 2xl:px-0 2xl:pb-6">
    <div class="items-center justify-between md:flex">
        <div>
            <h1 class="text-2xl font-semibold text-[#121212] md:text-[22px] dark:text-white">
                {{ __('home.latest_news_header') }}</h1>
            <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">{{ __('home.latest_news_subheader') }}
            </p>
        </div>
        <div class="hidden gap-x-1.5 md:flex">
            <x-buttons.previous-button class="latest-news-button-prev" />
            <x-buttons.next-button class="latest-news-button-next" />
        </div>
    </div>

    <div class="my-4 flex md:my-0 md:mb-8 md:mt-4">
        <div class="w-48.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7]"></div>
    </div>

    <div class="mb-4 flex gap-x-1 md:hidden">
        <x-buttons.previous-button class="latest-news-button-prev" />
        <x-buttons.next-button class="latest-news-button-next" />
    </div>

    <div class="swiper latest-news-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @if ($displayNews->isNotEmpty())
                @foreach ($displayNews as $news)
                    <div class="swiper-slide w-88.5!">
                        {{-- Mengirim data $news ke dalam komponen card --}}
                        <x-cards.latest-news-card :news="$news" />
                    </div>
                @endforeach
            @else
                <div class="w-full py-10 text-center">
                    <p class="font-medium text-gray-500">Belum ada berita terbaru.</p>
                </div>
            @endif
        </div>
    </div>
</div>
