<div class="pt-12.5 md:pt-15" x-init="$store.darkMode.init()">
    <div class="pt-12.5 md:pt-15" x-init="$store.darkMode.init()">
        <h1
            class="mb-2.5 text-center text-2xl font-semibold leading-[130%] text-[#121212] md:text-[32px] dark:text-[#EEEEEE]">
            {{ __('home.streaming_partner_header') }}</h1>
        <div class="mb-7.5 lg:w-168.25 mx-auto md:mb-8">
            <p class="text-center text-xs leading-[130%] text-[#121212] md:text-sm dark:text-[#B2B2B2]">
                {{ __('home.streaming_partner_sub_header') }}
            </p>
        </div>

        {{-- <div class="swiper live-score-swiper overflow-hidden">
            <div class="swiper-wrapper">
                @foreach ($matches as $match)
                    <div class="swiper-slide w-76!">
                        <x-cards.live-score-card :match="$match" />
                    </div>
                @endforeach
            </div>
        </div> --}}
        <div class="swiper streaming-partner-swiper overflow-hidden">
            <div class="swiper-wrapper items-center">
                <!-- Logo 1 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img src="{{ asset('images/logo/streaming-partner-logo/facebook-live-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
                <!-- Logo 2 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img src="{{ asset('images/logo/streaming-partner-logo/fancode-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
                <!-- Logo 3 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img src="{{ asset('images/logo/streaming-partner-logo/icc-tv-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
                <!-- Logo 4 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img src="{{ asset('images/logo/streaming-partner-logo/img-arena-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
                <!-- Logo 5 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img src="{{ asset('images/logo/streaming-partner-logo/styx-sport-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
                <!-- Logo 6 -->
                <div class="swiper-slide flex! items-center justify-center">
                    <img x-show="!$store.darkMode.on"
                        src="{{ asset('images/logo/streaming-partner-logo/youtube-logo.svg') }}"
                        alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                    <img x-show="$store.darkMode.on" x-cloak
                        src="{{ asset('images/logo/streaming-partner-logo/youtube-logo-white.svg') }}"
                        alt="cricket insight logo" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
                </div>
            </div>
        </div>

    </div>
