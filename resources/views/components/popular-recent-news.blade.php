<div class="flex flex-col h-full">
    {{-- Popular and recent news button --}}
    <div class="flex justify-center rounded-t-[3px] overflow-hidden">
        <a href=""
            class="block w-1/2 text-center font-semibold bg-[#D6111A] text-[10px] py-2.5 2xl:py-4 text-white">
            POPULAR NEWS
        </a>
        <a href="" class="block w-1/2 text-center font-semibold bg-[#222] text-[10px] py-2.5 2xl:py-4 text-white">
            RECENT NEWS
        </a>

    </div>
    {{-- News content --}}
    <div
        class="bg-[#F9F9F9] dark:bg-[#1F1F1F] py-3.5 lg:py-6 rounded-b-[3px] flex flex-col 2xl:gap-y-5 border border-[#C7C7C7] dark:border-[#373737] flex-1">
        @for ($i = 0; $i < 4; $i++)
            <x-cards.popular-and-recent-news-card />
        @endfor
    </div>

</div>
