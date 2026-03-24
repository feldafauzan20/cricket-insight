<div
    class="flex gap-x-4 px-6 not-first:pt-2 lg:not-first:pt-5 md:px-0 md:mx-1.5 lg:mx-5 border-b border-b-[#C7C7C7] last:border-b-0 not-last:pb-2 lg:not-last:pb-5.5">
    <div class="w-29 h-18 lg:w-66.25 lg:h-41 2xl:w-29 2xl:h-18 overflow-hidden rounded-[3px]">
        <img src="{{ asset('images/dummy/popular-recent-news/dummy-popular-recent-news.webp') }}"
            alt=" Popular and Recent News Image" class="w-full h-full object-cover" loading="lazy">
    </div>
    <div class="flex flex-col w-full">
        <div class="md:w-42 lg:w-full lg:mb-1 lg:mt-2.5 2xl:mt-0">
            <h1 class="text-[#121212] dark:text-white font-semibold text-[13px]">
                {{ Str::words('Garuda Gentlemen, triumphed in the thrilling match against the formidable opponents', 3, '...') }}
            </h1>
        </div>
        <div class="flex gap-x-4 h-full items-end lg:items-start">
            <div class="flex gap-x-2">
                <x-letsicon-time-atack class="w-2.5 h-2.5 text-[#EC0226]" />
                <span class="font-semibold text-[10px] text-[#666]">19 JAN 2026</span>
            </div>
            <div class="flex gap-x-1.5">
                <x-bi-eye class="w-2.5 h-2.5 text-[#EC0226]" />
                <span class="font-semibold text-[10px] text-[#666]">1.2K</span>
            </div>
        </div>
    </div>
</div>
