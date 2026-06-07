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

@if($latestCommentary)
        <div>
            <a href="{{ url('/news/' . $latestCommentary->slug) }}" class="block group">
                <div class="w-full h-50 md:h-70 lg:h-80 2xl:h-96 rounded-[3px] overflow-hidden mb-4 md:mb-5">
                    <img src="{{ $latestCommentary->thumbnail ? asset('storage/' . $latestCommentary->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-1.webp') }}" 
                        alt="{{ $latestCommentary->title }}" loading="lazy" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
            </a>
        
        <div>
            <p class="text-[13px] md:text-sm font-semibold text-[#666] dark:text-[#B2B2B2] mb-2 md:mb-4">
                {{ $latestCommentary->category ? $latestCommentary->category->name : 'Commentaries' }}
            </p>
            
            <a href="{{ url('/news/' . $latestCommentary->slug) }}" class="block group">
                <h1 class="text-[#121212] dark:text-white font-semibold text-lg md:text-[20px] leading-[130%] mb-2 md:mb-4 group-hover:text-gray-500 transition-colors line-clamp-2">
                    {{ Str::words($latestCommentary->title, 8, '...') }}
                </h1>
            </a>
            
            <div class="w-57 md:w-67.25 lg:h-fit flex justify-between items-center mb-7 2xl:mb-0">
                <div class="flex items-center text-[#121212] dark:text-white gap-x-2.5">
                    <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-gray-200 dark:border-gray-700">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                            class="w-full h-full object-cover">
                    </div>
                    <p class="font-semibold text-[10px] md:text-sm line-clamp-1">
                        <span class="font-normal">By </span>{{ $latestCommentary->uploader ? $latestCommentary->uploader->name : 'Admin' }}
                    </p>
                </div>
                
                <div class="flex items-center gap-x-2 text-[#121212] dark:text-white shrink-0">
                    <x-letsicon-time-atack class="w-5 h-5" />
                    <span class="font-medium text-[10px] md:text-[13px]">
                        {{ strtoupper($latestCommentary->published_at ? $latestCommentary->published_at->format('d M Y') : $latestCommentary->created_at->format('d M Y')) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="w-full py-10 text-center">
        <p class="text-gray-500 font-medium">Belum ada commentaries saat ini.</p>
    </div>
@endif