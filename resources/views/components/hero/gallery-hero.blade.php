<div class="pt-33.25 lg:pt-37 relative overflow-hidden pb-10 md:pb-5 dark:bg-[#171717]">
    {{-- BACKGROUND IMAGE --}}
    <img src="{{ asset('images/dummy/gallery/bg-gallery-hero.webp') }}" alt="Gallery Hero Background"
        class="absolute inset-0 z-20 h-full w-full object-cover" loading="eager" fetchpriority="high">

    {{-- CONTENT --}}
    <div class="md:mx-7.5 mb-3.25 md:mb-3.75 relative z-30 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
        <x-bread-crumb :items="[['title' => 'Home', 'url' => '/'], ['title' => 'Archive', 'url' => '/archive']]" />
    </div>
</div>
