@props(['icon' => 'ri-global-line', 'category', 'categoryValue' => null, 'iconColor' => '#EC0226'])

<div
    {{ $attributes->merge(['class' => 'rounded-[3px] shadow-md w-fit p-2 border border-[#E0E0E0] dark:border-[#171717] dark:bg-[#353434] flex items-center gap-x-2 cursor-pointer']) }}>
    <div class="flex items-center gap-x-0.75">
        <x-dynamic-component :component="$icon" class="w-6 h-6" style="color: {{ $iconColor }}" />
        <p class="text-[#121212] dark:text-white text-[15px]">{{ $category }}</p>
    </div>
    @if ($categoryValue)
        <div class="rounded-full px-3.25" style="background-color: {{ $iconColor }}30">
            <p class="text-[15px] font-normal" style="color: {{ $iconColor }}">{{ $categoryValue }}</p>
        </div>
    @endif
    <div>
        <x-ri-arrow-down-s-line class="w-3 h-3" style="color: {{ $iconColor }}" />
    </div>

</div>
