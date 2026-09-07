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

        <div class="swiper streaming-partner-swiper overflow-hidden">
            <div class="swiper-wrapper items-center">
                @foreach ($streamingPartners as $partner)
                    @php
                        $lightSrc = is_object($partner)
                            ? $partner->image_url
                            : (is_array($partner)
                                ? asset($partner['src'] ?? ($partner['image'] ?? ''))
                                : asset($partner));
                        $darkSrc = is_object($partner) ? $partner->image_dark_url : '';
                        $altText = is_object($partner)
                            ? $partner->title
                            : $partner['alt'] ?? ($partner['title'] ?? 'dummy streaming partner');
                    @endphp
                    <div class="swiper-slide flex! items-center justify-center">
                        <img src="{{ $lightSrc }}" alt="{{ $altText }}"
                            class="w-25 md:w-35 {{ $darkSrc ? 'dark:hidden' : '' }} h-auto object-contain"
                            loading="lazy">
                        @if ($darkSrc)
                            <img src="{{ $darkSrc }}" alt="{{ $altText }}"
                                class="w-25 md:w-35 hidden h-auto object-contain dark:block" loading="lazy">
                        @endif
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
