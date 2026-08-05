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

@if ($latestCommentary)
    <a href="{{ route('news.show', ['locale' => app()->getLocale(), 'slug' => $latestCommentary->slug]) }}" class="group block">
        <div
            class="2xl:mr-15 -mx-2 rounded-md border-b border-b-[#DEDEDE] px-2 py-5 transition-colors hover:bg-gray-50 dark:hover:bg-[#1a1a1a]">
            <div class="flex items-stretch gap-x-10">
                <div class="w-25 h-25 shrink-0 overflow-hidden rounded-[3px]">
                    <img src="{{ $latestCommentary->thumbnail ? asset('storage/' . $latestCommentary->thumbnail) : asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
                        alt="{{ $latestCommentary->title }}" loading="lazy"
                        class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                </div>

                <div class="flex w-full flex-col justify-center">
                    <div class="mb-1 flex items-center gap-x-2 text-[#666666] dark:text-[#B2B2B2]">
                        <x-letsicon-time-atack class="h-5 w-5" />
                        <span class="text-[10px] font-medium md:text-sm">
                            {{ strtoupper($latestCommentary->published_at ? $latestCommentary->published_at->format('d M Y') : $latestCommentary->created_at->format('d M Y')) }}
                        </span>
                    </div>

                    <h1
                        class="mb-1 text-[16px] font-semibold leading-[130%] text-[#121212] transition-colors group-hover:text-[#EC0226] md:text-[15px] 2xl:mb-3.5 dark:text-white">
                        {{ Str::words($latestCommentary->title, 8, '...') }}
                    </h1>

                    <div class="mt-auto flex items-center gap-x-2.5 text-[#666] dark:text-[#B2B2B2]">
                        <div
                            class="h-5 w-5 shrink-0 overflow-hidden rounded-full border border-gray-200 dark:border-gray-600">
                            <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                alt="Profile Picture" class="h-full w-full object-cover">
                        </div>
                        <p class="line-clamp-1 text-[10px] font-semibold md:text-sm">
                            <span
                                class="font-normal">By</span>{{ $latestCommentary->uploader ? $latestCommentary->uploader->name : 'Admin' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </a>
@else
    <div class="rounded-md border-b border-b-[#DEDEDE] px-2 py-5 text-sm text-gray-500 dark:text-gray-400">
        No commentary available.
    </div>
@endif
