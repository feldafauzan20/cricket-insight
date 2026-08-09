@props(['tournaments' => []])

<div>
    <h1 class="font-poppins mb-5 text-center text-xl font-semibold md:text-left md:text-2xl lg:text-4xl dark:text-white">
        ONGOING TOURNAMENT</h1>
    <div class="swiper ongoing-tournament-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @if(count($tournaments) > 0)
                @foreach ($tournaments->take(10) as $item)
                    <div class="swiper-slide w-86! pb-1">
                        <x-cards.ongoing-tournament-card :tournament="$item" />
                    </div>
                @endforeach
            @else
                @for ($i = 0; $i < 5; $i++)
                    <div class="swiper-slide w-86! pb-1">
                        <x-cards.ongoing-tournament-card />
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>
