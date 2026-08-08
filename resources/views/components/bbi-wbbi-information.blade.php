@props(['setting' => null])

@php
    $link1 = $setting?->latest_bbi_livestream_link_1 ?? '#';
    $link2 = $setting?->latest_bbi_livestream_link_2 ?? '#';
@endphp

<div
    class="py-16.25 mx-2.25 gap-7.25 md:mx-12.5 2xl:px-12.5 flex flex-col 2xl:container md:items-center lg:justify-center lg:flex-row 2xl:mx-auto 2xl:justify-between">
    <div class="gap-x-3.75 flex items-center">
        <div class="p-4.5 rounded-md border border-dashed border-black/30 dark:border-white/30">
            <div class="w-8.75 h-8.75 flex items-center justify-center text-[#B90F16] dark:text-[#97775B]">
                <svg width="30" height="18" viewBox="0 0 30 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.06333 0L0 8.75L5.06333 17.5H8.02083L2.9575 8.75L8.02083 0H5.06333ZM14.5833 10.9375C15.1635 10.9375 15.7199 10.707 16.1301 10.2968C16.5404 9.88656 16.7708 9.33016 16.7708 8.75C16.7708 8.16984 16.5404 7.61344 16.1301 7.2032C15.7199 6.79297 15.1635 6.5625 14.5833 6.5625C14.0032 6.5625 13.4468 6.79297 13.0365 7.2032C12.6263 7.61344 12.3958 8.16984 12.3958 8.75C12.3958 9.33016 12.6263 9.88656 13.0365 10.2968C13.4468 10.707 14.0032 10.9375 14.5833 10.9375ZM29.1667 8.75L24.1033 0H21.1458L26.2092 8.75L21.1458 17.5H24.1033L29.1667 8.75ZM9.20937 2.91667L5.83333 8.75L9.20937 14.5833H12.1669L8.79083 8.75L12.1654 2.91667H9.20937ZM23.8335 8.75L20.4575 2.91667H17.5L20.876 8.75L17.5 14.5833H20.4575L23.8335 8.75Z"
                        fill="currentColor" />
                </svg>
            </div>
        </div>
        <a href="{{ $link1 }}" class="w-51 block">
            <p
                class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#434343] dark:text-white">
                LATEST MATCH</p>
            <p class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#969696]">CLICK
                HERE TO SEE OUR LATEST MATCH</p>
        </a>
    </div>
    <div class="gap-x-3.75 flex items-center">
        <div class="p-4.5 rounded-md border border-dashed border-black/30 dark:border-white/30">
            <div class="w-8.75 h-8.75 flex items-center justify-center text-[#B90F16] dark:text-[#97775B]">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
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
        <a href="{{ $link2 }}" class="w-51 block">
            <p
                class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#434343] dark:text-white">
                SCHEDULE</p>
            <p class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#969696]">CLICK
                HERE TO SEE THE NEXT SCHEDULE</p>
        </a>
    </div>
    <div class="gap-x-3.75 flex items-center">
        <div class="p-4.5 rounded-md border border-dashed border-black/30 dark:border-white/30">
            <div class="w-8.75 h-8.75 flex items-center justify-center text-[#B90F16] dark:text-[#97775B]">
                <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.91667 26.25C2.11458 26.25 1.42819 25.9647 0.8575 25.394C0.286806 24.8233 0.000972222 24.1364 0 23.3333V2.91667C0 2.11458 0.285833 1.42819 0.8575 0.8575C1.42917 0.286806 2.11556 0.000972222 2.91667 0H23.3333C24.1354 0 24.8223 0.285833 25.394 0.8575C25.9656 1.42917 26.251 2.11556 26.25 2.91667V23.3333C26.25 24.1354 25.9647 24.8223 25.394 25.394C24.8233 25.9656 24.1364 26.251 23.3333 26.25H2.91667ZM11.6667 17.5H2.91667V23.3333H11.6667V17.5ZM14.5833 17.5V23.3333H23.3333V17.5H14.5833ZM11.6667 14.5833V8.75H2.91667V14.5833H11.6667ZM14.5833 14.5833H23.3333V8.75H14.5833V14.5833ZM2.91667 5.83333H23.3333V2.91667H2.91667V5.83333Z"
                        fill="currentColor" />
                </svg>

            </div>
        </div>
        <a href="{{ $link1 }}" class="w-51 block">
            <p
                class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#434343] dark:text-white">
                LATEST MATCH</p>
            <p class="font-barlow-semi-condensed font-semibold leading-[143.8%] tracking-[-0.05em] text-[#969696]">CLICK
                HERE TO SEE OUR LATEST MATCH</p>
        </a>
    </div>
</div>
