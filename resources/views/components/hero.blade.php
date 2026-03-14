@php
    // Hero Carousel Slides Data
    $heroSlides = [
        [
            'id' => 1,
            'image' => 'images/dummy/hero-home/bg-hero-home.jpg',
            'category' => 'Matches',
            'title' => 'Garuda Gentlemen, triumphed over the Dispora India team',
            'description' =>
                "As cricket continues to grow across the archipelago, we're bringing you stories from the pitch, updates from local leagues, and progress from national development programs. Join us as we spotlight the players, coaches, and communities that are shaping the future of Indonesian cricket—one innings at a time. In this edition, we celebrate the Garuda Gentlemen's thrilling victory over the Dispora India team, a testament to the rising talent and passion for cricket in Indonesia.",
            'author_image' => 'images/dummy/hero-home/profile-picture-dummy.jpg',
            'author_name' => 'FARHAN DUDI',
            'date' => '19 JAN 2026',
            'thumbnail' => 'images/dummy/news-card/dummy-news-card.jpg',
            'thumbnail_title' => "The Indonesian men's national cricket team",
        ],
        [
            'id' => 2,
            'image' => 'images/dummy/hero-home/bg-hero-home.jpg',
            'category' => 'Business',
            'title' => 'ICC T20 WOMENS T20 WORLD CUP EAST ASIA QUALIFIERS EAST INDONESIA VS VIETNAM NEW GUINEA MATCHES',
            'description' =>
                'Indonesia women\'s cricket team showcases remarkable performance in the regional qualifiers, demonstrating the growing strength of women\'s cricket in Southeast Asia. With a blend of experienced players and emerging talent, the team has made significant strides in international competitions, inspiring a new generation of female cricketers across the country. As they continue to compete on the global stage, their journey reflects the dedication and passion driving the development of cricket in Indonesia.',
            'author_image' => 'images/dummy/hero-home/profile-picture-dummy.jpg',
            'author_name' => 'SARAH WILLIAMS',
            'date' => '18 JAN 2026',
            'thumbnail' => 'images/dummy/news-card/dummy-news-card.jpg',
            'thumbnail_title' => 'ICC T20 Womens T20 World Cup East',
        ],
        [
            'id' => 3,
            'image' => 'images/dummy/hero-home/bg-hero-home.jpg',
            'category' => 'Development',
            'title' => 'Local Cricket League Expands to Eastern Indonesia',
            'description' =>
                'The national cricket development program reaches new heights as local leagues expand across the archipelago, bringing opportunities to young cricketers in remote areas. With increased investment in grassroots initiatives and community engagement, the sport is flourishing in regions previously underserved. This expansion not only nurtures local talent but also strengthens the national team\'s pipeline, ensuring a bright future for Indonesian cricket on the international stage.',
            'author_image' => 'images/dummy/hero-home/profile-picture-dummy.jpg',
            'author_name' => 'AHMAD RIZKI',
            'date' => '17 JAN 2026',
            'thumbnail' => 'images/dummy/news-card/dummy-news-card.jpg',
            'thumbnail_title' => 'Local Cricket League Expands to Eastern',
        ],
    ];
@endphp

<section class="relative overflow-hidden">
    {{-- Swiper Container --}}
    <div class="hero-carousel-swiper swiper h-112.5 lg:h-162.5 relative z-10">
        <div class="swiper-wrapper">
            @foreach ($heroSlides as $slide)
                <div class="swiper-slide relative">
                    {{-- Background Image --}}
                    <img src="{{ asset($slide['image']) }}" alt="Hero Image {{ $slide['id'] }}" width="1920"
                        height="1080" fetchpriority="high" class="absolute inset-0 w-full h-full object-cover">

                    {{-- Overlay gradient --}}
                    <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black/50 w-full"></div>

                    {{-- Slide Content --}}
                    <div
                        class="relative mx-7.5 pt-18 md:pt-8 lg:pt-28 pb-8.5 md:pb-12 lg:pb-80 lg:mx-10 2xl:container 2xl:mx-auto h-full">

                        {{-- Category Badge --}}
                        <div class="mb-1 lg:mb-4">
                            <div class="bg-[#D6111A] w-fit py-1.5 px-5 rounded-[3px]">
                                <p class="text-white font-medium text-[11px]">{{ $slide['category'] }}</p>
                            </div>
                        </div>

                        {{-- Hero Title --}}
                        <div class="lg:w-153.5 mb-2.5 md:mb-3.5 lg:mb-4">
                            <h1 class="font-semibold text-white text-2xl md:text-4xl">
                                {{ Str::words($slide['title'], 8, '...') }}</h1>
                        </div>

                        {{-- Hero Description --}}
                        <div class="md:w-180 mb-2.5 md:mb-3.5 lg:mb-6 lg:w-153.5">
                            <p class="font-playfair-display text-xs md:text-[14px] font-medium text-white">
                                {{ Str::words($slide['description'], 47, '...') }}
                            </p>
                        </div>

                        {{-- Author Info --}}
                        <div class="text-white lg:flex lg:items-end">
                            <div class="w-57 lg:h-fit flex justify-between items-center">
                                <div class="w-9 h-9 rounded-full overflow-hidden">
                                    <img src="{{ asset($slide['author_image']) }}" alt="Profile Picture"
                                        class="w-full h-full object-cover">
                                </div>
                                <p class="font-semibold text-[10px]">BY {{ $slide['author_name'] }}</p>
                                <div class="w-2.5 h-2.5 bg-[#EC0226] rounded-full"></div>
                                <span class="font-semibold text-[10px]">{{ $slide['date'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Autoplay Progress Indicator --}}
    <div class="absolute top-18 right-7.5 md:top-8 md:right-7.5 lg:top-28 2xl:top-12 lg:right-10 2xl:right-10 z-20">
        <svg class="w-10 h-10 -rotate-90" viewBox="0 0 40 40">
            <!-- Background circle -->
            <circle cx="20" cy="20" r="18" stroke="#48494A" stroke-width="2" fill="none" />
            <!-- Progress circle -->
            <circle cx="20" cy="20" r="18" stroke="#EC0226" stroke-width="2" fill="none"
                stroke-dasharray="113.097" stroke-dashoffset="113.097"
                class="hero-carousel-progress-circle transition-all duration-100 ease-linear" />
        </svg>
    </div>

    {{-- Next and Previous Buttons (Mobile & Tablet) --}}
    <div class="absolute bottom-8.5 left-7.5 md:bottom-12 md:left-7.5 flex gap-x-4 lg:hidden z-20">
        <x-buttons.previous-button class="hero-carousel-button-prev" />
        <x-buttons.next-button class="hero-carousel-button-next" />
    </div>

    {{-- Next and Previous Buttons (Desktop) --}}
    <div
        class="hidden lg:flex lg:absolute lg:top-1/2 2xl:top-68.75 lg:-translate-y-1/2 lg:right-10 2xl:right-10 lg:flex-col lg:gap-y-2 z-20">
        <x-buttons.next-button class="hero-carousel-button-next" />
        <x-buttons.previous-button class="hero-carousel-button-prev" />
    </div>

    {{-- Indicator Dots (Large screens) --}}
    <div class="hidden lg:block lg:absolute lg:bottom-50 lg:left-0 lg:right-0 z-20">
        <div class="lg:mx-10 2xl:container 2xl:mx-auto">
            <div class="lg:flex lg:gap-x-2 hero-carousel-pagination"></div>
        </div>
    </div>

    {{-- News Cards as Navigation (Large screens) --}}
    <div class="hidden lg:block lg:absolute lg:bottom-0 lg:left-0 lg:right-0 z-20 lg:pb-7.5 2xl:pb-10.5">
        <div class="lg:mx-10 2xl:container 2xl:mx-auto lg:flex lg:gap-x-7.5 2xl:gap-x-10">
            @foreach ($heroSlides as $index => $slide)
                <div class="flex-1 cursor-pointer hero-news-card" data-slide-index="{{ $index }}">
                    <div
                        class="border-t {{ $index === 0 ? 'border-t-[#EC0226]' : 'border-t-white' }} transition-colors duration-300">
                        <div class="flex pt-7 gap-x-7">
                            <div class="w-25 h-17.5 rounded-xs overflow-hidden">
                                <img src="{{ asset($slide['thumbnail']) }}" alt="News Card Image"
                                    class="w-full h-full object-cover">
                            </div>

                            <div>
                                <div class="2xl:w-40">
                                    <h1 class="font-semibold text-xs text-white mb-1.5">
                                        {{ Str::words($slide['thumbnail_title'], 4, '...') }}
                                    </h1>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
                                    <span class="font-semibold text-[10px] text-white">{{ $slide['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
