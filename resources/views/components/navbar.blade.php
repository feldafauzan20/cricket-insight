<nav class="fixed top-0 left-0 w-full z-50" x-data="{ open: false, darkMode: false, searchOpen: false, lang: 'ENG' }">
    <div class="bg-white py-4 md:py-5.5">
        <div class="mx-6 lg:mx-10 2xl:container 2xl:mx-auto flex items-center justify-between">

            <div class="flex">
                {{-- Logo --}}
                <a href="/" class="text-xl font-bold mr-11">
                    <img src="{{ asset('images/logo/cricket-insight-logo-blue.webp') }}" alt="cricket insight logo"
                        class="h-15 md:h-25">
                </a>

                {{-- Desktop Menu --}}
                <ul class="hidden 2xl:flex gap-x-11 text-sm text-[#B8B8B8] items-center font-medium">
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

            <div class="lg:flex lg:gap-x-2.5 items-center">

                {{-- Darkmode, Search, and Translate Feature --}}
                <div class="hidden lg:flex bg-[#F7F7F7] rounded-full p-2">
                    {{-- Translate Feature --}}
                    <div class="hidden lg:flex items-center gap-2 rounded-full px-4 h-15 md:h-22 cursor-pointer select-none"
                        @click="lang = (lang === 'ENG') ? 'IND' : 'ENG'">
                        <img :src="lang === 'ENG' ? 'https://flagcdn.com/16x12/gb.webp' : 'https://flagcdn.com/16x12/id.webp'"
                            :alt="lang === 'ENG' ? 'English' : 'Indonesia'" class="w-6 h-auto rounded-sm">
                        <span class="text-gray-700 text-sm font-semibold" x-text="lang"></span>
                    </div>

                    {{-- Search input --}}
                    <div class="relative flex items-center pr-3">
                        {{-- Search Input (shows when searchOpen is true) --}}
                        <input x-show="searchOpen" x-transition type="text" placeholder="Search..."
                            class="w-32 md:w-48 lg:w-72 px-3 py-4 pr-10 rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">

                        {{-- Search Button --}}
                        <button @click="searchOpen = !searchOpen"
                            class="flex items-center justify-center w-15 h-15 text-[#A2A6A9] rounded-full focus:outline-none transition-all"
                            :class="searchOpen ? 'absolute right-1' : ''">
                            <x-iconoir-search class="w-8 h-8" />
                        </button>
                    </div>

                    {{-- Darkmode Toggle --}}
                    <button @click="darkMode = !darkMode"
                        class="flex items-center justify-center w-15 md:w-22 h-15 md:h-22 rounded-full bg-linear-to-b from-[#052A9E] via-[#106CF6] to-[#1EB9EC] focus:outline-none transition-all">

                        {{-- Moon --}}
                        <div x-show="!darkMode">
                            <x-tni-moon-o class="w-6 md:w-8 h-6 md:h-8 text-white" />
                        </div>

                        {{-- Sun --}}
                        <div x-show="darkMode">
                            <x-heroicon-o-sun class="w-6 md:w-8 h-6 md:h-8 text-white" />
                        </div>
                    </button>



                </div>


                {{-- Hamburger Button (Mobile) --}}
                <button @click="open = !open"
                    class="flex 2xl:hidden flex-col justify-center bg-linear-to-b rounded-full from-[#EC0226] to-[#860116] items-center w-15 md:w-22 h-15 md:h-22 gap-1.5 focus:outline-none">
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
    <div x-show="open" x-transition class=" bg-white shadow-md">
        <ul class="flex flex-col text-sm font-medium text-gray-700 px-6 lg:px-10 py-4 space-y-3 ">
            <li><a href="/"
                    class="hover:text-red-500 transition {{ request()->is('/') ? 'text-red-500' : '' }}">Home</a></li>
            <li><a href="/news"
                    class="hover:text-red-500 transition {{ request()->is('news') ? 'text-red-500' : '' }}">News</a>
            </li>
            <li><a href="/interview"
                    class="hover:text-red-500 transition {{ request()->is('interview') ? 'text-red-500' : '' }}">Interview</a>
            </li>
            <li><a href="/tournaments"
                    class="hover:text-red-500 transition {{ request()->is('tournaments') ? 'text-red-500' : '' }}">Tournaments</a>
            </li>
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
</nav>
