<div>
    <h1 class="font-poppins mb-5 text-center text-xl font-semibold">ONGOING TOURNAMENT</h1>
    <div class="swiper ongoing-tournament-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @for ($i = 0; $i < 5; $i++)
                <div class="swiper-slide w-86! pb-1">
                    <x-cards.ongoing-tournament-card />
                </div>
            @endfor
        </div>
    </div>
</div>
