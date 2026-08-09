@props([
    'news' => null,
    'indonesiaNews' => null,
    'internationalNews' => null,
])

@php
    use App\Models\Article;
    use Illuminate\Support\Str;

    $news = $news ?? collect();
    $indonesiaNews = $indonesiaNews ?? collect();
    $internationalNews = $internationalNews ?? collect();

    $tournamentCategoryFilter = function ($query) {
        $query->whereHas('category', function ($q) {
            $q->where('slug', 'tournament')
              ->orWhere('slug', 'tournaments')
              ->orWhere('name', 'like', '%tournament%')
              ->orWhere('name', 'like', '%turnamen%')
              ->orWhere('categories.id', 3);
        });
    };

    if (empty($news) || (is_countable($news) && count($news) === 0)) {
        $news = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where($tournamentCategoryFilter)
            ->orderByDesc('published_at')
            ->take(10)
            ->get();
    }

    if (empty($indonesiaNews) || (is_countable($indonesiaNews) && count($indonesiaNews) === 0)) {
        $indonesiaNews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where('region', 'Indonesia')
            ->where($tournamentCategoryFilter)
            ->orderByDesc('published_at')
            ->take(9)
            ->get();
    }

    if (empty($internationalNews) || (is_countable($internationalNews) && count($internationalNews) === 0)) {
        $internationalNews = Article::query()
            ->with(['category', 'tags', 'uploader'])
            ->where('status', 'published')
            ->where(function ($q) {
                $q->where('region', '!=', 'Indonesia')
                  ->orWhereNull('region');
            })
            ->where($tournamentCategoryFilter)
            ->orderByDesc('published_at')
            ->take(9)
            ->get();
    }
@endphp

<div class="md:px-7.5 md:pt-12.5 px-6 pb-4 pt-6 2xl:container md:pb-6 lg:px-10 lg:pb-11 xl:px-30 2xl:mx-auto 2xl:px-0 2xl:pb-6">
    <div class="items-center justify-between md:flex">
        <div>
            <h1 class="text-2xl font-semibold text-[#121212] md:text-[22px] dark:text-white">Tournament News</h1>
            <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">Don't miss daily news</p>
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
            @if(count($news) > 0)
                @foreach ($news as $item)
                    <div class="swiper-slide w-88.5!">
                        <x-cards.tournament-news-card :news="$item" />
                    </div>
                @endforeach
            @else
                @for ($i = 0; $i < 6; $i++)
                    <div class="swiper-slide w-88.5!">
                        <x-cards.tournament-news-card />
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>

<div
    class="md:px-7.5 md:pt-12.5 px-6 pb-4 pt-6 2xl:container lg:px-10 xl:px-30 2xl:mx-auto 2xl:flex 2xl:gap-x-5 2xl:px-0 2xl:pb-6">
    <div class="2xl:w-1/2 2xl:min-w-0">
        <div class="mb-3.75 md:flex md:items-center md:gap-x-5">
            <h1 class="whitespace-nowrap text-[22px] font-semibold text-[#121212] dark:text-white">Indonesia Tournament
                News
            </h1>

            <div class="hidden md:flex md:flex-1 md:items-center">
                <div class="w-48.5 h-px bg-[#EC0226]"></div>
                <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
            </div>
        </div>

        <div class="gap-y-3.75 flex flex-col">
            @if(count($indonesiaNews) > 0)
                @foreach ($indonesiaNews as $item)
                    @php
                        $tagName = $item->tags->first()->name ?? ($item->category->name ?? 'Tournament');
                        $dateStr = isset($item->published_at) ? \Carbon\Carbon::parse($item->published_at)->format('F d, Y') : 'March 24, 2026';
                        if (!empty($item?->thumbnail)) {
                            $img = Str::startsWith($item->thumbnail, ['http://', 'https://', 'images/']) ? asset($item->thumbnail) : asset('storage/' . $item->thumbnail);
                        } elseif (!empty($item?->hero_image)) {
                            $img = Str::startsWith($item->hero_image, ['http://', 'https://', 'images/']) ? asset($item->hero_image) : asset('storage/' . $item->hero_image);
                        } else {
                            $img = asset('images/dummy/news-card/dummy-news-card.webp');
                        }
                        $url = !empty($item?->slug) ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $item->slug]) : '#';
                    @endphp
                    <a href="{{ $url }}"
                        class="group rounded-b-[5px] border-b border-[#EFEFEF] md:flex md:border dark:border-none dark:bg-[#1F1F1F]">
                        <div class="sm:w-69.25 2xl:w-158 2xl:h-49 md:w-50 h-32 overflow-hidden rounded-[5px] md:h-auto">
                            <img src="{{ $img }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item->title }}">
                        </div>
                        <div
                            class="md:pl-4.5 lg:w-110.25 border-x border-[#F3F3F3] p-4 md:border-0 md:p-0 md:py-7 2xl:w-full dark:border-none">
                            <div class="flex items-center gap-x-2.5">
                                <p class="text-xs font-semibold text-[#EC0226]">{{ $tagName }}</p>
                                <p class="text-[#A2A6A9]">|</p>
                                <p class="text-xs font-semibold text-[#A2A6A9]">{{ $dateStr }}</p>
                            </div>
                            <div class="2xl:w-130 md:w-96">
                                <h1 class="text-lg font-semibold text-[#121212] group-hover:text-[#EC0226] transition-colors dark:text-white">
                                    {{ Str::words($item->title, 8, '...') }}
                                </h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                @for ($i = 0; $i < 4; $i++)
                    <div
                        class="rounded-b-[5px] border-b border-[#EFEFEF] md:flex md:border dark:border-none dark:bg-[#1F1F1F]">
                        <div class="sm:w-69.25 2xl:w-158 2xl:h-49 md:w-50 h-32 overflow-hidden rounded-[5px] md:h-auto">
                            <img src="{{ asset('images/dummy/news-card/dummy-news-card.webp') }}"
                                class="h-full w-full object-cover" alt="sasa">
                        </div>
                        <div
                            class="md:pl-4.5 lg:w-110.25 border-x border-[#F3F3F3] p-4 md:border-0 md:p-0 md:py-7 2xl:w-full dark:border-none">
                            <div class="flex items-center gap-x-2.5">
                                <p class="text-xs font-semibold text-[#EC0226]">Tournament Tag </p>
                                <p class="text-[#A2A6A9]">|</p>
                                <p class="text-xs font-semibold text-[#A2A6A9]">March 24, 2026</p>
                            </div>
                            <div class="2xl:w-130 md:w-96">
                                <h1 class="text-lg font-semibold text-[#121212] dark:text-white">
                                    {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}
                                </h1>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>

    <div class="2xl:w-1/2 2xl:min-w-0">
        <div class="mb-3.75 mt-7.5 md:flex md:items-center md:gap-x-5 2xl:mt-0">
            <h1 class="text-[22px] font-semibold text-[#121212] md:whitespace-nowrap dark:text-white">International
                Tournament News
            </h1>

            <div class="hidden md:flex md:flex-1 md:items-center">
                <div class="w-48.5 h-px bg-[#007DFC]"></div>
                <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
            </div>
        </div>

        <div class="gap-y-3.75 flex flex-col">
            @if(count($internationalNews) > 0)
                @foreach ($internationalNews as $item)
                    @php
                        $tagName = $item->tags->first()->name ?? ($item->category->name ?? 'Tournament');
                        $dateStr = isset($item->published_at) ? \Carbon\Carbon::parse($item->published_at)->format('F d, Y') : 'March 24, 2026';
                        if (!empty($item?->thumbnail)) {
                            $img = Str::startsWith($item->thumbnail, ['http://', 'https://', 'images/']) ? asset($item->thumbnail) : asset('storage/' . $item->thumbnail);
                        } elseif (!empty($item?->hero_image)) {
                            $img = Str::startsWith($item->hero_image, ['http://', 'https://', 'images/']) ? asset($item->hero_image) : asset('storage/' . $item->hero_image);
                        } else {
                            $img = asset('images/dummy/news-card/dummy-news-card.webp');
                        }
                        $url = !empty($item?->slug) ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $item->slug]) : '#';
                    @endphp
                    <a href="{{ $url }}"
                        class="group rounded-b-[5px] border-b border-[#EFEFEF] md:flex md:border dark:border-none dark:bg-[#1F1F1F]">
                        <div class="sm:w-69.25 2xl:w-158 2xl:h-49 md:w-50 h-32 overflow-hidden rounded-[5px] md:h-auto">
                            <img src="{{ $img }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item->title }}">
                        </div>
                        <div
                            class="md:pl-4.5 lg:w-110.25 border-x border-[#F3F3F3] p-4 md:border-0 md:p-0 md:py-7 2xl:w-full dark:border-none">
                            <div class="flex items-center gap-x-2.5">
                                <p class="text-xs font-semibold text-[#EC0226]">{{ $tagName }}</p>
                                <p class="text-[#A2A6A9]">|</p>
                                <p class="text-xs font-semibold text-[#A2A6A9]">{{ $dateStr }}</p>
                            </div>
                            <div class="2xl:w-130 md:w-96">
                                <h1 class="text-lg font-semibold text-[#121212] group-hover:text-[#EC0226] transition-colors dark:text-white">
                                    {{ Str::words($item->title, 8, '...') }}
                                </h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                @for ($i = 0; $i < 4; $i++)
                    <div
                        class="rounded-b-[5px] border-b border-[#EFEFEF] md:flex md:border dark:border-none dark:bg-[#1F1F1F]">
                        <div class="sm:w-69.25 2xl:w-158 2xl:h-49 md:w-50 h-32 overflow-hidden rounded-[5px] md:h-auto">
                            <img src="{{ asset('images/dummy/news-card/dummy-news-card.webp') }}"
                                class="h-full w-full object-cover" alt="sasa">
                        </div>
                        <div
                            class="md:pl-4.5 lg:w-110.25 border-x border-[#F3F3F3] p-4 md:border-0 md:p-0 md:py-7 2xl:w-full dark:border-none">
                            <div class="flex items-center gap-x-2.5">
                                <p class="text-xs font-semibold text-[#EC0226]">Tournament Tag </p>
                                <p class="text-[#A2A6A9]">|</p>
                                <p class="text-xs font-semibold text-[#A2A6A9]">March 24, 2026</p>
                            </div>
                            <div class="2xl:w-130 md:w-96">
                                <h1 class="text-lg font-semibold text-[#121212] dark:text-white">
                                    {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}
                                </h1>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>

