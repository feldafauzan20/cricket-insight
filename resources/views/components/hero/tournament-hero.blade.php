@props(['articles' => []])

@php
    use Illuminate\Support\Str;
@endphp

<div class="relative overflow-hidden bg-[#19214F]">
    {{-- Swiper Container --}}
    <div class="swiper lg:h-162.5 h-119 md:h-122.5 bg-linear-to-b relative z-10 from-[#19214F]/0 to-[#EC0226]/50">
        <div class="swiper-wrapper 2xl:container 2xl:mx-auto">
            @if(count($articles) > 0)
                @foreach($articles as $article)
                    @php
                        $imagePath = $article->hero_image_url ?? $article->thumbnail_url ?? asset('images/dummy/hero-home/bg-hero-home.webp');
                    @endphp
                    <div class="swiper-slide relative">

                        {{-- Background Image --}}
                        <img src="{{ $imagePath }}" alt="{{ $article->title }}" width="1920"
                            height="1080" loading="eager" fetchpriority="high"
                            class="absolute inset-0 h-full w-full object-cover">

                        {{-- Overlay gradient --}}
                        <div class="bg-linear-to-b absolute inset-0 w-full from-[#19214F]/0 to-[#EC0226]/50"></div>

                        {{-- Content --}}
                        <div class="relative mx-6 flex h-full flex-col items-center justify-end lg:mx-10">

                            {{-- Hero Title --}}
                            <div class="lg:w-153.5 mb-3.75 md:mb-3.75 2xl:w-229.5 lg:mb-4">
                                <h1
                                    class="text-center text-2xl font-semibold leading-[119.2%] text-white md:text-4xl 2xl:text-5xl">
                                    {{ Str::words($article->title, 12, '...') }}
                                </h1>
                            </div>

                            {{-- Hero Description --}}
                            <div class="md:w-144.25 mb-3.75 md:mb-3.75 lg:mb-6">
                                <p class="text-center text-xs text-white">
                                    {{ Str::words(strip_tags($article->content ?? $article->description ?? ''), 35, '...') }}
                                </p>
                            </div>

                            @php
                                $articleUrl = !empty($article?->slug) ? route('news.show', ['locale' => app()->getLocale(), 'slug' => $article->slug]) : '#';
                            @endphp
                            {{-- CTA BUTTON --}}
                            <div class="mb-7.5 2xl:mb-15 rounded-[3px] bg-[#EC0226] px-6 py-2 md:mb-10">
                                <a href="{{ $articleUrl }}" class="font-medium uppercase text-white">See More</a>
                            </div>

                            {{-- DOT INDICATOR --}}
                            <div class="mb-2.75 absolute bottom-0 left-1/2 flex -translate-x-1/2 gap-x-4 md:mb-3.5 lg:mb-4">
                                @foreach($articles as $index => $dotItem)
                                    <div class="h-1.5 w-1.5 rounded-full {{ $loop->first ? 'bg-white' : 'bg-white/50' }}"></div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="swiper-slide relative">

                    {{-- Background Image --}}
                    <img src="{{ asset('images/dummy/hero-home/bg-hero-home.webp') }}" alt="Hero Image" width="1920"
                        height="1080" loading="eager" fetchpriority="high"
                        class="absolute inset-0 h-full w-full object-cover">

                    {{-- Overlay gradient --}}
                    <div class="bg-linear-to-b absolute inset-0 w-full from-[#19214F]/0 to-[#EC0226]/50"></div>

                    {{-- Content --}}
                    <div class="relative mx-6 flex h-full flex-col items-center justify-end lg:mx-10">

                        {{-- Hero Title --}}
                        <div class="lg:w-153.5 mb-3.75 md:mb-3.75 2xl:w-229.5 lg:mb-4">
                            <h1
                                class="text-center text-2xl font-semibold leading-[119.2%] text-white md:text-4xl 2xl:text-5xl">
                                Garuda Gentlemen, triumphed over the Dispora India team
                            </h1>
                        </div>

                        {{-- Hero Description --}}
                        <div class="md:w-144.25 mb-3.75 md:mb-3.75 lg:mb-6">
                            <p class="text-center text-xs text-white">
                                Discover the most exciting cricket tournaments happening around the world.
                            </p>
                        </div>

                        {{-- CTA BUTTON --}}
                        <div class="mb-7.5 2xl:mb-15 rounded-[3px] bg-[#EC0226] px-6 py-2 md:mb-10">
                            <a href="#" class="font-medium uppercase text-white">See More</a>
                        </div>

                        {{-- DOT INDICATOR --}}
                        <div class="mb-2.75 absolute bottom-0 left-1/2 flex -translate-x-1/2 gap-x-4 md:mb-3.5 lg:mb-4">
                            <div class="h-1.5 w-1.5 rounded-full bg-white"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-white"></div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Autoplay Progress Indicator --}}
    {{-- <div class="top-18 right-7.5 md:right-7.5 absolute z-20 md:top-8 lg:right-10 lg:top-28 2xl:right-10 2xl:top-12">
        <svg class="h-10 w-10 -rotate-90" viewBox="0 0 40 40">
            <!-- Background circle -->
            <circle cx="20" cy="20" r="18" stroke="#48494A" stroke-width="2" fill="none" />
            <!-- Progress circle -->
            <circle cx="20" cy="20" r="18" stroke="#EC0226" stroke-width="2" fill="none"
                stroke-dasharray="113.097" stroke-dashoffset="113.097"
                class="hero-carousel-progress-circle transition-all duration-100 ease-linear" />
        </svg>
    </div> --}}

    {{-- Next and Previous Buttons (Mobile & Tablet) --}}
    {{-- <div class="bottom-8.5 left-7.5 md:left-7.5 absolute z-20 flex gap-x-4 md:bottom-12 lg:hidden">
        <x-buttons.previous-button class="hero-carousel-button-prev" />
        <x-buttons.next-button class="hero-carousel-button-next" />
    </div> --}}

    {{-- Next and Previous Buttons (Desktop) --}}
    {{-- <div
        class="2xl:top-68.75 z-20 hidden lg:absolute lg:right-10 lg:top-1/2 lg:flex lg:-translate-y-1/2 lg:flex-col lg:gap-y-2 2xl:right-10">
        <x-buttons.next-button class="hero-carousel-button-next" />
        <x-buttons.previous-button class="hero-carousel-button-prev" />
    </div> --}}

    {{-- Indicator Dots (Large screens) --}}
    {{-- <div class="lg:bottom-50 z-20 hidden lg:absolute lg:left-0 lg:right-0 lg:block">
        <div class="2xl:container lg:mx-10 2xl:mx-auto">
            <div class="hero-carousel-pagination lg:flex lg:gap-x-2"></div>
        </div>
    </div> --}}

    {{-- News Cards as Navigation (Large screens) --}}
    {{-- <div class="lg:pb-7.5 2xl:pb-10.5 z-20 hidden lg:absolute lg:bottom-0 lg:left-0 lg:right-0 lg:block">
        <div class="lg:gap-x-7.5 2xl:container lg:mx-10 lg:flex 2xl:mx-auto 2xl:gap-x-10">
            @foreach ($heroSlides as $index => $slide)
                <div class="hero-news-card flex-1 cursor-pointer" data-slide-index="{{ $index }}">
                    <div
                        class="{{ $index === 0 ? 'border-t-[#EC0226]' : 'border-t-white' }} border-t transition-colors duration-300">
                        <div class="flex gap-x-7 pt-7">
                            <div class="w-25 h-17.5 rounded-xs overflow-hidden">
                                <img src="{{ asset($slide['thumbnail']) }}" alt="News Card Image"
                                    class="h-full w-full object-cover" fetchpriority="high" loading="eager">
                                <img src="https://placehold.co/400x280" alt="News Card Image"
                                    class="h-full w-full object-cover" fetchpriority="high" loading="eager">
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
    </div> --}}
</div>
