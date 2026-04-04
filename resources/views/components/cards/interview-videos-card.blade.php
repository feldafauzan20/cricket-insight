@php
    $videoId = $videoId ?? uniqid('youtube-player-');
@endphp
<div class="max-w-89.25 w-full">
    <div class="mb-3.75 max-h-52.25 relative aspect-video overflow-hidden rounded-md">
        <iframe id="{{ $videoId }}" class="youtube-player absolute inset-0 h-full w-full object-contain"
            src="https://www.youtube.com/embed/7AkYrJfP7Ck?si=FaMUuvvat9U62a63&amp;start=1&amp;enablejsapi=1"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <div class="mb-2.25 w-[90%] md:w-full">
        <h2 class="wrap-break-word line-clamp-2 text-xs font-medium text-[#121212] dark:text-white">Lorem, ipsum dolor
            sit amet
            consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis inventore veniam
            iusto praesentium id reprehenderit nobis! Dicta aliquid eveniet eos!</h2>
    </div>
    <div class="gap-x-2.25 flex items-center">
        <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
        <span class="text-[10px] font-semibold text-[#666]">19 JAN 2026</span>
    </div>
</div>
