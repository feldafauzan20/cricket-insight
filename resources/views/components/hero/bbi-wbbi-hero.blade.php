@php
    use App\Models\BbiWbbiSetting;
    use App\Models\PageSlot;
    use App\Models\Article;
    use Illuminate\Support\Str;

    $setting = BbiWbbiSetting::with(['article1', 'article2', 'article3'])->first();

    $dynamicArticles = collect([
        $setting?->article1,
        $setting?->article2,
        $setting?->article3,
    ])->filter(fn ($art) => $art && $art->status === 'published')->values();

    if ($dynamicArticles->isEmpty()) {
        $slotRecords = PageSlot::with(['article'])
            ->where('page_key', 'bbi_wbbi')
            ->whereIn('section_key', ['bbi_wbbi_hero_1', 'bbi_wbbi_hero_2', 'bbi_wbbi_hero_3'])
            ->orderBy('section_key', 'asc')
            ->get();
        $dynamicArticles = $slotRecords->map(fn ($s) => $s->article)->filter(fn ($art) => $art && $art->status === 'published')->values();
    }

    if ($dynamicArticles->isEmpty()) {
        $dynamicArticles = Article::where('status', 'published')->latest()->take(3)->get();
    }

    $dynamicSlides = [];
    foreach ($dynamicArticles as $index => $article) {
        $dynamicSlides[] = [
            'id' => $index + 1,
            'heading' => Str::limit($article->title, 50),
            'poster' => $article->thumbnail
                ? asset('storage/' . $article->thumbnail)
                : asset('images/dummy/hero-home/bg-hero-home.webp'),
            'video' => ['type' => 'youtube', 'id' => 'dQw4w9WgXcQ'],
            'more_details_url' => route('news.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]),
        ];
    }

    $slides = !empty($dynamicSlides) ? $dynamicSlides : [
        [
            'id' => 1,
            'heading' => "Dedicated Team Exceptional\nUnique Cricket Playstyle",
            'poster' => asset('images/dummy/hero-home/bg-hero-home.webp'),
            'video' => ['type' => 'youtube', 'id' => 'dQw4w9WgXcQ'],
            'more_details_url' => '#',
        ],
    ];
@endphp

<section class="h-206 md:h-245.25 relative w-full overflow-hidden" x-data="heroCarousel(@js($slides))">

    {{-- MEDIA LAYER — di-loop, crossfade per slide --}}
    <template x-for="(slide, index) in slides" :key="slide.id">
        <div x-show="active === index" x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="absolute inset-0 h-full w-full">
            {{-- Poster --}}
            <img :src="slide.poster" :alt="slide.heading" class="absolute inset-0 h-full w-full object-cover">
        </div>
    </template>

    {{-- Overlay --}}
    <div class="absolute inset-0 h-full w-full bg-black/70"></div>

    {{-- CONTENT LAYER — gak di-loop, reaktif ke slide aktif --}}
    <div
        class="2xl:mt-75.25 relative z-10 flex h-full flex-col items-center justify-center px-6 text-center 2xl:container lg:mx-10 2xl:mx-auto 2xl:justify-start">

        {{-- Heading (Max 50 Chars) --}}
        <h1 x-text="slides[active].heading"
            class="font-barlow-semi-condensed md:w-142.5 2xl:w-205 md:mb-14.25 mb-10 text-[25px] font-bold uppercase tracking-[-0.05em] text-white md:block md:text-[70px]">
        </h1>

        {{-- More details --}}
        <a :href="slides[active].more_details_url"
            class="font-figtree py-4.5 inline-flex items-center gap-1.5 bg-[#97775B] px-8 font-semibold text-white">
            More details
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7v8" />
            </svg>
        </a>
    </div>

    {{-- Arrows — md+ --}}
    <button @click="prev()" type="button" aria-label="Previous slide"
        class="absolute left-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20 md:left-8 md:flex">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="next()" type="button" aria-label="Next slide"
        class="absolute right-4 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20 md:right-8 md:flex">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    {{-- Dots — absolute, gak ganggu layout --}}
    <div class="mb-51.75 md:mb-19 absolute bottom-0 left-1/2 z-20 flex -translate-x-1/2 gap-2">
        <template x-for="(slide, index) in slides" :key="'dot-' + slide.id">
            <button @click="goTo(index)" type="button" :aria-label="'Go to slide ' + (index + 1)"
                class="flex h-4 w-4 items-center justify-center rounded-full">
                <span class="rounded-full transition-all"
                    :class="active === index ? 'h-3.75 w-3.75 border-2 border-white bg-[#080907]' : 'h-3.75 w-3.75 bg-white/30'"></span>
            </button>
        </template>
    </div>
</section>
