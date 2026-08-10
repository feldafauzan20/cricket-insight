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

@if ($latestCommentary)
    <div>
        <a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $latestCommentary->slug]) }}" class="group block">
            <div class="h-50 md:h-70 mb-4 w-full overflow-hidden rounded-[3px] md:mb-5 lg:h-80 2xl:h-96">
                <img src="{{ $latestCommentary->thumbnail ? asset('storage/' . $latestCommentary->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-1.webp') }}"
                    alt="{{ $latestCommentary->title }}" loading="lazy"
                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
            </div>
        </a>

        <div>
            <p class="mb-2 text-[13px] font-semibold text-[#666] md:mb-4 md:text-sm dark:text-[#B2B2B2]">
                {{ $latestCommentary->category ? $latestCommentary->category->name : 'Commentaries' }}
            </p>

            <a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $latestCommentary->slug]) }}" class="group block">
                <h1
                    class="mb-2 line-clamp-2 text-lg font-semibold leading-[130%] text-[#121212] transition-colors group-hover:text-gray-500 md:mb-4 md:text-[20px] dark:text-white">
                    {{ Str::words($latestCommentary->title, 8, '...') }}
                </h1>
            </a>

            <div class="w-57 md:w-67.25 mb-7 flex items-center justify-between lg:h-fit 2xl:mb-0">
                <div class="flex items-center gap-x-2.5 text-[#121212] dark:text-white">
                    <div
                        class="h-9 w-9 shrink-0 overflow-hidden rounded-full border border-gray-200 dark:border-gray-700">
                        <img src="{{ $latestCommentary->uploader?->avatar_url ?? asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                            alt="Profile Picture" class="h-full w-full object-cover">
                    </div>
                    <p class="line-clamp-1 text-[10px] font-semibold md:text-sm">
                        <span class="font-normal">By
                        </span>{{ $latestCommentary->uploader ? $latestCommentary->uploader->name : 'Admin' }}
                    </p>
                </div>

                <div class="flex shrink-0 items-center gap-x-2 text-[#121212] dark:text-white">
                    <x-letsicon-time-atack class="h-5 w-5" />
                    <span class="text-[10px] font-medium md:text-[13px]">
                        {{ strtoupper($latestCommentary->published_at ? $latestCommentary->published_at->format('d M Y') : $latestCommentary->created_at->format('d M Y')) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="w-full py-10 text-center">
        <p class="font-medium text-gray-500">Belum ada commentaries saat ini.</p>
    </div>
@endif
