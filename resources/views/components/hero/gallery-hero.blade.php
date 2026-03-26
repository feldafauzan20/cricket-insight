<div class="relative overflow-hidden pt-33.25 lg:pt-37 pb-10 md:pb-5 dark:bg-[#171717]">
    {{-- BACKGROUND IMAGE --}}
    <img src="{{ asset('images/dummy/dummy-editor-choices.webp') }}" alt="Gallery Hero Background"
        class="absolute inset-0 w-full h-full object-cover z-20" loading="eager" fetchpriority="high">

    {{-- CONTENT --}}
    <div class="relative mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-3.25 md:mb-3.75 z-30">
        <x-bread-crumb :items="[['title' => 'Home', 'url' => '/'], ['title' => 'Gallery', 'url' => '/gallery']]" />
    </div>
</div>
