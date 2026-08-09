@props(['tournament' => null, 'index' => 0])

@php
    use Illuminate\Support\Str;
    $colors = ['bg-[#000080]', 'bg-[#B90F16]', 'bg-[#130058]'];
    $bgColor = $colors[$index % 3];

    $title = $tournament->tournament_title ?? 'Indonesian Women\'s T20 Challenge';
    $time = isset($tournament->time_date) ? \Carbon\Carbon::parse($tournament->time_date)->format('D, M d • H:i') : 'Tomorrow • 0:45';
    $desc = !empty($tournament->description) ? Str::words(strip_tags($tournament->description), 5, '...') : 'Round 2 Matchday 1';
    $link = !empty($tournament->redirect_link) ? $tournament->redirect_link : '';
@endphp

<div class="relative overflow-hidden w-full h-full flex flex-col justify-between rounded-md">

    {{-- BACKGROUND IMAGE --}}
    <img src="{{ asset('images/background-image-abstract/bg-image-score-card-tournament.webp') }}"
        alt="Editor's Choices Background"
        class="pointer-events-none absolute inset-0 z-40 h-full w-full object-cover opacity-10">

    {{-- CONTENT --}}
    <div class="p-4.25 {{ $bgColor }} relative z-30 rounded-md h-full flex flex-col justify-between w-full">
        <div class="w-67 flex flex-col h-full justify-between">
            <div>
                {{-- Series Header --}}
                <div class="py-1.25 mb-5.75 flex items-center gap-x-2.5 rounded-[20px] bg-black/40 px-2">
                    <x-letsicon-trophy class="h-4.25 w-4.25 text-white shrink-0" />
                    <p class="text-xs font-medium text-white line-clamp-1">
                        {{ $title }}
                    </p>
                </div>

                {{-- Tournament Time --}}
                <p class="text-sm font-medium text-white">{{ $time }}</p>

                {{-- Tournament Info --}}
                <p class="mb-5.75 text-sm font-medium text-white line-clamp-1">{{ $desc }}</p>
            </div>

            {{-- CTA Button --}}
            <div class="mt-auto">
                <a href="{{ $link }}"
                    class="px-5.25 block w-fit rounded-[20px] border-[0.5px] border-white bg-black/20 py-2 font-medium text-white">
                    View Details
                </a>
            </div>
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
