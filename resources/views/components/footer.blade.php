<div>
    <div class="2xl:flex 2xl:justify-between">
        <div class="mb-5 md:mb-15">
            <a href="/" class="text-xl font-bold mr-11">
                {{-- Light mode logo --}}
                <img src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                    class="w-15.5 h-auto object-cover mb-5 md:mb-10 dark:hidden">
                {{-- Dark mode logo (jika ada versi putih/terang) --}}
                <img src="{{ asset('images/logo/cricket-insight-logo-white.webp') }}" alt="cricket insight logo"
                    class="w-15.5 h-auto object-cover mb-5 md:mb-10 hidden dark:block">
            </a>
            <div class="md:w-92.25">
                <p class="leading-[130%] text-[#121212] dark:text-[#EEEEEE]">Home of Indonesian cricket, where talent
                    grows and the
                    nation competes with
                    pride.</p>
            </div>
        </div>
        <div class="md:flex md:gap-x-25 mb-6 md:mb-12.5 lg:w-159.5">
            <div class="mb-5 md:mb-0 md:w-140">
                <h1 class="text-[#121212] dark:text-[#EEEEEE] font-semibold text-2xl mb-7 leading-[130%]">Index</h1>
                <div class="grid grid-cols-2">
                    <ul class="flex flex-col gap-y-3 text-[#121212] dark:text-[#EEEEEE] leading-[130%]">
                        <li><a href="/"
                                class="hover:text-red-500 transition {{ request()->is('/') ? 'text-red-500' : '' }}">Home</a>
                        </li>
                        <li><a href="/news"
                                class="hover:text-red-500 transition {{ request()->is('news') ? 'text-red-500' : '' }}">News</a>
                        </li>
                        <li><a href="/interview"
                                class="hover:text-red-500 transition {{ request()->is('interview') ? 'text-red-500' : '' }}">Interview</a>
                        </li>
                        <li><a href="/tournaments"
                                class="hover:text-red-500 transition {{ request()->is('tournaments') ? 'text-red-500' : '' }}">Tournaments</a>
                        </li>
                    </ul>
                    <ul class="flex flex-col gap-y-3 text-[#121212] dark:text-[#EEEEEE] leading-[130%]">
                        <li><a href="/match-centre"
                                class="hover:text-red-500 transition {{ request()->is('match-centre') ? 'text-red-500' : '' }}">Match
                                Centre</a></li>
                        <li><a href="/bbi-wbbi"
                                class="hover:text-red-500 transition {{ request()->is('bbi-wbbi') ? 'text-red-500' : '' }}">BBI/WBBI</a>
                        </li>
                        <li><a href="/gallery"
                                class="hover:text-red-500 transition {{ request()->is('gallery') ? 'text-red-500' : '' }}">Gallery</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <h2 class="font-semibold text-2xl mb-4 text-[#121212] dark:text-[#EEEEEE] leading-[130%]">Download now
                </h2>
                <div>
                    <p class="mb-4 text-[#121212] dark:text-[#EEEEEE] leading-[130%]">Get the Indonesian Cricket
                        Association mobile
                        application
                        via Google Play Store or
                        Apple
                        App Store</p>
                </div>
                <div class="flex gap-x-5">
                    <a href="YOUR_APP_STORE_URL" target="_blank" rel="noopener">
                        <img src="{{ asset('images/badges/app-store-badge.svg') }}" alt="Download on App Store"
                            class="h-10">
                    </a>
                    <a href="YOUR_PLAY_STORE_URL" target="_blank" rel="noopener">
                        <img src="{{ asset('images/badges/google-play-store-badge.svg') }}" alt="Get it on Google Play"
                            class="h-10">
                    </a>
                </div>
            </div>
        </div>
        <div>
            <h3 class="font-semibold text-2xl mb-5.5 text-[#121212] dark:text-[#EEEEEE] leading-[130%]">Subscribe</h3>
            <div class="mb-5.5 md:w-[256px]">
                <p class=" text-[#121212] dark:text-[#EEEEEE] leading-[130%]">Join our newsletter and be part of a world
                    full of art.</p>
            </div>
            <form class="flex pb-2.5 justify-between border-b-2 border-[#E8E8E8] dark:border-[#333]">
                <input type="email" placeholder="Enter your email" required
                    class="focus:outline-none placeholder:text-[#CFCECE] placeholder:font-medium placeholder:leading-[130%] dark:text-[#EEEEEE] dark:placeholder:text-[#B2B2B2]">
                <button type="submit"
                    class="text-[#121212] dark:text-[#EEEEEE] leading-[130%] font-semibold hover:cursor-pointer">Submit</button>
            </form>
        </div>
    </div>
    <div
        class="pb-10 md:pt-8 lg:pb-5.5 md:flex md:justify-between md:items-center 2xl:border-t-2 2xl:border-t-[#E8E8E8] dark:border-t-[#EEEEEE] 2xl:pt-6">
        <div>
            <p class="text-[#121212] dark:text-[#EEEEEE] leading-[129%] text-xs 2xl:text-sm my-3.5 md:my-0">PCI –
                Indonesian Cricket
                Association © 2025
                •
                All Rights
                Reserved</p>
        </div>
        <div class="flex items-center gap-x-6 mt-3 md:mt-0">
            <a href=""><x-fab-x-twitter class="w-4 h-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-facebook class="w-4 h-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-instagram class="w-4 h-4 dark:text-[#EEEEEE]" /></a>
        </div>
    </div>
</div>
