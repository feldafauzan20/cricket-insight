@props(['interview'])

<a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $interview->slug]) }}"
    class="md:gap-x-7.5 md:flex md:flex-row-reverse">
    <div class="h-47.5 md:h-47.5 md:w-61.25 lg:w-91.25 mb-2.5 overflow-hidden rounded-[3px] md:mb-0">
        <img src="{{ $interview->thumbnail ? asset('storage/' . $interview->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
            alt="{{ $interview->title }}" class="h-full w-full object-cover">
    </div>
    <div>
        <div class="py-1.25 mb-1.25 w-fit rounded-[3px] bg-[#D6111A] px-3">
            <p class="text-[10px] font-medium text-white">{{ $interview->category?->name ?? 'Interview' }}</p>
        </div>
        <div class="mb-1.25 md:w-102.75">
            <h2 class="text-lg font-semibold text-[#121212] dark:text-white">
                {{ Str::words($interview->title, 8, '...') }}</h2>
        </div>
        <div class="gap-x-2.25 mb-2.5 flex items-center">
            <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
            <span
                class="text-[10px] font-semibold text-[#666] dark:text-white">{{ optional($interview->published_at)->format('d M Y') ?? 'N/A' }}</span>
        </div>
        <p class="mb-2.5 text-xs font-medium text-[#666666] dark:text-white">
            {{ Str::words($interview->description ?? strip_tags($interview->content ?? ''), 20, '...') }}
        </p>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2.5 text-[#121212] dark:text-white">
                <div class="h-9 w-9 overflow-hidden rounded-full">
                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="h-full w-full object-cover">
                </div>
                <p class="text-[10px] font-medium">BY {{ strtoupper($interview->uploader?->name ?? 'UNKNOWN') }}</p>
            </div>
            <div class="gap-x-1.25 flex items-center">
                <div class="gap-x-1.25 flex items-center">
                    <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                    <span
                        class="text-[10px] font-medium text-[#121212] dark:text-white">{{ number_format($interview->views_count) }}</span>
                </div>
                <div class="w-1.25 h-1.25 rounded-full bg-[#666666]"></div>
                <div>
                    <p class="text-[10px] font-medium text-[#121212] dark:text-white">
                        {{ ceil(str_word_count($interview->description ?? strip_tags($interview->content ?? '')) / 200) }}
                        Mins Read</p>
                </div>
            </div>
        </div>
    </div>
</a>
