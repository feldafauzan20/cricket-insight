<div class="pt-12.5 md:pt-15" x-init="$store.darkMode.init()">
    <h1
        class="leading-[130%] text-center text-2xl md:text-[32px] font-semibold mb-2.5 text-[#121212] dark:text-[#EEEEEE]">
        Our streaming
        partner</h1>
    <div class="mb-7.5 md:mb-8 lg:w-168.25 mx-auto">
        <p class="text-xs md:text-sm text-center leading-[130%] text-[#121212] dark:text-[#B2B2B2]">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat.
        </p>
    </div>
    <div class="grid grid-cols-2 gap-2 md:grid-cols-3 2xl:grid-cols-6">
        <!-- Logo 1 -->
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/logo/streaming-partner-logo/facebook-live-logo.svg') }}"
                alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain"
                loading="lazy"> --}}
        </div>
        <!-- Logo 2 -->
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/logo/streaming-partner-logo/fancode-logo.svg') }}" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy"> --}}
        </div>
        <!-- Logo 3 -->
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/logo/streaming-partner-logo/icc-tv-logo.svg') }}" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy"> --}}
        </div>
        <!-- Logo 4 -->
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/logo/streaming-partner-logo/img-arena-logo.svg') }}"
                alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy"> --}}
        </div>
        <!-- Logo 5 -->
        <div class="flex items-center justify-center">
            <img src="{{ asset('images/logo/streaming-partner-logo/styx-sport-logo.svg') }}"
                alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy"> --}}
        </div>
        <!-- Logo 6 -->
        <div class="flex items-center justify-center">
            <img x-show="!$store.darkMode.on" src="{{ asset('images/logo/streaming-partner-logo/youtube-logo.svg') }}"
                alt="dummy streaming partner" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            <img x-show="$store.darkMode.on" x-cloak
                src="{{ asset('images/logo/streaming-partner-logo/youtube-logo-white.svg') }}"
                alt="cricket insight logo" class="w-25 md:w-35 h-auto object-contain" loading="lazy">
            {{-- <img src="https://placehold.co/140x56" alt="dummy streaming partner"
                class="w-25 md:w-35 h-auto object-contain" loading="lazy"> --}}
        </div>
    </div>
</div>
