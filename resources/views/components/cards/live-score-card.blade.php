@props(['match' => null, 'error' => null])

@if ($error)
    <div class="rounded-md border border-red-300 bg-white p-3.5 dark:border-red-500 dark:bg-[#353434]">
        <div class="flex h-32 items-center justify-center">
            <p class="text-center text-sm text-red-500">{{ $error }}</p>
        </div>
    </div>
@elseif($match)
    <div class="rounded-md border border-[#F5F5F5] bg-white p-3.5 dark:border-[#515050] dark:bg-[#353434]">
        {{-- Match Info Header --}}
        <p class="mb-3 text-[8.5px] text-[#48494A] dark:text-white">
            {{ strtoupper($match['status']['text'] ?? 'RESULT') }} •
            {{ $match['matchInfo']['seriesType'] ?? '' }} •
            {{ $match['matchInfo']['location'] ?: $match['matchInfo']['seriesName'] ?? '' }}
        </p>

        {{-- Team 1 --}}
        <div class="mb-2 flex justify-between">
            <div class="flex items-center gap-x-2">
                <img src="{{ $match['team1']['logo'] }}" alt="{{ $match['team1']['name'] }} logo"
                    class="h-5 w-5 rounded-full object-cover"
                    onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-1.webp') }}'">
                {{-- <img src="https://placehold.co/20x20" alt="{{ $match['team1']['name'] }} logo"
                    class="h-5 w-5 rounded-full object-cover"> --}}
                <h1
                    class="{{ $match['isComplete'] && !empty($match['result']) && str_contains($match['result'], $match['team1']['name'])
                        ? 'text-[#48494A] dark:text-white'
                        : 'text-[#A2A6A9]' }} text-sm font-medium">
                    {{ $match['team1']['code'] ?: $match['team1']['name'] }}
                </h1>
            </div>
            <p
                class="{{ $match['isComplete'] && !empty($match['result']) && str_contains($match['result'], $match['team1']['name'])
                    ? 'text-[#48494A] dark:text-white'
                    : 'text-[#A2A6A9]' }} text-sm font-medium">
                {{ $match['team1']['score'] }}/{{ $match['team1']['wickets'] }}
            </p>
        </div>

        {{-- Team 2 --}}
        <div class="mb-3 flex justify-between">
            <div class="flex items-center gap-x-2">
                <img src="{{ $match['team2']['logo'] }}" alt="{{ $match['team2']['name'] }} logo"
                    class="h-5 w-5 rounded-full object-cover"
                    onerror="this.src='{{ asset('images/dummy/live-score-card/dummy-logo-live-score-2.webp') }}'">
                {{-- <img src="https://placehold.co/20x20" alt="{{ $match['team2']['name'] }} logo"
                    class="h-5 w-5 rounded-full object-cover"> --}}
                <h1
                    class="{{ $match['isComplete'] && !empty($match['result']) && str_contains($match['result'], $match['team2']['name'])
                        ? 'text-[#48494A] dark:text-white'
                        : 'text-[#A2A6A9]' }} text-sm font-medium">
                    {{ $match['team2']['code'] ?: $match['team2']['name'] }}
                </h1>
            </div>
            <div class="flex items-end gap-x-1">
                <p class="text-[8.5px] text-[#48494A] dark:text-white">
                    ({{ $match['team2']['overs'] }}/{{ $match['matchInfo']['totalOvers'] }} ov
                    @if ($match['team1']['score'] > 0)
                        , T:{{ $match['team1']['score'] }}
                    @endif)
                </p>
                <p
                    class="{{ $match['isComplete'] && !empty($match['result']) && str_contains($match['result'], $match['team2']['name'])
                        ? 'text-[#48494A] dark:text-white'
                        : 'text-[#A2A6A9]' }} text-sm font-medium">
                    {{ $match['team2']['score'] }}/{{ $match['team2']['wickets'] }}
                </p>
            </div>
        </div>

        {{-- Match Result and Footer --}}
        <div>
            <p class="truncate text-[8.5px] text-[#48494A] dark:text-white" title="{{ $match['result'] }}">
                {{ $match['result'] ?: 'Match in progress' }}
            </p>
            <div class="my-1.5 h-0.5 bg-[#F5F5F5] dark:bg-[#515050]"></div>
            <div class="flex items-center justify-between">
                <p class="text-[8.5px] text-[#48494A] dark:text-white">
                    {{ $match['matchDate'] }}
                </p>
                @if ($match['status']['show'])
                    <div
                        class="{{ $match['status']['class'] }} flex items-center gap-x-1 rounded-[50px] border px-2 py-0.5">
                        <div
                            class="{{ str_contains($match['status']['class'], 'red') ? 'bg-[#D6111A]' : '' }} {{ str_contains($match['status']['class'], 'gray') ? 'bg-gray-500' : '' }} {{ str_contains($match['status']['class'], 'blue') ? 'bg-blue-500' : '' }} h-1 w-1 rounded-full">
                        </div>
                        <span class="text-[8.5px] font-medium">{{ $match['status']['text'] }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="rounded-md border border-[#F5F5F5] bg-white p-3.5 dark:border-[#515050] dark:bg-[#353434]">
        <div class="flex h-32 items-center justify-center">
            <p class="text-sm text-[#A2A6A9]">No match data available</p>
        </div>
    </div>
@endif
