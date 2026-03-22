@props([
    'dotColor' => '#EC0226',
    'categoryName' => 'Category Name',
])

<div class="rounded-[3px] w-fit shadow-md p-1.75 bg-white border-[0.5px] border-[#E0E0E0] flex items-center gap-x-1.25">
    <div class="w-1 h-1 rounded-full" style="background-color: {{ $dotColor }}"></div>
    <span class="text-xs text-[#121212] dark:text-white">{{ $categoryName }}</span>
</div>
