<div x-data="{ open: false }" class="relative">
    {{-- Filter Button --}}
    <button @click="open = !open"
        class="bg-[#F3F3F3] dark:bg-[#353434] w-full rounded-[3px] py-1.5 md:py-3.75 px-2.75 md:px-2.75 flex items-center gap-x-1 hover:bg-[#E8E8E8] dark:hover:bg-[#2A2A2A] transition-colors">
        <x-ri-filter-line class="w-6 h-6 text-[#818181] dark:text-[#D3D3D3]" />
        <div class="flex items-center gap-x-1">
            <p class="text-[#818181] dark:text-[#D3D3D3] text-sm font-semibold">FILTERS</p>
            <x-ri-arrow-down-s-line class="w-6 h-6 text-[#818181] dark:text-[#D3D3D3] transition-transform duration-200"
                x-bind:class="open ? 'rotate-180' : 'rotate-0'" />
        </div>
    </button>

    {{-- Filter Menu Dropdown --}}
    <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="mt-3.75">
        <x-filter.filter-menu
            :categories="$categories"
            :tags="$tags"
            :sort-options="$sortOptions"
            :time-frames="$timeFrames"
            :popularity-options="$popularityOptions"
            :region-options="$regionOptions"
            :filters="$filters"
        />
    </div>
</div>
