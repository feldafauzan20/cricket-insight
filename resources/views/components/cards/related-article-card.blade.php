<div class="h-61.75 md:h-85.25 relative overflow-hidden rounded-md">
    {{-- <img src="{{ asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}" alt="Hero Image" width="1920"
        height="1080" loading="lazy" class="absolute inset-0 w-full h-full object-cover"> --}}
    <img src="https://placehold.co/800x600" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover">

    <!-- Overlay gradient -->
    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

    {{-- content --}}
    <div class="relative flex h-full flex-col justify-end px-3 pb-3">
        <div class="mb-1.5 flex h-fit w-full items-center justify-between">
            <div class="w-58.75">
                <h1 class="text-lg font-semibold text-white">
                    {{ Str::words('PCI has made history by successfully hosting the inaugural cricket tournament in the region', 8, '...') }}
                </h1>
            </div>
            <div class="w-7.5 h-7.5 flex shrink-0 items-center justify-center rounded-full bg-white">
                <x-fas-arrow-right class="h-3 w-3" />
            </div>
        </div>

        <p class="mb-5.5 text-[10px] leading-[129.4%] tracking-[-3%] text-white">Lorem ipsum dolor sit amet consectetur
            adpiscing elit.
            Consectetur adipiscing
            elit quisque
            faucibus ex sapien
            vitae.</p>

        <div class="flex justify-between">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="h-4 w-4 text-white" />
                <span class="text-[13px] font-semibold text-white">19 JAN 2026</span>
            </div>
            <div class="rounded-full bg-white/20 px-3.5 py-1">
                <p class="text-[13px] font-semibold text-white">Matches | <span>Feb 06, 2025</span></p>
            </div>
        </div>

    </div>
</div>
