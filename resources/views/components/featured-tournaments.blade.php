<div>
    {{-- HEADER --}}
    <h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">Featured Tournaments</h1>

    {{-- SHORT DESCRIPTION --}}
    <p class="text-[13px] font-semibold text-[#666] dark:text-white">Discover the most exciting tournaments happening
        around the world.</p>
    <div class="my-5 flex">
        <div class="w-48.5 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    {{-- SCORE CARD TOURNAMENT --}}
    <div class="swiper score-card-tournament-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 11; $i++)
                <div class="swiper-slide w-80!">
                    <x-cards.score-card-tournament :index="$i" />
                </div>
            @endfor
        </div>
    </div>
</div>
