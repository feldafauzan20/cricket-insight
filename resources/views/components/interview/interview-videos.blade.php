<div>
    <x-interview.interview-header header="Interview Videos"
        description="Watch the most insightful interviews with cricket players and experts." />
    <div class="md:mb-7.5 mb-5 2xl:container lg:flex lg:flex-row-reverse lg:items-stretch 2xl:mx-auto">
        <div class="h-63.5 lg:w-150 2xl:w-11/20 overflow-hidden rounded-t-[3px] lg:h-auto">
            <img src="{{ asset('images/dummy/editor-choices/dummy-bg-hero-editor-choices.webp') }}"
                alt=" Editor's Choices Hero Image" class="h-full w-full object-cover">
        </div>
        <div class="2xl:w-9/20 relative overflow-hidden rounded-b-[3px] 2xl:flex 2xl:flex-col 2xl:justify-center">
            {{-- Background Image --}}
            <img src="{{ asset('images/dummy/dummy-editor-choices.webp') }}" alt="Editor's Choices Background"
                class="absolute inset-0 z-20 h-full w-full object-cover opacity-40">

            {{-- Gradient Overlay --}}
            <div
                class="bg-linear-to-br from-1% absolute inset-0 z-10 from-[#EC0226] via-[#6A469C] via-30% to-[#007DFC] to-90%">
            </div>

            {{-- Content --}}
            <div class="md:mx-7.5 lg:py-13.5 lg:px-13.5 relative z-30 mx-6 py-5 md:py-6 lg:mx-0">
                <div class="mb-2 w-fit rounded-full border-2 border-[#D6111A]/20 bg-[#D6111A]/20 px-3.5 py-1">
                    <p class="text-[13px] font-semibold text-white">PRESS CONFERENCE</p>
                </div>
                <h1 class="mb-2 text-[24px] font-semibold text-white md:text-[35px]">
                    {{ Str::words('PCI has made history by successfully hosting the inaugural cricket tournament in the region', 8, '...') }}
                </h1>
                <p class="mb-5.25 text-[12px] leading-[129.4%] tracking-[-3%] text-white md:text-[14px]">
                    {{ Str::words('Lorem ipsum dolor sit amet consectetur adpiscing elit. Consectetur adipiscing elit quisque faucibus ex sapien vitae.', 16, '...') }}
                </p>
                <div class="flex items-center justify-between">
                    <a href="" class="flex w-fit items-center gap-x-3 text-[11px] font-medium text-white">
                        <div
                            class="w-7.5 h-7.5 md:w-6.5 md:h-6.5 flex shrink-0 items-center justify-center rounded-full border border-white">
                            <x-fas-arrow-right class="h-3 w-3 text-white" />
                        </div>
                        READ STORY
                    </a>
                    <div class="flex items-center gap-x-2 text-white">
                        <x-letsicon-time-atack class="h-5 w-5" />
                        <span class="text-[10px] font-medium md:text-[13px]">19 JAN 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="items-center justify-between md:flex">
        <div>
            <h1 class="text-2xl font-semibold text-[#121212] md:text-[22px] 2xl:text-[35px] dark:text-white">Featured
                Videos</h1>
            <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">Don't miss daily news</p>
        </div>
        <div class="hidden gap-x-1.5 md:flex">
            <x-buttons.previous-button class="interview-videos-button-prev" />
            <x-buttons.next-button class="interview-videos-button-next" />
        </div>
    </div>
    <div class="my-4 flex md:my-0 md:mb-8 md:mt-4">
        <div class="w-48.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7]"></div>
    </div>
    <div class="mb-4 flex gap-x-1 md:hidden">
        <x-buttons.previous-button class="interview-videos-button-prev" />
        <x-buttons.next-button class="interview-videos-button-next" />
    </div>
    <div class="swiper interview-videos-swiper md:mb-7.5 mb-5 overflow-hidden">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 10; $i++)
                <div class="swiper-slide w-auto!">
                    <x-cards.interview-videos-card />
                </div>
            @endfor
        </div>
    </div>
    <div class="flex items-center gap-1.5 md:justify-end">
        <a href="" class="text-[15px] text-[#007DFC]">View All Videos</a>
        {{-- right arrow --}}
        <x-fas-arrow-right class="h-6 w-6 text-[#007DFC]" />
    </div>
</div>
