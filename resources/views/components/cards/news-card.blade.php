<div class="md:gap-x-7.5 pb-7.5 border-b border-[#EFEFEF] md:flex dark:border-[#DEDEDE]">
    <div class="h-47.5 sm:w-69.25 lg:w-92.75 2xl:w-158 2xl:h-49 mb-3.75 overflow-hidden rounded-[5px] md:mb-0 md:h-auto">
        {{-- <img src="{{ asset('images/dummy/news-card/dummy-news-card.webp') }}" class="w-full h-full object-cover"
            alt="News Thumbnail"> --}}
        <img src="https://placehold.co/800x400" class="h-full w-full object-cover" alt="News Thumbnail">
    </div>
    <div class="2xl:w-full">
        <div class="py-1.25 mb-1.25 w-fit rounded-[3px] bg-[#D6111A] px-3">
            <p class="text-[10px] font-medium text-white">Matches</p>
        </div>
        <div class="mb-1.25 2xl:w-130 md:w-96">
            <h1 class="text-lg font-semibold text-[#121212] dark:text-white">
                {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}</h1>
        </div>
        <div class="gap-x-2.25 mb-2.5 flex items-center">
            <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
            <span class="text-[10px] font-semibold text-[#666]">19 JAN 2026</span>
        </div>
        <div class="2xl:w-130 mb-2.5">
            <p class="text-[11px] font-medium text-[#666] 2xl:text-[12px]">
                {{ Str::words('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 16, '...') }}
            </p>
        </div>
        <div class="flex items-center justify-between 2xl:max-h-full">
            <div class="flex items-center gap-x-2.5 text-[#121212] dark:text-white">
                <div class="h-9 w-9 overflow-hidden rounded-full">
                    {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="w-full h-full object-cover"> --}}
                    <img src="https://placehold.co/36x36" alt="Profile Picture" class="h-full w-full object-cover">
                </div>
                <p class="text-[10px] font-medium">BY FARHAN DUDI</p>
            </div>
            <div class="gap-x-1.25 flex items-center">
                <div class="gap-x-1.25 flex items-center">
                    <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                    <span class="text-[10px] font-medium text-[#121212] dark:text-white">1.2K</span>
                </div>
                <div class="w-1.25 h-1.25 rounded-full bg-[#666666]"></div>
                <div>
                    <p class="text-[10px] font-medium text-[#121212] dark:text-white">4 Mins Read</p>
                </div>
            </div>
        </div>
    </div>
</div>
