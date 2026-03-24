<div class="md:flex md:gap-x-7.5 border-b border-[#EFEFEF] dark:border-[#DEDEDE] pb-7.5">
    <div class="h-47.5 sm:w-69.25 lg:w-92.75 2xl:w-158 md:h-auto 2xl:h-49 rounded-[5px] overflow-hidden mb-3.75 md:mb-0">
        <img src="{{ asset('images/dummy/news-card/dummy-news-card.webp') }}" class="w-full h-full object-cover"
            alt="News Thumbnail">
    </div>
    <div class="2xl:w-full">
        <div class="bg-[#D6111A] w-fit py-1.25 px-3 rounded-[3px] mb-1.25">
            <p class="text-white font-medium text-[10px]">Matches</p>
        </div>
        <div class="mb-1.25 md:w-96 2xl:w-130">
            <h1 class="text-[#121212] dark:text-white font-semibold text-lg">
                {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}</h1>
        </div>
        <div class="flex items-center gap-x-2.25 mb-2.5">
            <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
            <span class="font-semibold text-[10px] text-[#666]">19 JAN 2026</span>
        </div>
        <div class="mb-2.5 2xl:w-130">
            <p class="text-[#666] font-medium text-[11px] 2xl:text-[12px]">
                {{ Str::words('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 16, '...') }}
            </p>
        </div>
        <div class="flex justify-between items-center 2xl:max-h-full">
            <div class="flex items-center text-[#121212] dark:text-white gap-x-2.5">
                <div class="w-9 h-9 rounded-full overflow-hidden">
                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="w-full h-full object-cover">
                </div>
                <p class="font-medium text-[10px]">BY FARHAN DUDI</p>
            </div>
            <div class="flex items-center gap-x-1.25">
                <div class="flex items-center gap-x-1.25">
                    <x-bi-eye class="w-2.5 h-2.5 text-[#EC0226]" />
                    <span class="font-medium text-[10px] text-[#121212] dark:text-white">1.2K</span>
                </div>
                <div class="rounded-full w-1.25 h-1.25 bg-[#666666]"></div>
                <div>
                    <p class="font-medium text-[10px] text-[#121212] dark:text-white">4 Mins Read</p>
                </div>
            </div>
        </div>
    </div>
</div>
