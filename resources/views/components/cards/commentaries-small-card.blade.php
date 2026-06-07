@props(['commentary'])

@php
    use App\Models\Article;
    use Illuminate\Support\Str;

    $latestCommentary = Article::with(['category', 'uploader'])
        ->whereHas('category', function ($query) {
            $query->where('slug', 'commentaries');
        })
        ->where('status', 'published')
        ->inRandomOrder()
        ->first();
@endphp

<a href="{{ url('/news/' . $latestCommentary->slug) }}" class="block group">
    <div class="py-5 border-b border-b-[#DEDEDE] 2xl:mr-15 transition-colors hover:bg-gray-50 dark:hover:bg-[#1a1a1a] rounded-md px-2 -mx-2">
        <div class="flex gap-x-10 items-stretch">
            
            {{-- Thumbnail Kecil --}}
            <div class="w-25 h-25 overflow-hidden rounded-[3px] shrink-0">
                <img src="{{ $latestCommentary->thumbnail ? asset('storage/' . $latestCommentary->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
                    alt="{{ $latestCommentary->title }}" loading="lazy" 
                    class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
            </div>
            
            <div class="w-full flex flex-col justify-center">
                {{-- Tanggal --}}
                <div class="flex items-center gap-x-2 text-[#666666] dark:text-[#B2B2B2] mb-1">
                    <x-letsicon-time-atack class="w-5 h-5" />
                    <span class="font-medium text-[10px] md:text-sm">
                        {{ strtoupper($latestCommentary->published_at ? $latestCommentary->published_at->format('d M Y') : $latestCommentary->created_at->format('d M Y')) }}
                    </span>
                </div>
                
                {{-- Judul --}}
                <h1 class="text-[#121212] dark:text-white font-semibold text-[16px] md:text-[15px] leading-[130%] mb-1 2xl:mb-3.5 group-hover:text-[#EC0226] transition-colors">
                    {{ Str::words($latestCommentary->title, 8, '...') }}
                </h1>
                
                {{-- Profil Penulis --}}
                <div class="flex items-center text-[#666] dark:text-[#B2B2B2] gap-x-2.5 mt-auto">
                    <div class="w-5 h-5 rounded-full overflow-hidden shrink-0 border border-gray-200 dark:border-gray-600">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px] md:text-sm line-clamp-1">
                        <span class="font-normal">By </span>{{ $latestCommentary->uploader ? $latestCommentary->uploader->name : 'Admin' }}
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</a>