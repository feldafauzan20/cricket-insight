<nav class="fixed left-0 top-0 z-50 w-full transition-colors duration-200" x-data="{ open: false, searchOpen: false, lang: 'ENG' }" x-init="$store.darkMode.init()">

    <div class="md:py-5.5 border-b border-gray-100 bg-white py-4 dark:border-[#343434] dark:bg-[#121212]">
        <div class="mx-6 flex items-center justify-between 2xl:container lg:mx-10 2xl:mx-auto">

            <div class="flex">
                {{-- Logo --}}
                <a href="/" class="mr-11 text-xl font-bold">
                    {{-- Light mode logo --}}
                    <img x-show="!$store.darkMode.on" x-cloak
                        src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                        class="h-8.5 md:h-12.5" loading="eager" fetchpriority="high">
                    {{-- Dark mode logo (jika ada versi putih/terang) --}}
                    <img x-show="$store.darkMode.on" x-cloak
                        src="{{ asset('images/logo/cricket-insight-logo-white.webp') }}" alt="cricket insight logo"
                        class="h-8.5 md:h-12.5" loading="eager" fetchpriority="high">
                </a>

                {{-- Desktop Menu --}}
                <ul class="hidden items-center gap-x-11 text-sm font-medium text-[#B8B8B8] 2xl:flex dark:text-gray-400">
                    <li><a href="/"
                            class="{{ request()->is('/') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">Home</a>
                    </li>
                    <li><a href="/news"
                            class="{{ request()->is('news*') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">News</a>
                    </li>
                    <li><a href="/interview"
                            class="{{ request()->is('interview') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">Interview</a>
                    </li>
                    <li><a href="/tournaments"
                            class="{{ request()->is('tournaments') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">Tournaments</a>
                    </li>
                    <li><a href="/match-centre"
                            class="{{ request()->is('match-centre') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">Match
                            Centre</a></li>
                    <li><a href="/bbi-wbbi"
                            class="{{ request()->is('bbi-wbbi') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">BBI/WBBI</a>
                    </li>
                    <li><a href="/archive"
                            class="{{ request()->is('archive*') ? 'text-[#EC0226]' : '' }} transition hover:text-[#EC0226]">Archive</a>
                    </li>
                </ul>
            </div>

            <div class="items-center lg:flex lg:gap-x-2.5">
                {{-- Darkmode, Search, and Translate Feature --}}
                <div
                    class="hidden rounded-full bg-[#F7F7F7] p-2 transition-colors duration-200 lg:flex dark:bg-[#343434]">

                    {{-- Translate Feature --}}
                    <div class="h-15 hidden cursor-pointer select-none items-center gap-2 rounded-full px-4 md:h-12 lg:flex"
                        @click="lang = (lang === 'ENG') ? 'IND' : 'ENG'">
                        <img :src="lang === 'ENG' ? 'https://flagcdn.com/16x12/gb.webp' : 'https://flagcdn.com/16x12/id.webp'"
                            :alt="lang === 'ENG' ? 'English' : 'Indonesia'" class="h-auto w-6 rounded-sm">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-200" x-text="lang"></span>
                    </div>

                    {{-- Search input --}}
                    <div class="relative flex items-center pr-3">
                        <input x-show="searchOpen" x-transition type="text" placeholder="Search..."
                            class="w-32 rounded-full bg-white px-3 py-4 pr-10 text-gray-900 placeholder-gray-400 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-48 lg:w-72 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:focus:ring-blue-400">

                        <button @click="searchOpen = !searchOpen"
                            class="flex h-12 w-12 items-center justify-center rounded-full text-[#A2A6A9] transition-all focus:outline-none dark:text-white"
                            :class="searchOpen ? 'absolute right-1' : ''">
                            <x-iconoir-search class="h-8 w-8" />
                        </button>
                    </div>

                    {{-- Darkmode Toggle --}}
                    <button @click="$store.darkMode.toggle()"
                        class="w-15 h-15 bg-linear-to-b flex items-center justify-center rounded-full from-[#052A9E] via-[#106CF6] to-[#1EB9EC] transition-all duration-200 hover:shadow-lg focus:outline-none md:h-12 md:w-12">

                        {{-- Moon (show saat light mode) --}}
                        <div x-show="!$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-moon-o class="h-6 w-6 text-white" />
                        </div>

                        {{-- Sun (show saat dark mode) --}}
                        <div x-show="$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-sun-o class="h-6 w-6 text-white" />
                        </div>
                    </button>
                </div>

                {{-- Hamburger Button (Mobile) --}}
                <button @click="open = !open"
                    class="bg-linear-to-b w-15 h-15 flex flex-col items-center justify-center gap-1.5 rounded-full from-[#000075] to-[#010136] focus:outline-none md:h-12 md:w-12 2xl:hidden">
                    <span class="block h-0.5 w-6 bg-white transition-all duration-300 md:w-8"
                        :class="open ? 'rotate-45 translate-y-2' : ''"></span>
                    <span class="block h-0.5 w-6 bg-white transition-all duration-300 md:w-8"
                        :class="open ? 'opacity-0' : ''"></span>
                    <span class="block h-0.5 w-6 bg-white transition-all duration-300 md:w-8"
                        :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    {{-- Mobile Drawer Overlay --}}
    <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-black/50 2xl:hidden"
        @click="open = false"></div>

    {{-- Mobile Drawer Panel --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full" x-cloak
        class="fixed right-0 top-0 z-50 flex h-full w-full max-w-xs flex-col bg-white shadow-xl 2xl:hidden dark:bg-[#121212]">

        {{-- Header: logo + close --}}
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5 dark:border-[#343434]">
            <a href="/" class="text-xl font-bold">
                <img x-show="!$store.darkMode.on" x-cloak
                    src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                    class="h-9">
                <img x-show="$store.darkMode.on" x-cloak
                    src="{{ asset('images/logo/cricket-insight-logo-white.webp') }}" alt="cricket insight logo"
                    class="h-9">
            </a>
            <button @click="open = false"
                class="text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white">
                <x-iconoir-xmark class="h-7 w-7" />
            </button>
        </div>

        {{-- Menu items --}}
        <ul
            class="flex flex-1 flex-col gap-2 overflow-y-auto px-4 py-4 text-base font-semibold text-gray-800 dark:text-gray-200">
            @php
                $menu = [
                    ['label' => 'Home', 'url' => '/', 'icon' => 'home-simple', 'active' => request()->is('/')],
                    ['label' => 'News', 'url' => '/news', 'icon' => 'page', 'active' => request()->is('news*')],
                    [
                        'label' => 'Interview',
                        'url' => '/interview',
                        'icon' => 'microphone',
                        'active' => request()->is('interview'),
                    ],
                    [
                        'label' => 'Tournaments',
                        'url' => '/tournaments',
                        'icon' => 'trophy',
                        'active' => request()->is('tournaments'),
                    ],
                    [
                        'label' => 'Match Centre',
                        'url' => '/match-centre',
                        'icon' => 'calendar',
                        'active' => request()->is('match-centre'),
                    ],
                    [
                        'label' => 'BBI/WBBI',
                        'url' => '/bbi-wbbi',
                        'icon' => 'group',
                        'active' => request()->is('bbi-wbbi'),
                    ],
                    [
                        'label' => 'Archive',
                        'url' => '/archive',
                        'icon' => 'archive',
                        'active' => request()->is('archive*'),
                    ],
                ];
            @endphp

            @foreach ($menu as $item)
                <li class="{{ $item['active'] ? 'border-[#EC0226]' : 'border-transparent' }} border-l-4">
                    <a href="{{ $item['url'] }}"
                        class="{{ $item['active'] ? 'text-[#EC0226]' : '' }} flex items-center gap-3 px-4 py-3 transition hover:text-[#EC0226]">
                        <x-dynamic-component :component="'iconoir-' . $item['icon']" class="h-6 w-6" />
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Footer: lang + dark mode + copyright --}}
        <div class="border-t border-gray-100 px-6 py-4 dark:border-[#343434]">
            {{-- Language --}}
            <button @click="lang = (lang === 'ENG') ? 'IND' : 'ENG'"
                class="flex w-full items-center justify-between py-3 text-base font-semibold text-gray-800 dark:text-gray-200">
                <span class="flex items-center gap-2">
                    <img :src="lang === 'ENG' ? 'https://flagcdn.com/24x18/gb.webp' : 'https://flagcdn.com/24x18/id.webp'"
                        :alt="lang === 'ENG' ? 'English' : 'Indonesia'" class="h-4.5 w-6 rounded-sm">
                    <span x-text="lang"></span>
                </span>
                <x-iconoir-nav-arrow-down class="h-5 w-5 text-gray-400" />
            </button>

            {{-- Dark mode toggle --}}
            <div
                class="flex items-center justify-between py-3 text-base font-semibold text-gray-800 dark:text-gray-200">
                <span class="flex items-center gap-2">
                    <x-tni-moon-o class="h-5 w-5" />
                    Dark Mode
                </span>
                <button @click="$store.darkMode.toggle()" class="relative h-6 w-11 rounded-full transition-colors"
                    :class="$store.darkMode.on ? 'bg-[#EC0226]' : 'bg-gray-300'">
                    <span class="absolute top-0.5 h-5 w-5 rounded-full bg-white shadow transition-transform"
                        :class="$store.darkMode.on ? '-translate-x-5' : 'translate-x-0.5'"></span>
                </button>
            </div>

            <p class="mt-3 text-xs text-gray-400 dark:text-gray-500">
                © {{ date('Y') }} CRICKET INSIGHT. All rights reserved.
            </p>
        </div>
    </div>
</nav>
