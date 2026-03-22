<nav class="fixed top-0 left-0 w-full z-50 transition-colors duration-200" x-data="{ open: false, searchOpen: false, lang: 'ENG' }" x-init="$store.darkMode.init()">

    <div class="bg-white dark:bg-[#121212] py-4 md:py-5.5 border-b border-gray-100 dark:border-[#343434]">
        <div class="mx-6 lg:mx-10 2xl:container 2xl:mx-auto flex items-center justify-between">

            <div class="flex">
                {{-- Logo --}}
                <a href="/" class="text-xl font-bold mr-11">
                    {{-- Light mode logo --}}
                    <img x-show="!$store.darkMode.on" x-cloak
                        src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                        class="h-8.5 md:h-12.5">
                    {{-- Dark mode logo (jika ada versi putih/terang) --}}
                    <img x-show="$store.darkMode.on" x-cloak
                        src="{{ asset('images/logo/cricket-insight-logo-white.webp') }}" alt="cricket insight logo"
                        class="h-8.5 md:h-12.5">
                </a>

                {{-- Desktop Menu --}}
                <ul class="hidden 2xl:flex gap-x-11 text-sm text-[#B8B8B8] dark:text-gray-400 items-center font-medium">
                    <li><a href="/"
                            class="hover:text-[#EC0226] transition {{ request()->is('/') ? 'text-[#EC0226]' : '' }}">Home</a>
                    </li>
                    <li><a href="/news"
                            class="hover:text-[#EC0226] transition {{ request()->is('news*') ? 'text-[#EC0226]' : '' }}">News</a>
                    </li>
                    <li><a href="/interview"
                            class="hover:text-[#EC0226] transition {{ request()->is('interview') ? 'text-[#EC0226]' : '' }}">Interview</a>
                    </li>
                    <li><a href="/tournaments"
                            class="hover:text-[#EC0226] transition {{ request()->is('tournaments') ? 'text-[#EC0226]' : '' }}">Tournaments</a>
                    </li>
                    <li><a href="/match-centre"
                            class="hover:text-[#EC0226] transition {{ request()->is('match-centre') ? 'text-[#EC0226]' : '' }}">Match
                            Centre</a></li>
                    <li><a href="/bbi-wbbi"
                            class="hover:text-[#EC0226] transition {{ request()->is('bbi-wbbi') ? 'text-[#EC0226]' : '' }}">BBI/WBBI</a>
                    </li>
                    <li><a href="/gallery"
                            class="hover:text-[#EC0226] transition {{ request()->is('gallery') ? 'text-[#EC0226]' : '' }}">Gallery</a>
                    </li>
                </ul>
            </div>

            <div class="lg:flex lg:gap-x-2.5 items-center">
                {{-- Darkmode, Search, and Translate Feature --}}
                <div
                    class="hidden lg:flex bg-[#F7F7F7] dark:bg-[#343434] rounded-full p-2 transition-colors duration-200">

                    {{-- Translate Feature --}}
                    <div class="hidden lg:flex items-center gap-2 rounded-full px-4 h-15 md:h-12 cursor-pointer select-none"
                        @click="lang = (lang === 'ENG') ? 'IND' : 'ENG'">
                        <img :src="lang === 'ENG' ? 'https://flagcdn.com/16x12/gb.webp' : 'https://flagcdn.com/16x12/id.webp'"
                            :alt="lang === 'ENG' ? 'English' : 'Indonesia'" class="w-6 h-auto rounded-sm">
                        <span class="text-gray-700 dark:text-gray-200 text-sm font-semibold" x-text="lang"></span>
                    </div>

                    {{-- Search input --}}
                    <div class="relative flex items-center pr-3">
                        <input x-show="searchOpen" x-transition type="text" placeholder="Search..."
                            class="w-32 md:w-48 lg:w-72 px-3 py-4 pr-10 rounded-full
                                   bg-white dark:bg-gray-700
                                   text-gray-900 dark:text-white
                                   placeholder-gray-400 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400
                                   transition-all">

                        <button @click="searchOpen = !searchOpen"
                            class="flex items-center justify-center w-12 h-12 text-[#A2A6A9] dark:text-white
                                   rounded-full focus:outline-none transition-all"
                            :class="searchOpen ? 'absolute right-1' : ''">
                            <x-iconoir-search class="w-8 h-8" />
                        </button>
                    </div>

                    {{-- Darkmode Toggle --}}
                    <button @click="$store.darkMode.toggle()"
                        class="flex items-center justify-center w-15 md:w-12 h-15 md:h-12 rounded-full
                               bg-linear-to-b from-[#052A9E] via-[#106CF6] to-[#1EB9EC]
                               hover:shadow-lg focus:outline-none transition-all duration-200">

                        {{-- Moon (show saat light mode) --}}
                        <div x-show="!$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-moon-o class="w-6 h-6 text-white" />
                        </div>

                        {{-- Sun (show saat dark mode) --}}
                        <div x-show="$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-sun-o class="w-6 h-6 text-white" />
                        </div>
                    </button>
                </div>

                {{-- Hamburger Button (Mobile) --}}
                <button @click="open = !open"
                    class="flex 2xl:hidden flex-col justify-center rounded-full
                           bg-linear-to-b from-[#000075] to-[#010136]
                           items-center w-15 md:w-12 h-15 md:h-12 gap-1.5 focus:outline-none">
                    <span class="block w-6 md:w-8 h-0.5 bg-white transition-all duration-300"
                        :class="open ? 'rotate-45 translate-y-2' : ''"></span>
                    <span class="block w-6 md:w-8 h-0.5 bg-white transition-all duration-300"
                        :class="open ? 'opacity-0' : ''"></span>
                    <span class="block w-6 md:w-8 h-0.5 bg-white transition-all duration-300"
                        :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition
        class="bg-white dark:bg-gray-900 shadow-md border-b border-gray-100 dark:border-gray-800">
        <ul class="flex flex-col text-sm font-medium text-gray-700 dark:text-gray-300 px-6 lg:px-10 py-4 space-y-3">
            <li><a href="/"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('/') ? 'text-[#EC0226] dark:text-red-400' : '' }}">Home</a>
            </li>
            <li><a href="/news"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('news*') ? 'text-[#EC0226] dark:text-red-400' : '' }}">News</a>
            </li>
            <li><a href="/interview"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('interview') ? 'text-[#EC0226] dark:text-red-400' : '' }}">Interview</a>
            </li>
            <li><a href="/tournaments"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('tournaments') ? 'text-[#EC0226] dark:text-red-400' : '' }}">Tournaments</a>
            </li>
            <li><a href="/match-centre"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('match-centre') ? 'text-[#EC0226] dark:text-red-400' : '' }}">Match
                    Centre</a></li>
            <li><a href="/bbi-wbbi"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('bbi-wbbi') ? 'text-[#EC0226] dark:text-red-400' : '' }}">BBI/WBBI</a>
            </li>
            <li><a href="/gallery"
                    class="hover:text-[#EC0226] dark:hover:text-red-400 transition {{ request()->is('gallery') ? 'text-[#EC0226] dark:text-red-400' : '' }}">Gallery</a>
            </li>
        </ul>
    </div>
</nav>
