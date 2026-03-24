<section class="lg:flex lg:items-stretch 2xl:container 2xl:mx-auto">
    <div class="hidden md:block h-54.5 lg:h-auto lg:w-97.25 2xl:w-2/5 overflow-hidden">
        <img src="{{ asset('images/dummy/editor-choices/dummy-bg-hero-editor-choices.webp') }}"
            alt=" Editor's Choices Hero Image" class="w-full h-full object-cover">
    </div>
    <div class="relative overflow-hidden 2xl:w-3/5">
        {{-- Background Image --}}
        <img src="{{ asset('images/dummy/dummy-editor-choices.webp') }}" alt="Editor's Choices Background"
            class="absolute inset-0 w-full h-full object-cover opacity-40 z-20">

        {{-- Gradient Overlay --}}
        <div
            class="absolute inset-0 bg-linear-to-br from-[#EC0226] from-1% via-[#6A469C] via-30% to-[#007DFC] to-90% z-10">
        </div>

        {{-- Content --}}
        <div class="relative mx-6 lg:mx-0 md:mx-7.5 py-5 lg:py-13.5 lg:px-13.5 z-30">
            <div class="bg-[#D6111A]/20 px-3.5 py-1 rounded-full w-fit border-2 border-[#D6111A]/20 mb-2">
                <p class="text-white font-semibold text-[13px]">Editor's Choices</p>
            </div>
            <h1 class="text-white font-semibold text-[24px] md:text-[28px] lg:text-[35px] mb-2">
                {{ Str::words('PCI has made history by successfully hosting the inaugural cricket tournament in the region', 8, '...') }}
            </h1>
            <p class="text-[12px] md:text-[14px] leading-[129.4%] tracking-[-3%] text-white mb-5">
                {{ Str::words('Lorem ipsum dolor sit amet consectetur adpiscing elit. Consectetur adipiscing elit quisque faucibus ex sapien vitae.', 16, '...') }}
            </p>
            <div class="w-57 md:w-63.25 lg:h-fit flex justify-between items-center mb-7">
                <div class="flex items-center text-white gap-x-2.5">
                    <div class="w-9 h-9 rounded-full overflow-hidden">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px]"><span class="font-normal">By </span>Farhan Dudi</p>
                </div>
                <div class="flex items-center gap-x-2 md:gap-x-3.5 text-white">
                    <x-letsicon-time-atack class="w-5 h-5" />
                    <span class="font-medium text-[10px] md:text-[13px]">19 JAN 2026</span>
                </div>
            </div>
            <div>
                <a href="" class="flex items-center w-fit gap-x-3 text-white text-[11px] font-medium">
                    <div
                        class="w-7.5 h-7.5 md:w-6.5 md:h-6.5 shrink-0 border border-white rounded-full flex items-center justify-center">
                        <x-fas-arrow-right class="w-3 h-3 text-white" />
                    </div>
                    READ STORY
                </a>
            </div>
        </div>
    </div>
</section>
