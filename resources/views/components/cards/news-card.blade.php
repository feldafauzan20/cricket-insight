@props(['showBorder' => false])

<div class="flex-1 {{ $showBorder ? 'border-t border-t-[#EC0226]' : 'border-t border-t-white' }}">
    <div class="flex pt-7 gap-x-7">
        <div class="w-25 h-17.5 rounded-xs overflow-hidden">
            <img src="{{ asset('images/dummy/news-card/dummy-news-card.jpg') }}" alt="News Card Image"
                class="w-full h-full object-cover">
        </div>

        <div>
            <h1 class="font-semibold text-xs text-white mb-1.5">
                {{ Str::words('The Indonesian men\'s national cricket team', 4, '...') }}
            </h1>
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
                <span class="font-semibold text-[10px] text-white">19 JAN 2026</span>
            </div>
        </div>
    </div>
</div>
