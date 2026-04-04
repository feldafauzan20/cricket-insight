<div>
    <div class="md:flex md:items-center md:justify-between">
        <div>
            <h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">All Interviews</h1>
            <p class="mb-3.75 text-sm text-[#666666]">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        </div>
        <x-filter.filter-card icon="ri-global-line" category="Region:" categoryValue="Global" iconColor="#EC0226" />
    </div>
    <div class="lg:mt-3.75 md:mb-5.5 lg:mb-7.5 mb-5 mt-5 flex">
        <div class="w-17.5 lg:w-48.5 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>
    <div class="md:gap-3.75 grid grid-cols-1 gap-2 2xl:grid-cols-2">
        @for ($i = 0; $i < 8; $i++)
            <x-cards.all-interview-card />
        @endfor
    </div>
</div>
