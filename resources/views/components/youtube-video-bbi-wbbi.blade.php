@props(['setting' => null])

@php
    $videoUrl = \App\View\Components\YoutubeVideoBbiWbbi::toEmbedUrl($setting?->loop_video_url);
@endphp

<div class="mt-12.5 md:mt-25">
    @if (!empty($videoUrl))
        <div class="relative w-full overflow-hidden pt-[56.25%] md:h-167.5 md:pt-0">
            <iframe src="{{ $videoUrl }}" 
                class="absolute inset-0 h-full w-full border-0" 
                allow="autoplay; encrypted-media; picture-in-picture" 
                allowfullscreen></iframe>
        </div>
    @else
        <img src="https://placehold.co/1200x670?text=Youtube+Video" alt="BBI Video"
            class="md:h-167.5 h-full w-full object-cover">
    @endif
</div>
