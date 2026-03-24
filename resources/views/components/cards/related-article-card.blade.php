<div class="relative h-61.75 md:h-85.25 rounded-md overflow-hidden">
    <img src="{{ asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}" alt="Hero Image" width="1920"
        height="1080" loading="lazy" class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black w-full"></div>

    {{-- content --}}
    <div class="relative h-full px-3 pb-3 flex flex-col justify-end">
        <div class="h-fit w-full flex justify-between items-center mb-1.5">
            <div class="w-58.75">
                <h1 class="font-semibold text-lg text-white">
                    {{ Str::words('PCI has made history by successfully hosting the inaugural cricket tournament in the region', 8, '...') }}
                </h1>
            </div>
            <div class="w-7.5 h-7.5 shrink-0 bg-white rounded-full flex items-center justify-center">
                <x-fas-arrow-right class="w-3 h-3" />
            </div>
        </div>

        <p class="text-white text-[10px] leading-[129.4%] tracking-[-3%] mb-5.5">Lorem ipsum dolor sit amet consectetur
            adpiscing elit.
            Consectetur adipiscing
            elit quisque
            faucibus ex sapien
            vitae.</p>

        <div class="flex justify-between">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="w-4 h-4 text-white" />
                <span class="font-semibold text-[13px] text-white">19 JAN 2026</span>
            </div>
            <div class="bg-white/20 py-1 px-3.5 rounded-full">
                <p class="text-[13px] font-semibold text-white">Matches | <span>Feb 06, 2025</span></p>
            </div>
        </div>

    </div>
</div>
