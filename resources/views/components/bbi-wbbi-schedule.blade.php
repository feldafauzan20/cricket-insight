@props(['setting' => null])

@php
    $title = $setting?->latest_bbi_title ?? 'BALI BASH INTERNATIONAL';
    $date = $setting?->latest_bbi_date ?? 'May 20, 2026';
    $description = $setting?->latest_bbi_description ?? '';
    $link1 = $setting?->latest_bbi_livestream_link_1 ?? '#';
    $link2 = $setting?->latest_bbi_livestream_link_2 ?? '#';

@endphp

<div class="2xl:relative 2xl:flex">
    <div class="md:gap-x-4.25 2xl:gap-x-10.75 md:mb-14 md:flex md:items-center 2xl:mb-0">
        <div
            class="h-150.25 2xl:h-155 mb-12.5 2xl:w-95 relative flex items-center justify-center overflow-hidden rounded-2xl md:mb-0 md:flex-1 2xl:flex-none">
            <img src="{{ asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}" alt="Hero Image"
                width="1920" height="1080" loading="lazy" fetchpriority="high"
                class="absolute inset-0 h-full w-full object-cover">

            {{-- Overlay --}}
            <div class="absolute inset-0 w-full bg-black/70"></div>

            {{-- Content --}}
            <div class="h-55.25 relative">
                <img src="{{ asset('images/logo/cricket-insight-bali-bash-logo-2.webp') }}" alt="Bali Bash Logo"
                    class="h-full w-full object-cover">
            </div>
        </div>
        <div
            class="h-136 2xl:h-145.5 mb-12.5 md:w-81.75 2xl:w-90 relative flex items-center justify-center overflow-hidden rounded-2xl md:mb-0">
            <img src="{{ asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}" alt="Hero Image"
                width="1920" height="1080" loading="lazy" fetchpriority="high"
                class="absolute inset-0 h-full w-full object-cover">

            {{-- Overlay --}}
            <div class="absolute inset-0 w-full bg-black/70"></div>
        </div>
    </div>

    <div
        class="2xl:w-191.75 2xl:pb-4.5 2xl:mb-4.75 2xl:right-30 2xl:absolute 2xl:bottom-0 2xl:rounded-tl-[50px] 2xl:bg-white 2xl:py-10 2xl:pl-20 dark:bg-[#1F2022]">
        <h1
            class="font-barlow-semi-condensed mb-6.25 md:mb-7.5 text-2xl font-bold uppercase text-[#434343] md:text-[54px] dark:text-white">
            {{ $title }}
        </h1>
        <div>
            <div class="md:gap-x-8.75 md:mb-7.5 md:flex md:items-center">
                <div
                    class="p-4.5 mb-3.75 w-fit rounded-md border border-dashed border-black/30 md:mb-0 dark:border-white/30">
                    <div class="w-17.5 h-17.5 flex items-center justify-center text-[#B90F16] dark:text-[#97775B]">
                        <svg viewBox="0 0 32 32" fill="none" class="h-12.5 w-12.5"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.2083 27.25H6.83333C5.28624 27.25 3.80251 26.6354 2.70854 25.5415C1.61458 24.4475 1 22.9638 1 21.4167V8.29167C1 6.74457 1.61458 5.26084 2.70854 4.16688C3.80251 3.07291 5.28624 2.45833 6.83333 2.45833H22.875C24.4221 2.45833 25.9058 3.07291 26.9998 4.16688C28.0938 5.26084 28.7083 6.74457 28.7083 8.29167V12.6667M9.75 1V3.91667M19.9583 1V3.91667M1 9.75H28.7083M25.0625 20.896L22.875 23.0835"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M22.8776 30.1673C26.9047 30.1673 30.1693 26.9027 30.1693 22.8757C30.1693 18.8486 26.9047 15.584 22.8776 15.584C18.8505 15.584 15.5859 18.8486 15.5859 22.8757C15.5859 26.9027 18.8505 30.1673 22.8776 30.1673Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                </div>
                <div>
                    <p
                        class="font-barlow-semi-condensed text-[26px] font-bold uppercase text-[#434343] dark:text-white">
                        {{ $date }}</p>

                    <p class="font-figtree w-51.25 mb-6.25 block font-medium tracking-[-0.05em] text-[#969696]">
                        {{ $description }} </p>
                </div>
            </div>
            <a href="{{ $link1 }}" target="_blank" class="mb-7.5 md:w-125 block">
                <div class="mb-3.75 flex justify-between">
                    <p class="font-barlow-semi-condensed text-xl font-bold uppercase text-[#434343] dark:text-white">
                        link streaming 1
                    </p>
                    <div class="text-[#434343] dark:text-white">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.4 18L5 16.6L14.6 7H6V5H18V17H16V8.4L6.4 18Z" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <div class="flex">
                    <div class="h-0.75 w-69 md:w-106.25 bg-[#B90F16] dark:bg-[#97775B]"></div>
                    <div class="h-0.75 flex-1 bg-[#A6A182]/20"></div>
                </div>
            </a>
            <a href="{{ $link2 }}" target="_blank" class="md:w-125 md:block">
                <div class="mb-3.75 flex justify-between">
                    <p class="font-barlow-semi-condensed text-xl font-bold uppercase text-[#434343] dark:text-white">
                        link streaming 2
                    </p>
                    <div class="text-[#434343] dark:text-white">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.4 18L5 16.6L14.6 7H6V5H18V17H16V8.4L6.4 18Z" fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <div class="flex">
                    <div class="h-0.75 md:w-114.25 w-[320px] bg-[#B90F16] dark:bg-[#97775B]"></div>
                    <div class="h-0.75 flex-1 bg-[#A6A182]/20"></div>
                </div>
            </a>
        </div>
    </div>
</div>
