@props(['news'])

<a href="{{ url('/news/' . $news->slug) }}" class="relative h-61.75 md:h-85.25 rounded-md overflow-hidden block group">
    
    <img src="{{ $news->thumbnail ? asset('storage/' . $news->thumbnail) : asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}" 
         alt="{{ $news->title }}" width="1920" height="1080" loading="lazy" 
         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

    <div class="absolute inset-0 bg-linear-to-b from-black/0 via-black/20 to-black w-full"></div>

    {{-- Content --}}
    <div class="relative h-full px-3 pb-3 flex flex-col justify-end">
        <div class="h-fit w-full flex justify-between items-center mb-1.5">
            <div class="w-58.75">
                <h1 class="font-semibold text-lg text-white group-hover:text-gray-200 transition-colors line-clamp-2">
                    {{ \Illuminate\Support\Str::words($news->title, 8, '...') }}
                </h1>
            </div>
            <div class="w-7.5 h-7.5 shrink-0 bg-white rounded-full flex items-center justify-center transition-transform duration-300 group-hover:-rotate-45">
                <x-fas-arrow-right class="w-3 h-3 text-black" />
            </div>
        </div>

        <p class="text-white/90 text-[10px] leading-[129.4%] tracking-[-3%] mb-5.5 line-clamp-3">
            {{ \Illuminate\Support\Str::words(strip_tags($news->description ?? $news->content), 20, '...') }}
        </p>

        <div class="flex justify-between items-center">
            <div class="flex items-center gap-x-2">
                <x-letsicon-time-atack class="w-4 h-4 text-white" />
                <span class="font-semibold text-[13px] text-white">
                    {{ strtoupper($news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y')) }}
                </span>
            </div>
            
            <div class="bg-white/20 py-1 px-3.5 rounded-full backdrop-blur-sm">
                <p class="text-[13px] font-semibold text-white">
                    {{ $news->category ? $news->category->name : 'Berita Utama' }}
                </p>
            </div>
        </div>
    </div>
</a>