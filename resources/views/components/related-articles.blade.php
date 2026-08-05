<div class="px-6 md:px-7.5 lg:px-10 2xl:px-0 2xl:container 2xl:mx-auto pt-6 pb-4 md:pb-6 lg:pb-11 2xl:pb-6 md:pt-12.5">
    <div class="md:flex items-center justify-between">
        <div>
            <h1 class="font-semibold text-2xl md:text-[22px] text-[#121212] dark:text-white">Related Articles</h1>
        </div>
        <div class="gap-x-1.5 hidden md:flex">
            <x-buttons.previous-button class="latest-news-button-prev" />
            <x-buttons.next-button class="latest-news-button-next" />
        </div>
    </div>
    <div class="flex my-4 md:my-0 md:mt-4 md:mb-8">
        <div class="w-48.5 2xl:w-91 h-px bg-[#EC0226]"></div>
        <div class="w-full h-px bg-[#C7C7C7]"></div>
    </div>
    <div class="flex gap-x-1 mb-4 md:hidden">
        <x-buttons.previous-button class="latest-news-button-prev" />
        <x-buttons.next-button class="latest-news-button-next" />
    </div>
    <div class="swiper latest-news-swiper overflow-hidden">
        <div class="swiper-wrapper">
            @forelse ($articles as $article)
                <div class="swiper-slide w-88.5!">
                    <x-cards.related-article-card :article="$article" />
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">No related articles available.</p>
            @endforelse
        </div>
    </div>
</div>
