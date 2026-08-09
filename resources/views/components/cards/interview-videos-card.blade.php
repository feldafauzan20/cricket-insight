@props(['video'])

@php
    $videoLink = $video->target_link ?? $video->video_url ?? '#';
    $pubDate = $video->published_at ?? $video->created_at ?? now();
    $formattedDate = $pubDate instanceof \DateTimeInterface ? $pubDate->format('d M Y') : \Carbon\Carbon::parse($pubDate)->format('d M Y');
@endphp

<a href="{{ $videoLink }}" target="_blank" rel="noopener noreferrer" class="w-89.25 group block">
    <div class="mb-3.75 h-52.25 relative overflow-hidden rounded-md">
        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
            alt="{{ $video->title }}"
            class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 transition-opacity group-hover:opacity-100">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90">
                <x-ionicon-play-sharp class="h-4 w-4 text-[#EC0226]" />
            </div>
        </div>
    </div>
    <div class="mb-2.25 w-[90%] md:w-full">
        <h2 class="wrap-break-word line-clamp-2 text-xs font-medium text-[#121212] dark:text-white">{{ $video->title }}</h2>
    </div>
    <div class="gap-x-2.25 flex items-center">
        <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
        <span class="text-[10px] font-semibold text-[#666]">{{ strtoupper($formattedDate) }}</span>
    </div>
</a>
