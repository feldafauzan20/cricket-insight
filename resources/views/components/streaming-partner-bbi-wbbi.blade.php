@php
    $streamingPartners = [
        [
            'src' => asset('images/logo/streaming-partner-logo/facebook-live-logo.svg'),
            'alt' => 'Facebook Live',
            'size' => 'h-20 w-32 md:h-28 md:w-44',
        ],
        [
            'src' => asset('images/logo/streaming-partner-logo/youtube-logo.svg'),
            'dark_src' => asset('images/logo/streaming-partner-logo/youtube-logo-white.svg'),
            'alt' => 'YouTube',
            'size' => 'h-16 w-28 md:h-20 md:w-36',
        ],
        [
            'src' => asset('images/logo/streaming-partner-logo/fancode-logo.svg'),
            'alt' => 'Fancode',
            'size' => 'h-14 w-24 md:h-18 md:w-32',
        ],
        [
            'src' => asset('images/logo/streaming-partner-logo/icc-tv-logo.svg'),
            'alt' => 'ICC TV',
            'size' => 'h-24 w-24 md:h-30 md:w-30',
        ],
        [
            'src' => asset('images/logo/streaming-partner-logo/img-arena-logo.svg'),
            'alt' => 'Arena',
            'size' => 'h-20 w-32 md:h-24 md:w-40',
        ],
        [
            'src' => asset('images/logo/streaming-partner-logo/styx-sport-logo.svg'),
            'alt' => 'Styx Sport',
            'size' => 'h-16 w-28 md:h-20 md:w-36',
        ],
    ];
@endphp

{{-- STREAMING PARTNERS START --}}
<div class="mt-12.5 md:mt-25 relative w-full overflow-hidden">

    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-light.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:hidden dark:opacity-5">
    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-dark.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:block dark:opacity-5">

    <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6">
        @foreach ($streamingPartners as $partner)
            <div
                class="py-12.5 px-12.5 md:py-12.5 md:px-16.5 2xl:py-23.25 2xl:px-13.25 h-35 flex items-center justify-center border border-[#B6B6B6] 2xl:h-60">
                @if (isset($partner['dark_src']))
                    <img src="{{ $partner['src'] }}" alt="{{ $partner['alt'] }}"
                        class="{{ $partner['size'] }} block object-contain dark:hidden" loading="lazy">
                    <img src="{{ $partner['dark_src'] }}" alt="{{ $partner['alt'] }}"
                        class="{{ $partner['size'] }} hidden object-contain dark:block" loading="lazy">
                @else
                    <img src="{{ $partner['src'] }}" alt="{{ $partner['alt'] }}"
                        class="{{ $partner['size'] }} object-contain" loading="lazy">
                @endif
            </div>
        @endforeach
    </div>
</div>
{{-- STREAMING PARTNERS END --}}
