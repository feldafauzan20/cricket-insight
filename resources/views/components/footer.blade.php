<div>
    @php
        $currentRoute = Route::currentRouteName();
        $menu = [
            ['route' => 'home', 'label' => __('navbar.home')],
            ['route' => 'news.index', 'label' => __('navbar.news')],
            ['route' => 'interviews.index', 'label' => __('navbar.interview')],
            ['route' => 'tournaments.index', 'label' => __('navbar.tournaments')],
            ['route' => 'matches.index', 'label' => __('navbar.match_centre')],
            ['route' => 'bbi-wbbi', 'label' => __('navbar.bbi_wbbi')],
            ['route' => 'gallery.index', 'label' => __('navbar.archive')],
        ];
    @endphp

    <div class="2xl:flex 2xl:justify-between">
        <div class="md:mb-15 mb-5">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="mr-11 text-xl font-bold">
                <img src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                    class="w-36.75 mb-5 h-auto object-cover md:mb-10 dark:hidden" loading="lazy">
                <img src="{{ asset('images/logo/cricket-insight-logo-white.webp') }}" alt="cricket insight logo"
                    class="w-36.75 mb-5 hidden h-auto object-cover md:mb-10 dark:block" loading="lazy">
            </a>
            <div class="md:w-92.25">
                <p class="leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                    {{ __('footer.tagline') }}
                </p>
            </div>
        </div>

        <div class="md:gap-x-25 md:mb-12.5 lg:w-159.5 mb-6 md:flex">
            <div class="md:w-140 mb-5 md:mb-0">
                <h1 class="mb-7 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                    {{ __('footer.index_heading') }}
                </h1>
                <div class="grid grid-cols-2">
                    <ul class="flex flex-col gap-y-3 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                        @foreach (array_slice($menu, 0, 4) as $item)
                            <li>
                                <a href="{{ route($item['route'], ['locale' => app()->getLocale()]) }}"
                                    class="{{ $currentRoute === $item['route'] ? 'text-red-500' : '' }} transition hover:text-red-500">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="flex flex-col gap-y-3 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                        @foreach (array_slice($menu, 4) as $item)
                            <li>
                                <a href="{{ route($item['route'], ['locale' => app()->getLocale()]) }}"
                                    class="{{ $currentRoute === $item['route'] ? 'text-red-500' : '' }} transition hover:text-red-500">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                    {{ __('footer.download_heading') }}
                </h2>
                <div>
                    <p class="mb-4 leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                        {{ __('footer.download_description') }}
                    </p>
                </div>
                <div class="flex gap-x-5">
                    <a href="YOUR_APP_STORE_URL" target="_blank" rel="noopener">
                        <img src="{{ asset('images/badges/app-store-badge.svg') }}" alt="Download on App Store"
                            loading="lazy" class="h-10">
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.cricclubs.pci" target="_blank" rel="noopener">
                        <img src="{{ asset('images/badges/google-play-store-badge.svg') }}" alt="Get it on Google Play"
                            loading="lazy" class="h-10">
                    </a>
                </div>
            </div>
        </div>

        <div>
            <h3 class="mb-5.5 text-2xl font-semibold leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                {{ __('footer.subscribe_heading') }}
            </h3>
            <div class="mb-5.5 md:w-[256px]">
                <p class="leading-[130%] text-[#121212] dark:text-[#EEEEEE]">
                    {{ __('footer.newsletter_description') }}
                </p>
            </div>
            <form class="flex justify-between border-b-2 border-[#E8E8E8] pb-2.5 dark:border-[#333]">
                <input type="email" placeholder="{{ __('footer.email_placeholder') }}" required
                    class="placeholder:font-medium placeholder:leading-[130%] placeholder:text-[#CFCECE] focus:outline-none dark:text-[#EEEEEE] dark:placeholder:text-[#B2B2B2]">
                <button type="submit"
                    class="font-semibold leading-[130%] text-[#121212] hover:cursor-pointer dark:text-[#EEEEEE]">
                    {{ __('footer.submit') }}
                </button>
            </form>
        </div>
    </div>

    <div
        class="lg:pb-5.5 pb-10 md:flex md:items-center md:justify-between md:pt-8 2xl:border-t-2 2xl:border-t-[#E8E8E8] 2xl:pt-6 dark:border-t-[#EEEEEE]">
        <div>
            <p class="my-3.5 text-xs leading-[129%] text-[#121212] md:my-0 2xl:text-sm dark:text-[#EEEEEE]">
                {{ __('footer.copyright', ['year' => date('Y')]) }}
            </p>
        </div>
        <div class="mt-3 flex items-center gap-x-6 md:mt-0">
            <a href=""><x-fab-x-twitter class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-facebook class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
            <a href=""><x-fab-instagram class="h-4 w-4 dark:text-[#EEEEEE]" /></a>
        </div>
    </div>
</div>
