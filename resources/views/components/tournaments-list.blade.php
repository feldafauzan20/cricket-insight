{{-- HEADER --}}
<h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">On going tournament</h1>

{{-- SHORT DESCRIPTION --}}
<p class="text-[13px] font-semibold text-[#666] dark:text-white">Discover the most exciting tournaments happening
    around the world.</p>
<div class="my-5 flex">
    <div class="w-48.5 h-px bg-[#EC0226]"></div>
    <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
</div>

{{-- ON GOING TOURNAMENT CARD --}}
<div>
    <div
        class="rounded-t-[5px] border border-[#F3F3F3] px-4 py-3 md:flex md:justify-between dark:border-none dark:bg-[#1F1F1F]">
        <p class="text-xs font-medium text-[#121212] dark:text-white">
            Match 7 • Men’s PM Cup 2026 <span class="text-[#666]">• Mar 24, 10:15 AM GMT+7</span>
        </p>
        <p class="text-xs font-medium text-[#121212] dark:text-white">OtherOD</p>
    </div>
    <div
        class="py-2.25 flex items-center justify-between border-x border-[#F3F3F3] px-4 md:py-3 dark:border-none dark:bg-[#1F1F1F]">
        <div>
            {{-- Team 1 --}}
            <div class="mb-2">
                <div class="flex items-center gap-x-2">
                    {{-- <img src="{{ $match['team2']['logo'] }}" alt="{{ $match['team2']['name'] }} logo"
                        class="h-5 w-5 rounded-full object-cover"
                        onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp') }}'"> --}}
                    <img src="https://placehold.co/20x20" alt="logo" class="h-5 w-5 rounded-full object-cover">
                    <h1 class="text-sm font-medium text-[#121212] dark:text-white">
                        Team Ipsum 1
                    </h1>
                </div>
            </div>

            {{-- Team 2 --}}
            <div>
                <div class="flex items-center gap-x-2">
                    {{-- <img src="{{ $match['team2']['logo'] }}" alt="{{ $match['team2']['name'] }} logo"
                        class="h-5 w-5 rounded-full object-cover"
                        onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp') }}'"> --}}
                    <img src="https://placehold.co/20x20" alt="logo" class="h-5 w-5 rounded-full object-cover">
                    <h1 class="text-sm font-medium text-[#121212] dark:text-white">
                        Team Ipsum 2
                    </h1>
                </div>
            </div>
        </div>
        <div>
            <p class="text-xs font-medium text-[#666]">Wed, Mar 25</p>
            <p class="text-[22px] text-sm font-medium text-[#121212] dark:text-white">10:15 AM</p>
        </div>
    </div>
    <div class="rounded-b-[5px] bg-[#EEEEEE] px-3 py-4 dark:bg-[#353434]">
        <p class="text-xs font-medium text-[#666]">Match yet to begin</p>
    </div>
</div>

{{-- SEPARATOR LINE --}}
<div class="my-5 flex">
    <div class="w-48.5 h-px bg-[#EC0226]"></div>
    <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
</div>

{{-- ANOTHER TOURNAMENT CARD --}}
<div class="gap-y-6.25 flex flex-col">
    @for ($i = 0; $i < 11; $i++)
        <div>
            <div
                class="rounded-t-[5px] border border-[#F3F3F3] px-4 py-3 md:flex md:justify-between dark:border-none dark:bg-[#1F1F1F]">
                <p class="text-xs font-medium text-[#121212] dark:text-white">
                    Match 7 • Men’s PM Cup 2026 <span class="text-[#666]">• Mar 24, 10:15 AM GMT+7</span>
                </p>
                <p class="text-xs font-medium text-[#121212] dark:text-white">OtherOD</p>
            </div>
            <div
                class="py-2.25 flex items-center justify-between border-x border-[#F3F3F3] px-4 md:py-3 dark:border-none dark:bg-[#1F1F1F]">
                <div>
                    {{-- Team 1 --}}
                    <div class="mb-2">
                        <div class="flex items-center gap-x-2">
                            {{-- <img src="{{ $match['team2']['logo'] }}" alt="{{ $match['team2']['name'] }} logo"
                        class="h-5 w-5 rounded-full object-cover"
                        onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp') }}'"> --}}
                            <img src="https://placehold.co/20x20" alt="logo"
                                class="h-5 w-5 rounded-full object-cover">
                            <h1 class="text-sm font-medium text-[#121212] dark:text-white">
                                Team Ipsum 1
                            </h1>
                        </div>
                    </div>

                    {{-- Team 2 --}}
                    <div>
                        <div class="flex items-center gap-x-2">
                            {{-- <img src="{{ $match['team2']['logo'] }}" alt="{{ $match['team2']['name'] }} logo"
                        class="h-5 w-5 rounded-full object-cover"
                        onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp') }}'"> --}}
                            <img src="https://placehold.co/20x20" alt="logo"
                                class="h-5 w-5 rounded-full object-cover">
                            <h1 class="text-sm font-medium text-[#121212] dark:text-white">
                                Team Ipsum 2
                            </h1>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-medium text-[#666]">Wed, Mar 25</p>
                    <p class="text-[22px] text-sm font-medium text-[#121212] dark:text-white">10:15 AM</p>
                </div>
            </div>
            <div class="rounded-b-[5px] bg-[#EEEEEE] px-3 py-4 dark:bg-[#353434]">
                <p class="text-xs font-medium text-[#666]">Match yet to begin</p>
            </div>
        </div>
    @endfor
</div>
