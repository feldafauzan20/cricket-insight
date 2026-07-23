@props([
    'items' => ['BALI BASH INTERNATIONAL', 'WOMAN BALI BASH INTERNATIONAL'],
])

<div class="py-19.75 relative w-full overflow-hidden border border-[#B6B6B6] dark:border-white/30"
    x-init="$store.darkMode.init()">
    {{-- Diagonal stripe background --}}
    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-light.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:hidden dark:opacity-5">
    <img src="{{ asset('images/background-image-abstract/bg-img-marquee-bbi-wbbi-dark.webp') }}" alt="Marquee Background"
        width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover opacity-10 dark:block dark:opacity-5">

    <div
        class="relative flex w-max animate-[marquee_28s_linear_infinite] items-center whitespace-nowrap hover:[animation-play-state:paused]">
        @for ($set = 0; $set < 2; $set++)
            <div class="flex items-center" @if ($set === 1) aria-hidden="true" @endif>
                @foreach ($items as $item)
                    <span
                        class="font-figtree mx-5 text-[56px] font-bold uppercase tracking-[-0.05em] text-[#434343] dark:text-white">
                        {{ $item }}
                    </span>
                    <x-icons.sun-star class="h-13.25 w-13.25 shrink-0" />
                @endforeach
            </div>
        @endfor
    </div>
</div>
