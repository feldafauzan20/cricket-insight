@props([
    'image' => '/images/dummy/trending-card/dummy-trending-card-1.jpg',
    'title' => 'PCI has made history by successfully hosting the inaugural cricket tournament in the region',
    'author' => 'FARHAN DUDI',
    'timeRead' => '1',
    'date' => '19 JAN 2026',
    'trendingNumber' => '1',
    'height' => 'h-auto',
    'fontSize' => 'text-[32px]',
])

<div class="relative w-full {{ $height }} p-4 rounded-[3px] overflow-hidden">
    <img src="{{ $image }}" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black w-full"></div>

    {{-- content --}}
    <div class="relative flex flex-col justify-between h-full">
        <div class="bg-white/20 px-3.5 py-1 rounded-full w-fit border-2 border-white/20">
            <span class="text-white font-semibold text-[13px]">#{{ $trendingNumber }} Trending</span>
        </div>
        <div>
            <p class="text-[#A2A6A9] font-medium text-[10px] leading-[129.4%] tracking-[-3%] mb-2">{{ $timeRead }}
                Min read
            </p>
            <div class="md:w-3/5 md:max-w-sm">
                <h1 class="font-playfair-display font-bold {{ $fontSize }} text-white mb-2">
                    {{ Str::words($title, 8, '...') }}
                </h1>
            </div>
            <div class="w-57 lg:h-fit flex justify-between items-center">
                <div class="flex items-center text-white gap-x-2.5">
                    <div class="w-9 h-9 rounded-full overflow-hidden">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.jpg') }}" alt="Profile Picture"
                            class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px]"><span class="font-normal">By </span>{{ $author }}</p>
                </div>
                <div class="flex items-center gap-x-2 text-[#A2A6A9]">
                    <x-letsicon-time-atack class="w-4 h-4" />
                    <span class="font-semibold text-[10px]">{{ $date }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
