@props([
    'title' => 'Gallery Title',
    'description' => 'Description',
    'imageUrl' => null,
    'year' => '2023',
    'views' => 0,
])

@php
    $src = asset('images/dummy/gallery/dummy-gallery.webp');
    if (!empty($imageUrl)) {
        if (str_starts_with($imageUrl, 'http://') || str_starts_with($imageUrl, 'https://')) {
            $src = $imageUrl;
        } elseif (str_starts_with($imageUrl, 'images/')) {
            $src = asset($imageUrl);
        } else {
            $src = asset('storage/' . $imageUrl);
        }
    }
@endphp

<div class="flex h-full flex-col">
    <div class="h-54.75 lg:h-86.75 overflow-hidden rounded-t-[5px]">
        {{-- <img src="{{ asset($imageUrl) }}" alt="{{ $title }}" class="h-full w-full object-cover"> --}}
        <img src="https://placehold.co/600x500" alt="{{ $title }}" class="h-full w-full object-cover">
    </div>
    <div class="py-6.25 px-7.5 flex flex-1 flex-col rounded-b-[5px] border-x border-b border-[#EFEFEF]">
        <h1 class="mb-2 font-semibold text-[#121212] dark:text-white">{{ $title }}</h1>
        <p class="mb-2 text-[11px] text-[#666] dark:text-[#989292]">{{ $description }}</p>
        <div class="gap-x-1.25 flex items-center">
            <x-bi-eye class="w-3.75 h-3.75 text-[#EC0226]" />
            <span class="text-[11px] text-[#666] dark:text-[#989292]">Viewed {{ is_numeric($views) ? number_format($views) : $views }} Times</span>
        </div>
        <div class="mt-auto">
            <div class="my-3.75 h-px bg-[#EFEFEF]"></div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-2.5">
                    <span class="text-[11px] font-medium text-[#666] dark:text-[#989292]">YEAR:</span>
                    <p class="text-[17px] font-semibold text-[#232323] dark:text-white">{{ $year }}</p>
                </div>
                <div class="px-3.25 rounded-[3px] bg-[#232323] py-2 dark:bg-[#353434]">
                    <a href="" class="text-[11px] font-medium text-[#EC0226]">VIEW <span
                            class="text-white">ALBUM</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
