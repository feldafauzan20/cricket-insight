@php
    use App\Models\Video;

    $featuredVideos = Video::with(['uploader', 'category'])
        ->where('is_active', true)
        ->latest()
        ->limit(8)
        ->get();
@endphp

<div class="2xl:flex">
    {{-- Header Section --}}
    <div class="relative w-full 2xl:w-107.25 2xl:h-131.25 2xl:shrink-0 2xl:flex 2xl:items-center 2xl:justify-center ">
        <img src="{{ asset('images/dummy/featured-video/dummy-bg-featured-video.webp') }}" alt="Featured Video Background"
            class="absolute w-full h-full object-cover opacity-10 z-20" />
        <div class="absolute inset-0 bg-[#1F1D5E] z-10"></div>

        <div class="relative px-10 py-17.5 2xl:px-0 2xl:py-0 z-30">
            <div class="bg-white w-10 h-0.5 mb-2.5 md:mb-5"></div>
            <h1 class="text-white font-semibold text-[20px] mb-1">Featured Video</h1>
            <p class="text-white leading-[217%] text-[11px] mb-12.5">Don’t Miss And Stay Up-to-date. Top pic for you.</p>
            <div class="flex items-center gap-x-9">
                <div class="bg-white/20 w-full h-px"></div>
                <div class="flex items-center gap-x-1">
                    <x-buttons.previous-button class="featured-video-button-prev" />
                    <x-buttons.next-button class="featured-video-button-next" />
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Section --}}
    <div class="swiper featured-video-swiper w-full 2xl:w-auto overflow-hidden">
        <div class="swiper-wrapper">
            @forelse ($featuredVideos as $video)
                <div class="swiper-slide w-full 2xl:w-107.25! 2xl:shrink-0">
                    <div class="relative h-131.25 group block cursor-pointer">
                        {{-- Thumbnail Video --}}
                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}" 
                            alt="{{ $video->title }}"
                            class="absolute w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />

                        <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black w-full"></div>

                        {{-- Content --}}
                        <div class="relative px-7.5 py-10 flex flex-col justify-between h-full">
                            <div class="flex items-center text-white gap-x-2.5">
                                <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-white/30">
                                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                        alt="Profile Picture" class="w-full h-full object-cover">
                                </div>
                                <p class="font-semibold text-[10px] md:text-sm line-clamp-1">BY {{ strtoupper($video->uploader->name ?? 'ADMIN') }}</p>
                            </div>
                            
                            <div>
                                <div class="bg-[#D6111A] w-fit py-1.5 px-5 rounded-[3px] mb-1">
                                    <span class="text-white font-medium text-xs">{{ $video->category->name ?? 'Video' }}</span>
                                </div>
                                
                                <h1 class="text-[19px] font-semibold text-white mb-1 group-hover:text-gray-300 transition-colors line-clamp-2">
                                    {{ $video->title }}
                                </h1>
                                
                                <div class="flex items-center gap-x-4 mt-3">
                                    <div class="flex items-center gap-x-2">
                                        <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
                                        <span class="font-semibold text-[10px] text-white">
                                            {{ strtoupper($video->published_at ? $video->published_at->format('d M Y') : $video->created_at->format('d M Y')) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-x-1.5">
                                        <x-bi-eye class="w-2.5 h-2.5 text-[#EC0226]" />
                                        <span class="font-semibold text-[10px] text-white">{{ $video->views ?? '0' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full h-131.25 flex items-center justify-center bg-[#1F1D5E]">
                    <p class="text-white text-sm">Belum ada video saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>