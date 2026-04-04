@props([
    'header' => 'Interview',
    'description' => 'Get the latest news and updates on cricket matches, players, and teams.',
])

<div class="md:mb-5.5 lg:mb-7.5 mb-5">
    <h1 class="text-2xl font-semibold text-[#121212] dark:text-white">{{ $header }}</h1>
    <p class="text-sm text-[#666666]">{{ $description }}</p>
    <div class="lg:mt-3.75 mt-5 flex">
        <div class="w-17.5 lg:w-48.5 h-px bg-[#EC0226]"></div>
        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
    </div>
</div>
