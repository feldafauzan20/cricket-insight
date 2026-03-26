@props([
    'title' => 'Gallery Title',
    'description' => 'Description',
    'imageUrl' => 'images/dummy/gallery/dummy-gallery.webp',
    'year' => '2023',
    'views' => 0,
])

<div class="md:flex md:flex-col md:items-stretch">
    <div class="overflow-hidden h-54.75 lg:h-86.75 rounded-t-[5px]">
        <img src="{{ asset($imageUrl) }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>
    <div class="py-6.25 px-7.5 border-x border-[#EFEFEF] border-b rounded-b-[5px]">
        <h1 class="text-[#121212] dark:text-white font-semibold mb-2">{{ $title }}</h1>
        <p class="text-[#666] dark:text-[#989292] text-[11px] mb-2">{{ $description }}</p>
        <div class="flex items-center gap-x-1.25">
            <x-bi-eye class="w-3.75 h-3.75 text-[#EC0226]" />
            <span class="text-[11px] text-[#666] dark:text-[#989292]">Viewed {{ $views }} Times</span>
        </div>
        <div class="h-px bg-[#EFEFEF] my-3.75"></div>
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-x-2.5">
                <span class="text-[#666] dark:text-[#989292] text-[11px] font-medium">YEAR:</span>
                <p class="text-[#232323] dark:text-white font-semibold text-[17px]">{{ $year }}</p>
            </div>
            <div class="rounded-[3px] bg-[#232323] dark:bg-[#353434] py-2 px-3.25">
                <a href="" class="text-[#EC0226] text-[11px] font-medium">VIEW <span
                        class="text-white">ALBUM</span></a>
            </div>
        </div>
    </div>
</div>
