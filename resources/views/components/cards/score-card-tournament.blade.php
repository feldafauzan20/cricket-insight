{{-- @props(['match' => null, 'error' => null]) --}}
@props(['index' => 0])

@php
    $colors = ['bg-[#000080]', 'bg-[#B90F16]', 'bg-[#130058]'];
    $bgColor = $colors[$index % 3];
@endphp

{{-- @if ($error) --}}
{{-- <div class="rounded-md border border-red-300 bg-white p-3.5 dark:border-red-500 dark:bg-[#353434]">
        <div class="flex h-32 items-center justify-center">
            <p class="text-center text-sm text-red-500">{{ $error }}</p>
        </div>
    </div> --}}
{{-- @elseif($match) --}}

<div class="relative overflow-hidden">

    {{-- BACKGROUND IMAGE --}}
    <img src="{{ asset('images/background-image-abstract/bg-image-score-card-tournament.webp') }}"
        alt="Editor's Choices Background" class="absolute inset-0 z-40 h-full w-full object-cover opacity-10">

    {{-- CONTENT --}}
    <div class="p-4.25 {{ $bgColor }} relative z-30 rounded-md">
        <div class="w-67">
            {{-- Series Header --}}
            <div class="py-1.25 mb-5.75 flex items-center gap-x-2.5 rounded-[20px] bg-black/40 px-2">
                <x-letsicon-trophy class="h-4.25 w-4.25 text-white" />
                <p class="text-xs font-medium text-white">
                    {{ 'Indonesian Women\'s T20 Challenge' ?? '' }}
                </p>
            </div>

            {{-- Tournament Time --}}
            <p class="text-sm font-medium text-white">Tomorrow • 0:45</p>

            {{-- Tournament Info --}}
            <p class="mb-5.75 text-sm font-medium text-white">Round 2 Matchday 1</p>

            {{-- CTA Button --}}
            <a href=""
                class="px-5.25 block w-fit rounded-[20px] border-[0.5px] border-white bg-black/20 py-2 font-medium text-white">
                View Details
            </a>
        </div>

    </div>
</div>

{{-- @else
    <div class="rounded-md border border-[#F5F5F5] bg-white p-3.5 dark:border-[#515050] dark:bg-[#353434]">
        <div class="flex h-32 items-center justify-center">
            <p class="text-sm text-[#A2A6A9]">No match data available</p>
        </div>
    </div>
@endif --}}
