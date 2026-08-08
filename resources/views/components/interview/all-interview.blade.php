@props(['interviews', 'regionOptions' => [], 'filters' => []])

@php
    $selectedRegion = $filters['region'] ?? 'Indonesia';
    $regionLabel = $regionOptions[$selectedRegion] ?? $selectedRegion;
@endphp

<div x-data="{
    open: false,
    applyFilter(key, value) {
        const params = new URLSearchParams(window.location.search);

        if (value === '' || value === null || value === undefined) {
            params.delete(key);
        } else {
            params.set(key, value);
        }

        params.delete('page');

        const url = new URL('{{ route('interviews.index', ['locale' => app()->getLocale()]) }}', window.location.origin);
        url.search = params.toString();
        window.location.href = url.toString();
    }
}">
    <div class="md:flex md:items-center md:justify-between">
        <div>
            <h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">All Interviews</h1>
            <p class="mb-3.75 text-sm text-[#666666]">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        </div>
        <div class="relative" @click.away="open = false">
            <div @click="open = !open">
                <x-filter.filter-card icon="ri-global-line" category="Region:" categoryValue="{{ $regionLabel }}"
                    iconColor="#EC0226" />
            </div>
            <div x-show="open" x-cloak
                class="absolute right-0 top-full z-20 mt-2 min-w-45 rounded-[10px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#2A2A2A] dark:bg-[#171717]">
                @foreach ($regionOptions as $regionKey => $regionLabelItem)
                    <button type="button"
                        class="flex w-full items-center rounded-md px-3 py-2 text-left text-sm text-[#121212] transition hover:bg-[#F3F3F3] dark:text-white dark:hover:bg-[#2A2A2A]"
                        @click.prevent="applyFilter('region', '{{ $regionKey }}'); open = false">{{ $regionLabelItem }}</button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="lg:mt-3.75 md:mb-5.5 lg:mb-7.5 mb-5 mt-5 flex">
        <div class="w-17.5 lg:w-48.5 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>
    @if ($interviews->isNotEmpty())
        <div class="md:gap-3.75 grid grid-cols-1 gap-2 2xl:grid-cols-2">
            @foreach ($interviews as $interview)
                <x-cards.all-interview-card :article="$interview" />
            @endforeach
        </div>

        <div class="mt-7.5">
            <x-pagination.pagination :paginator="$interviews" />
        </div>
    @else
        <div
            class="rounded-md border border-[#F5F5F5] bg-white p-8 text-center dark:border-[#515050] dark:bg-[#353434]">
            <p class="text-sm text-[#A2A6A9]">No interviews available at the moment</p>
        </div>
    @endif
</div>
