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
    <div class="relative w-full 2xl:w-107.25 2xl:h-131.25 2xl:shrink-0 2xl:flex 2xl:items-center 2xl:justify-center ">
        {{-- Background image with img tag --}}
        <img src="{{ asset('images/dummy/featured-video/dummy-bg-featured-video.webp') }}" alt="Featured Video Background"
            class="absolute w-full h-full object-cover opacity-10 z-20" />

        {{-- Blue Background --}}
        <div class="absolute inset-0 bg-[#1F1D5E] z-10"></div>

        {{-- content --}}
        <div class="relative px-10 py-17.5 2xl:px-0 2xl:py-0 z-30">
            <div class="bg-white w-10 h-0.5 mb-2.5 md:mb-5"></div>
            <h1 class="text-white font-semibold text-[20px] mb-1">Featured Video</h1>
            <p class="text-white leading-[217%] text-[11px] mb-12.5">Don’t Miss And Stay Up-to-date. Top pic for you.</p>
            <div class="flex items-center gap-x-9">
                <div class="bg-white/20 w-full h-px"></div>
                <div class="flex items-center gap-x-1">
                    <x-buttons.previous-button class="featured-video-button-prev" />
                    <x-buttons.next-button class="featured-video-button-next" />
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Section --}}
    <div class="swiper featured-video-swiper w-full 2xl:w-auto overflow-hidden">
        <div class="swiper-wrapper">
            @foreach ($featuredVideos as $video)
                <div class="swiper-slide w-full 2xl:w-107.25! 2xl:shrink-0">
                    <div class="relative h-131.25">
                        {{-- Background image with img tag --}}
                        <img src="{{ asset($video['image']) }}" alt="{{ $video['title'] }}"
                            class="absolute w-full h-full object-cover" />

                        {{-- Overlay Background --}}
                        <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black w-full"></div>

                        {{-- content --}}
                        <div class="relative px-7.5 py-10 flex flex-col justify-between h-full">
                            <div class="flex items-center text-white gap-x-2.5">
                                <div class="w-9 h-9 rounded-full overflow-hidden">
                                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                        alt="Profile Picture" class="w-full h-full object-cover">
                                </div>
                                <p class="font-semibold text-[10px] md:text-sm">BY {{ $video['author'] }}</p>
                            </div>
                            <div>
                                <div class="bg-[#D6111A] w-fit py-1.5 px-5 rounded-[3px] mb-1">
                                    <span class="text-white font-medium text-xs">{{ $video['category'] }}</span>
                                </div>
                                <h1 class="text-[19px] font-semibold text-white mb-1">
                                    {{ Str::words($video['title'], 8, '...') }}
                                </h1>
                                <div class="flex items-center gap-x-4">
                                    <div class="flex items-center gap-x-2">
                                        <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
                                        <span class="font-semibold text-[10px] text-white">{{ $video['date'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-x-1.5">
                                        <x-bi-eye class="w-2.5 h-2.5 text-[#EC0226]" />
                                        <span class="font-semibold text-[10px] text-white">{{ $video['views'] }}</span>
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
