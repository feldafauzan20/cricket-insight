<div
    class="not-first:pt-2 lg:not-first:pt-5 not-last:pb-2 lg:not-last:pb-5.5 flex gap-x-4 border-b border-b-[#C7C7C7] px-6 last:border-b-0 md:mx-1.5 md:px-0 lg:mx-5">
    <div class="w-29 h-18 lg:w-66.25 lg:h-41 2xl:w-29 2xl:h-18 overflow-hidden rounded-[3px]">
        {{-- <img src="{{ asset('images/dummy/popular-recent-news/dummy-popular-recent-news.webp') }}"
            alt=" Popular and Recent News Image" class="w-full h-full object-cover" loading="lazy"> --}}
        <img src="https://placehold.co/400x300" alt=" Popular and Recent News Image" class="h-full w-full object-cover"
            loading="lazy">
    </div>
    <div class="flex w-full flex-col">
        <div class="md:w-42 lg:mb-1 lg:mt-2.5 lg:w-full 2xl:mt-0">
            <h1 class="text-[13px] font-semibold text-[#121212] dark:text-white">
                {{ Str::words('Garuda Gentlemen, triumphed in the thrilling match against the formidable opponents', 3, '...') }}
            </h1>
        </div>
        <div class="flex h-full items-end gap-x-4 lg:items-start">
            <div class="flex gap-x-2">
                <x-letsicon-time-atack class="h-2.5 w-2.5 text-[#EC0226]" />
                <span class="text-[10px] font-semibold text-[#666]">19 JAN 2026</span>
            </div>
            <div class="flex gap-x-1.5">
                <x-bi-eye class="h-2.5 w-2.5 text-[#EC0226]" />
                <span class="text-[10px] font-semibold text-[#666]">1.2K</span>
            </div>
        </div>
    </div>
</div>
