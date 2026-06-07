@props([
    'news',
    'trendingNumber' => '1',
    'height' => 'h-auto',
    'fontSize' => 'text-[32px]',
])

@php
    use Illuminate\Support\Str;

    $image = $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('images/dummy/trending-card/dummy-trending-card-' . $trendingNumber . '.webp');
    $title = $news->title;
    $author = $news->uploader ? $news->uploader->name : 'Admin';
    $date = strtoupper($news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y'));
    
    $wordCount = str_word_count(strip_tags($news->content ?? ''));
    $timeRead = max(1, ceil($wordCount / 200));
@endphp

<a href="{{ url('/news/' . $news->slug) }}" class="relative w-full {{ $height }} p-4 rounded-[3px] overflow-hidden block group">
    
    <!-- Background Image -->
    <img src="{{ $image }}" alt="{{ $title }}" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black w-full"></div>

    {{-- Content --}}
    <div class="relative flex flex-col justify-between h-full">
        
        <!-- Label Trending Number -->
        <div class="bg-white/20 px-3.5 py-1 rounded-full w-fit border-2 border-white/20 backdrop-blur-sm">
            <span class="text-white font-semibold text-[13px]">#{{ $trendingNumber }} Trending</span>
        </div>
        
        <div>
            <!-- Time Read Otomatis -->
            <p class="text-[#A2A6A9] font-medium text-[10px] leading-[129.4%] tracking-[-3%] mb-2">
                {{ $timeRead }} Min read
            </p>
            
            <!-- Judul -->
            <div class="md:w-3/5 md:max-w-sm">
                <h1 class="font-playfair-display font-bold {{ $fontSize }} text-white mb-2 group-hover:text-gray-200 transition-colors">
                    {{ Str::words($title, 8, '...') }}
                </h1>
            </div>
            
            <!-- Author & Date -->
            <div class="w-57 lg:h-fit flex justify-between items-center mt-4">
                <div class="flex items-center text-white gap-x-2.5">
                    <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-white/30">
                        {{-- Bisa diganti dengan foto profil user jika nanti ada di database --}}
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="{{ $author }}" class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px] line-clamp-1"><span class="font-normal">By </span>{{ $author }}</p>
                </div>
                
                <div class="flex items-center gap-x-2 text-[#A2A6A9] shrink-0">
                    <x-letsicon-time-atack class="w-4 h-4" />
                    <span class="font-semibold text-[10px]">{{ $date }}</span>
                </div>
            </div>
            
        </div>
    </div>
</a>