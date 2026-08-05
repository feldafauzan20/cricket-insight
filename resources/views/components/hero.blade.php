@php
    use App\Models\PageSlot;
    use Illuminate\Support\Str;

    $slots = PageSlot::with(['article.category', 'article.uploader', 'video'])
        ->where('page_key', 'homepage')
        ->whereIn('section_key', ['hero_carousel_1', 'hero_carousel_2', 'hero_carousel_3'])
        ->orderBy('section_key', 'asc')
        ->get();

    $heroSlides = $slots
        ->map(function ($slot, $index) {
            $article = $slot->article;
            $video = $slot->video;

            if (!$article && !$video) {
                return null;
            }

            if ($article) {
                return [
                    'id' => $index + 1,
                    'image' => $article->thumbnail
                        ? asset('storage/' . $article->thumbnail)
                        : asset('images/dummy/hero-home/bg-hero-home.webp'),
                    'category' => $article->category ? $article->category->name : 'Uncategorized',
                    'title' => $article->title,
                    'description' => strip_tags($article->description ?? $article->content),
                    'author_image' => asset('images/dummy/hero-home/profile-picture-dummy.webp'),
                    'author_name' => strtoupper($article->uploader->name ?? 'SUPER ADMIN'),
                    'date' => strtoupper(
                        $article->published_at
                            ? $article->published_at->format('d M Y')
                            : $article->created_at->format('d M Y'),
                    ),
                    'thumbnail' => $article->thumbnail
                        ? asset('storage/' . $article->thumbnail)
                        : asset('images/dummy/news-card/dummy-news-card.webp'),
                    'thumbnail_title' => $article->title,
                ];
            }

            if ($video) {
                return [
                    'id' => $index + 1,
                    'image' => $video->thumbnail
                        ? asset('storage/' . $video->thumbnail)
                        : asset('images/dummy/hero-home/bg-hero-home.webp'),
                    'category' => 'Video',
                    'title' => $video->title,
                    'description' => strip_tags($video->description ?? ''),
                    'author_image' => asset('images/dummy/hero-home/profile-picture-dummy.webp'),
                    'author_name' => strtoupper($video->uploader->name ?? 'SUPER ADMIN'),
                    'date' => strtoupper($video->created_at->format('d M Y')),
                    'thumbnail' => $video->thumbnail
                        ? asset('storage/' . $video->thumbnail)
                        : asset('images/dummy/news-card/dummy-news-card.webp'),
                    'thumbnail_title' => $video->title,
                ];
            }
        })
        ->filter()
        ->values();
@endphp

<section class="relative overflow-hidden">
    {{-- Swiper Container --}}
    <div class="hero-carousel-swiper swiper h-112.5 lg:h-162.5 relative z-10">
        <div class="swiper-wrapper">
            @foreach ($heroSlides as $slide)
                <div class="swiper-slide relative">
                    {{-- Background Image --}}
                    <img src="{{ asset($slide['image']) }}" alt="Hero Image {{ $slide['id'] }}" width="1920"
                        height="1080" loading="eager" fetchpriority="high"
                        class="absolute inset-0 h-full w-full object-cover">
                    {{-- <img src="https://placehold.co/1920x1080" alt="Hero Image {{ $slide['id'] }}" width="1920"
                        height="1080" loading="eager" fetchpriority="high"
                        class="absolute inset-0 h-full w-full object-cover"> --}}

                    {{-- Overlay gradient --}}
                    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black/50"></div>

                    {{-- Slide Content --}}
                    <div
                        class="mx-7.5 pt-18 pb-8.5 relative h-full 2xl:container md:pb-12 md:pt-8 lg:mx-10 lg:pb-80 lg:pt-28 2xl:mx-auto">

                        {{-- Category Badge --}}
                        <div class="mb-1 lg:mb-4">
                            <div class="w-fit rounded-[3px] bg-[#D6111A] px-5 py-1.5">
                                <p class="text-[11px] font-medium text-white">{{ $slide['category'] }}</p>
                            </div>
                        </div>

                        {{-- Hero Title --}}
                        <div class="lg:w-153.5 mb-2.5 md:mb-3.5 lg:mb-4">
                            <h1 class="text-2xl font-semibold text-white md:text-4xl">
                                {{ Str::words($slide['title'], 8, '...') }}</h1>
                        </div>

                        {{-- Hero Description --}}
                        <div class="md:w-180 lg:w-153.5 mb-2.5 md:mb-3.5 lg:mb-6">
                            <p
                                class="font-playfair-display line-clamp-2 wrap-break-word text-xs font-medium text-white md:line-clamp-3 md:text-[14px]">
                                {{ $slide['description'] }}
                            </p>

                        </div>

                        {{-- Author Info --}}
                        <div class="text-white lg:flex lg:items-end">
                            <div class="w-57 flex items-center justify-between lg:h-fit">
                                <div class="h-9 w-9 overflow-hidden rounded-full">
                                    <img src="{{ asset($slide['author_image']) }}" alt="Profile Picture"
                                        class="h-full w-full object-cover">
                                    {{-- <img src="https://placehold.co/36x36" alt="Profile Picture"
                                        class="h-full w-full object-cover"> --}}
                                </div>
                                <p class="text-[10px] font-semibold">BY {{ $slide['author_name'] }}</p>
                                <div class="h-2.5 w-2.5 rounded-full bg-[#EC0226]"></div>
                                <span class="text-[10px] font-semibold">{{ $slide['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Autoplay Progress Indicator --}}
    <div class="top-18 right-7.5 md:right-7.5 absolute z-20 md:top-8 lg:right-10 lg:top-28 2xl:right-10 2xl:top-12">
        <svg class="h-10 w-10 -rotate-90" viewBox="0 0 40 40">
            <!-- Background circle -->
            <circle cx="20" cy="20" r="18" stroke="#48494A" stroke-width="2" fill="none" />
            <!-- Progress circle -->
            <circle cx="20" cy="20" r="18" stroke="#EC0226" stroke-width="2" fill="none"
                stroke-dasharray="113.097" stroke-dashoffset="113.097"
                class="hero-carousel-progress-circle transition-all duration-100 ease-linear" />
        </svg>
    </div>

    {{-- Next and Previous Buttons (Mobile & Tablet) --}}
    <div class="bottom-8.5 left-7.5 md:left-7.5 absolute z-20 flex gap-x-4 md:bottom-12 lg:hidden">
        <x-buttons.previous-button class="hero-carousel-button-prev" />
        <x-buttons.next-button class="hero-carousel-button-next" />
    </div>

    {{-- Next and Previous Buttons (Desktop) --}}
    <div
        class="2xl:top-68.75 z-20 hidden lg:absolute lg:right-10 lg:top-1/2 lg:flex lg:-translate-y-1/2 lg:flex-col lg:gap-y-2 2xl:right-10">
        <x-buttons.next-button class="hero-carousel-button-next" />
        <x-buttons.previous-button class="hero-carousel-button-prev" />
    </div>

    {{-- Indicator Dots (Large screens) --}}
    <div class="lg:bottom-50 z-20 hidden lg:absolute lg:left-0 lg:right-0 lg:block">
        <div class="2xl:container lg:mx-10 2xl:mx-auto">
            <div class="hero-carousel-pagination lg:flex lg:gap-x-2"></div>
        </div>
    </div>

    {{-- News Cards as Navigation (Large screens) --}}
    <div class="lg:pb-7.5 2xl:pb-10.5 z-20 hidden lg:absolute lg:bottom-0 lg:left-0 lg:right-0 lg:block">
        <div class="lg:gap-x-7.5 2xl:container lg:mx-10 lg:flex 2xl:mx-auto 2xl:gap-x-10">
            @foreach ($heroSlides as $index => $slide)
                <div class="hero-news-card flex-1 cursor-pointer" data-slide-index="{{ $index }}">
                    <div
                        class="{{ $index === 0 ? 'border-t-[#EC0226]' : 'border-t-white' }} border-t transition-colors duration-300">
                        <div class="flex gap-x-7 pt-7">
                            <div class="w-25 h-17.5 rounded-xs overflow-hidden">
                                <img src="{{ asset($slide['thumbnail']) }}" alt="News Card Image"
                                    class="h-full w-full object-cover" fetchpriority="high" loading="eager">
                                {{-- <img src="https://placehold.co/400x280" alt="News Card Image"
                                    class="h-full w-full object-cover" fetchpriority="high" loading="eager"> --}}
                            </div>

                            <div>
                                <div class="2xl:w-40">
                                    <h1 class="mb-1.5 text-xs font-semibold text-white">
                                        {{ Str::words($slide['thumbnail_title'], 4, '...') }}
                                    </h1>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
                                    <span class="text-[10px] font-semibold text-white">{{ $slide['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
