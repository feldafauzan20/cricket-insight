@props(['tournaments' => []])

<div>
    {{-- HEADER --}}
    <h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">{{__('tournament.tournament_spotlight_header')}}</h1>

    {{-- SHORT DESCRIPTION --}}
    <p class="text-[13px] font-semibold text-[#666] dark:text-white">{{__('tournament.tournament_spotlight_subheader')}}</p>
    <div class="my-5 flex">
        <div class="w-48.5 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>

    {{-- SCORE CARD TOURNAMENT --}}
    <div class="swiper score-card-tournament-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @if(count($tournaments) > 0)
                @foreach ($tournaments as $index => $tournament)
                    <div class="swiper-slide w-80! h-auto flex">
                        <x-cards.score-card-tournament :tournament="$tournament" :index="$index" />
                    </div>
                @endforeach
            @else
                @for ($i = 0; $i < 6; $i++)
                    <div class="swiper-slide w-80! h-auto flex">
                        <x-cards.score-card-tournament :index="$i" />
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>

