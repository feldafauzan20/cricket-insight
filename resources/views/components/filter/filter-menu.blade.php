<div class="2xl:flex flex-col gap-4" x-data="{
    applyFilter(key, value) {
        const params = new URLSearchParams(window.location.search);

        if (value === '' || value === null || value === undefined) {
            params.delete(key);
        } else {
            params.set(key, value);
        }

        params.delete('page');

        const url = new URL('{{ route('news.index') }}', window.location.origin);
        url.search = params.toString();
        window.location.href = url.toString();
    }
}">
    @php
        $sortLabel = $sortOptions[$filters['sort'] ?? 'newest_first'] ?? 'Newest First';
        $timeLabel = $timeFrames[$filters['time_frame'] ?? 'all_time'] ?? 'All Time';
        $popularityLabel = $popularityOptions[$filters['popularity'] ?? 'most_viewed'] ?? 'Most Viewed';
        $tagLabel = $filters['tag'] ? ucfirst(str_replace(['-', '_'], ' ', $filters['tag'])) : 'Any';
    @endphp

    <div class="flex flex-wrap gap-1.25 items-center mb-3.75 2xl:mb-0 md:w-150 2xl:w-fit 2xl:border-r-2 border-[#C7C7C7] 2xl:pr-3 2xl:mr-3">
        <div class="relative" x-data="{ open: false }" @click.away="open = false" @filter-open.window="if ($event.detail !== 'sort') open = false">
            <x-filter.filter-card
                icon="ri-sort-desc"
                category="Sort"
                categoryValue="{{ $sortLabel }}"
                iconColor="#EC0226"
                x-on:click="open = !open; if (open) $dispatch('filter-open', 'sort'); else $dispatch('filter-open', null)"
            />
            <div x-show="open" x-cloak class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-[10px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#2A2A2A] dark:bg-[#171717]">
                @foreach ($sortOptions as $sortKey => $sortLabelItem)
                    <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('sort', '{{ $sortKey }}'); open = false">{{ $sortLabelItem }}</button>
                @endforeach
            </div>
        </div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false" @filter-open.window="if ($event.detail !== 'time_frame') open = false">
            <x-filter.filter-card
                icon="ri-time-line"
                category="Time Frame"
                categoryValue="{{ $timeLabel }}"
                iconColor="#EC0226"
                x-on:click="open = !open; if (open) $dispatch('filter-open', 'time_frame'); else $dispatch('filter-open', null)"
            />
            <div x-show="open" x-cloak class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-[10px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#2A2A2A] dark:bg-[#171717]">
                @foreach ($timeFrames as $timeKey => $timeLabelItem)
                    <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('time_frame', '{{ $timeKey }}'); open = false">{{ $timeLabelItem }}</button>
                @endforeach
            </div>
        </div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false" @filter-open.window="if ($event.detail !== 'popularity') open = false">
            <x-filter.filter-card
                icon="ri-fire-line"
                category="Popularity"
                categoryValue="{{ $popularityLabel }}"
                iconColor="#EC0226"
                x-on:click="open = !open; if (open) $dispatch('filter-open', 'popularity'); else $dispatch('filter-open', null)"
            />
            <div x-show="open" x-cloak class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-[10px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#2A2A2A] dark:bg-[#171717]">
                <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('popularity', ''); open = false">Any Popularity</button>
                @foreach ($popularityOptions as $popularityKey => $popularityLabelItem)
                    <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('popularity', '{{ $popularityKey }}'); open = false">{{ $popularityLabelItem }}</button>
                @endforeach
            </div>
        </div>

    </div>

    <div class="border-t border-dashed border-[#E0E0E0] 2xl:border-none">
        <div class="pt-3.75 2xl:pt-0">
            <div class="relative" x-data="{ open: false }" @click.away="open = false" @filter-open.window="if ($event.detail !== 'tag') open = false">
                <x-filter.filter-card
                    icon="ri-price-tag-3-line"
                    category="Tag"
                    categoryValue="{{ $tagLabel }}"
                    iconColor="#007DFC"
                    x-on:click="open = !open; if (open) $dispatch('filter-open', 'tag'); else $dispatch('filter-open', null)"
                />
                <div x-show="open" x-cloak class="absolute left-0 top-full z-20 mt-2 min-w-[220px] rounded-[10px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#2A2A2A] dark:bg-[#171717]">
                    <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('tag', ''); open = false">Any Tag</button>
                    @foreach ($tags as $tag)
                        <button type="button" class="flex w-full items-center rounded-[6px] px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]" @click.prevent="applyFilter('tag', '{{ $tag->slug }}'); open = false">{{ $tag->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
