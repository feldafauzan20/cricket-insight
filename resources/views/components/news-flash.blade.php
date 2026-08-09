<div
    class="flex items-center overflow-hidden border border-gray-200 bg-white shadow-sm dark:border-[#1F1F1F] dark:bg-transparent">
    <!-- NEWS FLASH Badge -->
    <div class="my my-1.5 ml-1.5 flex shrink-0 items-center gap-1 rounded-[5px] bg-[#EC0226] px-3.5 py-1.5">
        <x-eva-flash-outline class="h-6 w-6 font-semibold text-white" />
        <span
            class="whitespace-nowrap text-sm font-semibold uppercase tracking-wide text-white">{{ __('home.news_flash_header') }}</span>
    </div>

    <!-- Scrolling News Content -->
    <div class="relative flex-1 overflow-hidden">
        <!-- Left gradient -->
        <div
            class="w-15 bg-linear-to-r pointer-events-none absolute bottom-0 left-0 top-0 z-10 from-white to-transparent dark:from-[#121212] dark:to-[#1F1F1F]/0">
        </div>

        <!-- Scrolling text -->
        <div class="animate-marquee inline-block whitespace-nowrap px-4 py-2">
            <span class="text-sm text-gray-700 dark:text-[#EEEEEE]">
                {{ $slot ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
            </span>
        </div>

        <!-- Right gradient -->
        <div
            class="w-15 bg-linear-to-l pointer-events-none absolute bottom-0 right-0 top-0 z-10 from-white to-transparent dark:from-[#121212] dark:to-[#1F1F1F]/0">
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
