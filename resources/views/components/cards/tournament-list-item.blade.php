@props(['tournament'])

@php
    $title = $tournament->tournament_title ?? 'Ongoing Tournament';
    $timeStr = isset($tournament->time_date) ? \Carbon\Carbon::parse($tournament->time_date)->format('M d, H:i A T') : 'Live';
    $dateDay = isset($tournament->time_date) ? \Carbon\Carbon::parse($tournament->time_date)->format('D, M d') : '';
    $timeHour = isset($tournament->time_date) ? \Carbon\Carbon::parse($tournament->time_date)->format('h:i A') : '';
    $link = $tournament->redirect_link ?? '#';
    $desc = !empty($tournament->description) ? strip_tags($tournament->description) : 'Match yet to begin';
@endphp

<div>
    <div
        class="rounded-t-[5px] border border-[#F3F3F3] px-4 py-3 md:flex md:justify-between dark:border-none dark:bg-[#1F1F1F]">
        <p class="text-xs font-medium text-[#121212] dark:text-white">
            {{ $title }} <span class="text-[#666]">• {{ $timeStr }}</span>
        </p>
        <a href="{{ $link }}" @if(!empty($tournament->redirect_link)) target="_blank" rel="noopener noreferrer" @endif
            class="text-xs font-medium text-[#EC0226] hover:underline">View Details &rarr;</a>
    </div>
    <div
        class="py-2.25 flex items-center justify-between border-x border-[#F3F3F3] px-4 md:py-3 dark:border-none dark:bg-[#1F1F1F]">
        <div>
            <div class="flex items-center gap-x-2.5">
                @if(!empty($tournament->image))
                    <img src="{{ Str::startsWith($tournament->image, ['http://', 'https://', 'images/']) ? asset($tournament->image) : asset('storage/' . $tournament->image) }}"
                        alt="logo" class="h-6 w-6 rounded-full object-cover">
                @else
                    <x-letsicon-trophy class="h-5 w-5 text-[#EC0226]" />
                @endif
                <h1 class="text-sm font-medium text-[#121212] dark:text-white">
                    {{ $title }}
                </h1>
            </div>
        </div>
        @if($dateDay || $timeHour)
            <div>
                <p class="text-xs font-medium text-[#666]">{{ $dateDay }}</p>
                <p class="text-[22px] text-sm font-medium text-[#121212] dark:text-white">{{ $timeHour }}</p>
            </div>
        @endif
    </div>
    <div class="rounded-b-[5px] bg-[#EEEEEE] px-3 py-4 dark:bg-[#353434]">
        <p class="text-xs font-medium text-[#666]">{{ Str::words($desc, 15, '...') }}</p>
    </div>
</div>
