@php
    // Dummy data for featured videos
    $featuredVideos = [
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Matches',
            'title' => 'Garuda Gentlemen, triumphed over the Dispora India team',
            'author' => 'FARHAN DUDI',
            'date' => '19 JAN 2026',
            'views' => '1.2K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Tournament',
            'title' => 'Indonesia Cricket League Season 2 kicks off with spectacular opening',
            'author' => 'SARAH JOHNSON',
            'date' => '18 JAN 2026',
            'views' => '2.5K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Player Focus',
            'title' => 'Rising star makes debut with century against Malaysia',
            'author' => 'DAVID CHEN',
            'date' => '17 JAN 2026',
            'views' => '3.1K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Analysis',
            'title' => 'Breaking down the winning strategy from last weekend match',
            'author' => 'MIKE ANDERSON',
            'date' => '16 JAN 2026',
            'views' => '1.8K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Highlights',
            'title' => 'Top 10 catches of the month that left everyone stunned',
            'author' => 'EMMA WILSON',
            'date' => '15 JAN 2026',
            'views' => '4.2K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Interview',
            'title' => 'Exclusive conversation with national team captain about future plans',
            'author' => 'JOHN SMITH',
            'date' => '14 JAN 2026',
            'views' => '2.9K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'Training',
            'title' => 'Behind the scenes at Jakarta Cricket Academy intensive program',
            'author' => 'LISA BROWN',
            'date' => '13 JAN 2026',
            'views' => '1.5K',
        ],
        [
            'image' => 'images/dummy/commentaries/dummy-commentaries-small-card.webp',
            'category' => 'News',
            'title' => 'New cricket stadium construction begins in Bali this month',
            'author' => 'ALEX KUMAR',
            'date' => '12 JAN 2026',
            'views' => '2.1K',
        ],
    ];
@endphp

<div class="2xl:flex">
    {{-- Header Section --}}
    <div class="2xl:w-107.25 2xl:h-131.25 relative w-full 2xl:flex 2xl:shrink-0 2xl:items-center 2xl:justify-center">
        {{-- Background image with img tag --}}
        {{-- <img src="{{ asset('images/dummy/featured-video/dummy-bg-featured-video.webp') }}" alt="Featured Video Background"
            class="absolute z-20 h-full w-full object-cover opacity-10" loading="lazy" /> --}}
        <img src="https://placehold.co/800x600" alt="Featured Video Background"
            class="absolute z-20 h-full w-full object-cover opacity-10" loading="lazy" />

        {{-- Blue Background --}}
        <div class="absolute inset-0 z-10 bg-[#1F1D5E]"></div>

        {{-- content --}}
        <div class="py-17.5 relative z-30 px-10 2xl:px-0 2xl:py-0">
            <div class="mb-2.5 h-0.5 w-10 bg-white md:mb-5"></div>
            <h1 class="mb-1 text-[20px] font-semibold text-white">Featured Video</h1>
            <p class="mb-12.5 text-[11px] leading-[217%] text-white">Don’t Miss And Stay Up-to-date. Top pic for you.
            </p>
            <div class="flex items-center gap-x-9">
                <div class="h-px w-full bg-white/20"></div>
                <div class="flex items-center gap-x-1">
                    <x-buttons.previous-button class="featured-video-button-prev" />
                    <x-buttons.next-button class="featured-video-button-next" />
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Section --}}
    <div class="swiper featured-video-swiper w-full overflow-hidden 2xl:w-auto">
        <div class="swiper-wrapper">
            @foreach ($featuredVideos as $video)
                <div class="swiper-slide 2xl:w-107.25! w-full 2xl:shrink-0">
                    <div class="h-131.25 relative">
                        {{-- Background image with img tag --}}
                        {{-- <img src="{{ asset($video['image']) }}" alt="{{ $video['title'] }}"
                            class="absolute h-full w-full object-cover" loading="lazy" /> --}}
                        <img src="https://placehold.co/1200x800" alt="{{ $video['title'] }}"
                            class="absolute h-full w-full object-cover" loading="lazy" />

                        {{-- Overlay Background --}}
                        <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

                        {{-- content --}}
                        <div class="px-7.5 relative flex h-full flex-col justify-between py-10">
                            <div class="flex items-center gap-x-2.5 text-white">
                                <div class="h-9 w-9 overflow-hidden rounded-full">
                                    {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                        alt="Profile Picture" class="h-full w-full object-cover" loading="lazy"> --}}
                                    <img src="https://placehold.co/36x36" alt="Profile Picture"
                                        class="h-full w-full object-cover" loading="lazy">
                                </div>
                                <p class="text-[10px] font-semibold md:text-sm">BY {{ $video['author'] }}</p>
                            </div>
                            <div>
                                <div class="mb-1 w-fit rounded-[3px] bg-[#D6111A] px-5 py-1.5">
                                    <span class="text-xs font-medium text-white">{{ $video['category'] }}</span>
                                </div>
                                <h1 class="mb-1 text-[19px] font-semibold text-white">
                                    {{ Str::words($video['title'], 8, '...') }}
                                </h1>
                                <div class="flex items-center gap-x-4">
                                    <div class="flex items-center gap-x-2">
                                        <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
                                        <span class="text-[10px] font-semibold text-white">{{ $video['date'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-x-1.5">
                                        <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                                        <span class="text-[10px] font-semibold text-white">{{ $video['views'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
