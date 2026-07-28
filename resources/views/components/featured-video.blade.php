<div class="2xl:flex">
    {{-- Header Section --}}
    <div class="2xl:w-107.25 2xl:h-131.25 relative w-full 2xl:flex 2xl:shrink-0 2xl:items-center 2xl:justify-center">
        <img src="{{ asset('images/dummy/featured-video/dummy-bg-featured-video.webp') }}" alt="Featured Video Background"
            class="absolute z-20 h-full w-full object-cover opacity-10" />
        <div class="absolute inset-0 z-10 bg-[#1F1D5E]"></div>

        <div class="py-17.5 relative z-30 px-10 2xl:px-0 2xl:py-0">
            <div class="mb-2.5 h-0.5 w-10 bg-white md:mb-5"></div>
            <h1 class="mb-1 text-[20px] font-semibold text-white">{{ __('home.featured_video_header') }}</h1>
            <p class="mb-12.5 text-[11px] leading-[217%] text-white">{{ __('home.featured_video_subheader') }}</p>
            <div class="flex items-center gap-x-9">
                <div class="h-px w-full bg-white/20"></div>
                <div class="flex items-center gap-x-1">
                    <x-buttons.previous-button class="featured-video-button-prev" />
                    <x-buttons.next-button class="featured-video-button-next" />
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel Section --}}
    <div class="swiper featured-video-swiper w-full overflow-hidden 2xl:w-auto">
        <div class="swiper-wrapper">
            @forelse ($featuredVideos as $video)
                <div class="swiper-slide 2xl:w-107.25! w-full 2xl:shrink-0">
                    <div class="h-131.25 group relative block cursor-pointer">
                        {{-- Thumbnail Video --}}
                        <img src="{{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
                            alt="{{ $video->title }}"
                            class="absolute h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />

                        <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

                        {{-- Content --}}
                        <div class="px-7.5 relative flex h-full flex-col justify-between py-10">
                            <div class="flex items-center gap-x-2.5 text-white">
                                <div class="h-9 w-9 shrink-0 overflow-hidden rounded-full border border-white/30">
                                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                        alt="Profile Picture" class="h-full w-full object-cover">
                                </div>
                                <p class="line-clamp-1 text-[10px] font-semibold md:text-sm">BY
                                    {{ strtoupper($video->uploader->name ?? 'ADMIN') }}</p>
                            </div>

                            <div>
                                <div class="mb-1 w-fit rounded-[3px] bg-[#D6111A] px-5 py-1.5">
                                    <span
                                        class="text-xs font-medium text-white">{{ $video->category->name ?? 'Video' }}</span>
                                </div>

                                <h1
                                    class="mb-1 line-clamp-2 text-[19px] font-semibold text-white transition-colors group-hover:text-gray-300">
                                    {{ $video->title }}
                                </h1>

                                <div class="mt-3 flex items-center gap-x-4">
                                    <div class="flex items-center gap-x-2">
                                        <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
                                        <span class="text-[10px] font-semibold text-white">
                                            {{ strtoupper($video->published_at ? $video->published_at->format('d M Y') : $video->created_at->format('d M Y')) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-x-1.5">
                                        <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                                        <span
                                            class="text-[10px] font-semibold text-white">{{ $video->views ?? '0' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="h-131.25 flex w-full items-center justify-center bg-[#1F1D5E]">
                    <p class="text-sm text-white">Belum ada video saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
