<div>
    <div class="2xl:flex 2xl:justify-between">
        <div class="md:mb-15 mb-5">
            <a href="/" class="mr-11 text-xl font-bold">
                {{-- Light mode logo --}}
                <img src="{{ asset('images/logo/cricket-insight-bali-bash-logo-black.webp') }}" alt="cricket insight logo"
                    class="w-36.75 mb-5 h-auto object-cover md:mb-10 dark:hidden" loading="lazy">
                {{-- Dark mode logo --}}
                <img src="{{ asset('images/logo/cricket-insight-bali-bash-logo-white.webp') }}" alt="cricket insight logo"
                    class="w-36.75 mb-5 hidden h-auto object-cover md:mb-10 dark:block" loading="lazy">
                {{-- <img src="https://placehold.co/150x40" alt="cricket insight logo"
                    class="w-36.75 mb-5 h-auto object-cover md:mb-10" loading="lazy"> --}}
            </a>
            <div class="md:w-92.25">
                <p class="leading-[130%] text-[#AEB0B4] dark:text-[#EEEEEE]">Home of Indonesian cricket, where talent
                    grows and the
                    nation competes with
                    pride.</p>
            </div>
        </div>
        <div class="md:gap-x-25 md:mb-12.5 lg:w-159.5 mb-6 md:flex">
            <div class="md:w-140 mb-5 md:mb-0">
                <h1 class="mb-7 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Index</h1>
                <div class="grid grid-cols-2">
                    <ul class="flex flex-col gap-y-3 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                        <li><a href="/"
                                class="{{ request()->is('/') ? 'text-red-500' : '' }} transition hover:text-red-500">Home</a>
                        </li>
                        <li><a href="/news"
                                class="{{ request()->is('news*') ? 'text-red-500' : '' }} transition hover:text-red-500">News</a>
                        </li>
                        <li><a href="/interview"
                                class="{{ request()->is('interview') ? 'text-red-500' : '' }} transition hover:text-red-500">Interview</a>
                        </li>
                        <li><a href="/tournaments"
                                class="{{ request()->is('tournaments') ? 'text-red-500' : '' }} transition hover:text-red-500">Tournaments</a>
                        </li>
                    </ul>
                    <ul class="flex flex-col gap-y-3 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                        <li><a href="/match-centre"
                                class="{{ request()->is('match-centre') ? 'text-red-500' : '' }} transition hover:text-red-500">Match
                                Centre</a></li>
                        <li><a href="/bbi-wbbi"
                                class="{{ request()->is('bbi-wbbi') ? 'text-red-500' : '' }} transition hover:text-red-500">BBI/WBBI</a>
                        </li>
                        <li><a href="/archive"
                                class="{{ request()->is('archive*') ? 'text-red-500' : '' }} transition hover:text-red-500">Archive</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="mb-4 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Download now
                </h2>
                <div>
                    <p class="mb-4 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Get the Indonesian Cricket
                        Association mobile
                        application
                        via Google Play Store or
                        Apple
                        App Store</p>
                </div>
                <div class="flex gap-x-5">
                    <a href="YOUR_APP_STORE_URL" target="_blank" rel="noopener">
                        {{-- <img src="{{ asset('images/badges/app-store-badge.svg') }}" alt="Download on App Store"
                            loading="lazy" class="h-10"> --}}
                        <img src="https://placehold.co/135x40" alt="Download on App Store" loading="lazy"
                            class="h-10">
                    </a>
                    <a href="YOUR_PLAY_STORE_URL" target="_blank" rel="noopener">
                        {{-- <img src="{{ asset('images/badges/google-play-store-badge.svg') }}" alt="Get it on Google Play"
                            loading="lazy" class="h-10"> --}}
                        <img src="https://placehold.co/135x40" alt="Get it on Google Play" loading="lazy"
                            class="h-10">
                    </a>
                </div>
            </div>
        </div>
        <div>
            <h3 class="mb-5.5 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Subscribe</h3>
            <div class="mb-5.5 md:w-[256px]">
                <p class="leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Join our newsletter and be part of a world
                    full of art.</p>
            </div>
            <form class="flex justify-between border-b-2 border-[#E8E8E8] pb-2.5 dark:border-[#333]">
                <input type="email" placeholder="Enter your email" required
                    class="placeholder:font-medium placeholder:leading-[130%] placeholder:text-[#CFCECE] focus:outline-none dark:text-[#EEEEEE] dark:placeholder:text-[#B2B2B2]">
                <button type="submit"
                    class="font-semibold leading-[130%] text-[#121212] hover:cursor-pointer dark:text-[#EEEEEE]">Submit</button>
            </form>
        </div>
    </div>
    <div
        class="lg:pb-5.5 pb-10 md:flex md:items-center md:justify-between md:pt-8 2xl:border-t-2 2xl:border-t-[#E8E8E8] 2xl:pt-6 dark:border-t-[#EEEEEE]">
        <div>
            <p class="my-3.5 text-xs leading-[129%] text-[#121212] md:my-0 2xl:text-sm dark:text-[#EEEEEE]">PCI –
                Indonesian Cricket
                Association © 2025
                •
                All Rights
                Reserved</p>
        </div>
        <div class="mt-3 flex items-center gap-x-6 md:mt-0">
            <a href=""><x-fab-x-twitter class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-facebook class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-instagram class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
        </div>
    </div>
</div>
