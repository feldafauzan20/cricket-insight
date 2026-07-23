@props([
    'items' => ['BALI BASH INTERNATIONAL', 'WOMAN BALI BASH INTERNATIONAL'],
])

<div class="w-full overflow-hidden">
    <div
        class="flex w-max animate-[marquee_28s_linear_infinite] items-center whitespace-nowrap hover:[animation-play-state:paused]">
        @for ($set = 0; $set < 2; $set++)
            <div class="flex items-center" @if ($set === 1) aria-hidden="true" @endif>
                @foreach ($items as $item)
                    <span
                        class="font-figtree mx-5 text-[100px] font-bold uppercase tracking-[-0.05em] text-[#434343]/10 dark:text-white/5">
                        {{ $item }}
                    </span>
                @endforeach
            </div>
        @endfor
    </div>
</div>
