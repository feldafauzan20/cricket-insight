<div>
    <h1 class="font-semibold text-[24px] md:text-[22px] text-[#121212] dark:text-[#EEEEEE] 2xl:hidden">
        Trending</h1>
    <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2] mb-4 2xl:hidden">Don't miss daily news</p>

    <div class="2xl:hidden flex my-4 md:my-0 md:mt-4 md:mb-8">
        <div class="w-48.5 md:w-88.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    {{-- Trending cards container --}}
    <div class="2xl:flex 2xl:gap-x-2.5">
        {{-- Trending 1 - Big card --}}
        <div class="mb-2.5 2xl:mb-0 2xl:w-1/2">
            <x-cards.trending-card height="h-100.25 md:h-[435px] lg:h-[691px] 2xl:h-[593px]"
                image="/images/dummy/trending-card/dummy-trending-card-1.webp"
                title="PCI has made history by successfully hosting the inaugural cricket tournament in the region"
                author="FARHAN DUDI" timeRead="1" date="19 JAN 2026" trendingNumber="1" fontSize="text-[32px]" />
        </div>

        {{-- Trending 2 & 3 - Small cards stacked --}}
        <div
            class="flex flex-col md:flex-row 2xl:flex-col gap-y-2.5 md:gap-y-0 md:gap-x-2.5 2xl:gap-y-2.5 2xl:gap-x-0 2xl:w-1/2">
            <x-cards.trending-card height="h-[300px] 2xl:h-[290px]"
                image="/images/dummy/trending-card/dummy-trending-card-2.webp"
                title="Another trending news title goes here" author="FELDA FAUZAN" timeRead="2" date="20 JAN 2026"
                trendingNumber="2" fontSize="text-[18px]" />
            <x-cards.trending-card height="h-[300px] 2xl:h-[290px]"
                image="/images/dummy/trending-card/dummy-trending-card-3.webp"
                title="Yet another trending news title goes here" author="Fatur Ariel" timeRead="4" date="08 JAN 2026"
                trendingNumber="3" fontSize="text-[18px]" />
        </div>
    </div>
</div>
