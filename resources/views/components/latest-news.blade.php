<div class="px-6 md:px-7.5 lg:px-10 2xl:px-0 2xl:container 2xl:mx-auto pt-6 pb-4 md:pb-6 lg:pb-11 2xl:pb-6 md:pt-12.5">
    <div class="md:flex items-center justify-between">
        <div>
            <h1 class="font-semibold text-2xl md:text-[22px] text-[#121212] dark:text-white">Latest News Around Cricket
                Insight</h1>
            <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">Don't miss daily news</p>
        </div>
        <div class="gap-x-1.5 hidden md:flex">
            <x-buttons.previous-button class="latest-news-button-prev" />
            <x-buttons.next-button class="latest-news-button-next" />
        </div>
    </div>
    <div class="flex my-4 md:my-0 md:mt-4 md:mb-8">
        <div class="w-48.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="w-full h-px bg-[#C7C7C7]"></div>
    </div>
    <div class="flex gap-x-1 mb-4 md:hidden">
        <x-buttons.previous-button class="latest-news-button-prev" />
        <x-buttons.next-button class="latest-news-button-next" />
    </div>
    <div class="swiper latest-news-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 10; $i++)
                <div class="swiper-slide w-88.5!">
                    <x-cards.latest-news-card />
                </div>
            @endfor
        </div>
    </div>
</div>
