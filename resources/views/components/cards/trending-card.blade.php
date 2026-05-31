@props([
    'image' => '/images/dummy/trending-card/dummy-trending-card-1.webp',
    'title' => 'PCI has made history by successfully hosting the inaugural cricket tournament in the region',
    'author' => 'FARHAN DUDI',
    'timeRead' => '1',
    'date' => '19 JAN 2026',
    'trendingNumber' => '1',
    'height' => 'h-auto',
    'fontSize' => 'text-[32px]',
])

<div class="{{ $height }} relative w-full overflow-hidden rounded-[3px] p-4">
    {{-- <img src="{{ $image }}" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 w-full h-full object-cover"> --}}
    <img src="https://placehold.co/1200x800" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover">

    <!-- Overlay gradient -->
    <div class="bg-linear-to-b absolute inset-0 w-full from-black/0 to-black"></div>

    {{-- content --}}
    <div class="relative flex h-full flex-col justify-between">
        <div class="w-fit rounded-full border-2 border-white/20 bg-white/20 px-3.5 py-1">
            <span class="text-[13px] font-semibold text-white">#{{ $trendingNumber }} Trending</span>
        </div>
        <div>
            <p class="mb-2 text-[10px] font-medium leading-[129.4%] tracking-[-3%] text-[#A2A6A9]">{{ $timeRead }}
                Min read
            </p>
            <div class="md:w-3/5 md:max-w-sm">
                <h1 class="font-playfair-display {{ $fontSize }} mb-2 font-bold text-white">
                    {{ Str::words($title, 8, '...') }}
                </h1>
            </div>
            <div class="w-57 flex items-center justify-between lg:h-fit">
                <div class="flex items-center gap-x-2.5 text-white">
                    <div class="h-9 w-9 overflow-hidden rounded-full">
                        {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="Profile Picture" class="w-full h-full object-cover"> --}}
                        <img src="https://placehold.co/36x36" alt="Profile Picture" class="h-full w-full object-cover">
                    </div>
                    <p class="text-[10px] font-semibold"><span class="font-normal">By </span>{{ $author }}</p>
                </div>
                <div class="flex items-center gap-x-2 text-[#A2A6A9]">
                    <x-letsicon-time-atack class="h-4 w-4" />
                    <span class="text-[10px] font-semibold">{{ $date }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
