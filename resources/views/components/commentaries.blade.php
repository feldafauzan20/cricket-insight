<div>
    <div>
        <h1 class="font-semibold text-2xl md:text-[22px] 2xl:text-[35px] dark:text-white text-[#121212]">Commentaries
        </h1>
        <p class="text-[13px] font-semibold text-[#666] dark:text-[#B2B2B2]">Don't miss daily news</p>
        <div class="flex my-4 md:my-0 md:mt-4 md:mb-8">
            <div class="w-48.5 md:w-88.5 2xl:w-91 h-px bg-[#EC0226]"></div>
            <div class="w-full h-px bg-[#C7C7C7]"></div>
        </div>
        <div class="mb-6 md:mb-7.5 2xl:mb-10 md:flex lg:flex-col 2xl:flex-row md:gap-x-2.5 2xl:gap-x-7">
            <div class="2xl:w-1/2">
                <x-cards.commentaries-big-card />
            </div>
            <div class="2xl:w-1/2">
                <x-cards.commentaries-big-card />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-2.5 lg:gap-x-16 2xl:gap-x-7">
            @for ($i = 0; $i < 6; $i++)
                <x-cards.commentaries-small-card />
            @endfor
        </div>
    </div>
</div>
