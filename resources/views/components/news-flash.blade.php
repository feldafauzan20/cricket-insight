<div
    class="flex items-center overflow-hidden bg-white dark:bg-transparent shadow-sm border border-gray-200 dark:border-[#1F1F1F]">
    <!-- NEWS FLASH Badge -->
    <div class="shrink-0 bg-[#EC0226] px-3.5 py-1.5 my-1.5 ml-1.5 my flex items-center gap-1 rounded-[5px]">
        <x-eva-flash-outline class="w-6 h-6 text-white font-semibold" />
        <span class="text-white font-semibold text-sm uppercase tracking-wide whitespace-nowrap">News Flash</span>
    </div>

    <!-- Scrolling News Content -->
    <div class="flex-1 overflow-hidden relative">
        <!-- Left gradient -->
        <div
            class="absolute left-0 top-0 bottom-0 w-15 bg-linear-to-r from-white dark:from-[#121212] to-transparent dark:to-[#1F1F1F]/0 z-10 pointer-events-none">
        </div>

        <!-- Scrolling text -->
        <div class="animate-marquee inline-block whitespace-nowrap py-2 px-4">
            <span class="text-gray-700 dark:text-[#EEEEEE] text-sm">
                {{ $slot ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
            </span>
        </div>

        <!-- Right gradient -->
        <div
            class="absolute right-0 top-0 bottom-0 w-15 bg-linear-to-l from-white dark:from-[#121212] to-transparent dark:to-[#1F1F1F]/0 z-10 pointer-events-none">
        </div>
    </div>
</div>

<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-marquee {
        animation: marquee 20s linear infinite;
    }

    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>
