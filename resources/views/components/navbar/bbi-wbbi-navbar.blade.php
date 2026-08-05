<nav class="fixed left-0 top-0 z-50 w-full transition-colors duration-200" x-data="{ open: false, searchOpen: false, lang: 'ENG' }" x-init="$store.darkMode.init()">
    <div class="h-16.75 2xl:h-35 flex 2xl:container md:h-fit lg:mx-10 2xl:mx-auto">

        {{-- Logo — stretch full height, nyambung dari atas ke bawah --}}
        <div
            class="px-12.5 md:w-65 flex-1 bg-[#080907] py-3.5 md:flex md:h-20 md:flex-none md:items-center md:justify-center 2xl:h-full">
            <img src="{{ asset('images/logo/cricket-insight-bali-bash-logo-white.webp') }}" alt="">
        </div>

        {{-- Kolom kanan — top bar & main row stack vertikal di sini --}}
        <div class="flex w-24 flex-col md:w-auto md:flex-1">

            {{-- Top bar — 2xl only --}}
            <div
                class="2xl:px-7.5 hidden bg-[#1F2022] 2xl:flex 2xl:flex-none 2xl:items-center 2xl:justify-between 2xl:py-2.5">
                <div class="flex items-center gap-x-6">
                    <a href="#" class="gap-x-2.25 flex items-center text-sm text-white">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.4375 9.75C2.4375 4.0625 8.125 4.0625 13 4.0625C17.875 4.0625 23.5625 4.0625 23.5625 9.75C23.5625 16.25 17.875 8.9375 17.875 8.9375H8.125C8.125 8.9375 2.4375 16.25 2.4375 9.75ZM8.9375 11.375C8.9375 11.375 4.875 15.4375 4.875 22.75H21.125C21.125 15.4375 17.0625 11.375 17.0625 11.375H8.9375Z"
                                stroke="#97775B" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M13 20.3125C14.7949 20.3125 16.25 18.8574 16.25 17.0625C16.25 15.2676 14.7949 13.8125 13 13.8125C11.2051 13.8125 9.75 15.2676 9.75 17.0625C9.75 18.8574 11.2051 20.3125 13 20.3125Z"
                                stroke="#97775B" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        +62 (081) 283588801
                    </a>
                    <div class="h-6 w-0.5 bg-white/20"></div>
                    <a href="#" class="gap-x-2.25 flex items-center text-sm text-white">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.33073 21.6673C3.7349 21.6673 3.22501 21.4553 2.80106 21.0314C2.37712 20.6075 2.16478 20.0972 2.16406 19.5007V6.50065C2.16406 5.90482 2.3764 5.39493 2.80106 4.97098C3.22573 4.54704 3.73562 4.33471 4.33073 4.33398H21.6641C22.2599 4.33398 22.7701 4.54632 23.1948 4.97098C23.6195 5.39565 23.8314 5.90554 23.8307 6.50065V19.5007C23.8307 20.0965 23.6188 20.6067 23.1948 21.0314C22.7709 21.4561 22.2606 21.668 21.6641 21.6673H4.33073ZM12.9974 14.084L4.33073 8.66732V19.5007H21.6641V8.66732L12.9974 14.084ZM12.9974 11.9173L21.6641 6.50065H4.33073L12.9974 11.9173ZM4.33073 8.66732V6.50065V19.5007V8.66732Z"
                                fill="#97775B" />
                        </svg>

                        BBI@email.com
                    </a>
                </div>

                <div class="flex items-center gap-x-2.5">
                    {{-- X --}}
                    <a href="https://x.com/Cricket_INA" target="__blank" class="p-3.25 rounded-full bg-white/10">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1324_1531)">
                                <mask id="mask0_1324_1531" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="15" height="15">
                                    <path d="M0 0H15V15H0V0Z" fill="white" />
                                </mask>
                                <g mask="url(#mask0_1324_1531)">
                                    <path
                                        d="M11.8125 0.703125H14.1129L9.08786 6.46098L15 14.2974H10.3714L6.74357 9.54562L2.59714 14.2974H0.294643L5.66893 8.1367L0 0.704196H4.74643L8.02071 5.0467L11.8125 0.703125ZM11.0036 12.9174H12.2786L4.05 2.01134H2.68286L11.0036 12.9174Z"
                                        fill="white" />
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_1324_1531">
                                    <rect width="15" height="15" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/people/Persatuan-Cricket-Indonesia/61560799396848"  target="__blank" class="rounded-full bg-white/10 p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 12C22 6.48 17.52 2 12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.8V15H8V12H10V9.5C10 7.57 11.57 6 13.5 6H16V9H14C13.45 9 13 9.45 13 10V12H16V15H13V21.95C18.05 21.45 22 17.19 22 12Z"
                                fill="white" />
                        </svg>

                    </a>

                    {{-- Youtube --}}
                    <a href="https://youtube.com/@cricketindonesia8372" target="__blank" class="rounded-full bg-white/10 p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5C21 5 21 5 21 12C21 19 21 19 12 19C3 19 3 19 3 12C3 5 3 5 12 5Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 8.5L16 12L10 15.5V8.5Z" fill="white" />
                        </svg>

                    </a>

                    {{-- Instagram --}}
                    <a href="https://instagram.com/cricket_ina" target="__blank" class="rounded-full bg-white/10 p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.8 2H16.2C19.4 2 22 4.6 22 7.8V16.2C22 17.7383 21.3889 19.2135 20.3012 20.3012C19.2135 21.3889 17.7383 22 16.2 22H7.8C4.6 22 2 19.4 2 16.2V7.8C2 6.26174 2.61107 4.78649 3.69878 3.69878C4.78649 2.61107 6.26174 2 7.8 2ZM7.6 4C6.64522 4 5.72955 4.37928 5.05442 5.05442C4.37928 5.72955 4 6.64522 4 7.6V16.4C4 18.39 5.61 20 7.6 20H16.4C17.3548 20 18.2705 19.6207 18.9456 18.9456C19.6207 18.2705 20 17.3548 20 16.4V7.6C20 5.61 18.39 4 16.4 4H7.6ZM17.25 5.5C17.5815 5.5 17.8995 5.6317 18.1339 5.86612C18.3683 6.10054 18.5 6.41848 18.5 6.75C18.5 7.08152 18.3683 7.39946 18.1339 7.63388C17.8995 7.8683 17.5815 8 17.25 8C16.9185 8 16.6005 7.8683 16.3661 7.63388C16.1317 7.39946 16 7.08152 16 6.75C16 6.41848 16.1317 6.10054 16.3661 5.86612C16.6005 5.6317 16.9185 5.5 17.25 5.5ZM12 7C13.3261 7 14.5979 7.52678 15.5355 8.46447C16.4732 9.40215 17 10.6739 17 12C17 13.3261 16.4732 14.5979 15.5355 15.5355C14.5979 16.4732 13.3261 17 12 17C10.6739 17 9.40215 16.4732 8.46447 15.5355C7.52678 14.5979 7 13.3261 7 12C7 10.6739 7.52678 9.40215 8.46447 8.46447C9.40215 7.52678 10.6739 7 12 7ZM12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9Z"
                                fill="white" />
                        </svg>

                    </a>

                </div>
            </div>

            {{-- Main row (hamburger / dark mode / subscribe) --}}
            <div class="md:pr-3.75 flex flex-1 items-center justify-end bg-white md:justify-between md:py-2.5 md:pl-7">
                <button @click="open = !open"
                    class="w-15 h-15 flex flex-col items-center justify-center gap-1.5 rounded-full focus:outline-none md:h-12 md:w-12 2xl:hidden">
                    <span class="block h-0.5 w-6 bg-[#97775B] transition-all duration-300 md:w-8"
                        :class="open ? 'rotate-45 translate-y-2' : ''"></span>
                    <span class="block h-0.5 w-6 bg-[#97775B] transition-all duration-300 md:w-8"
                        :class="open ? 'opacity-0' : ''"></span>
                    <span class="block h-0.5 w-6 bg-[#97775B] transition-all duration-300 md:w-8"
                        :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
                </button>
                <div class="hidden 2xl:block">
                    <ul class="2xl:gap-11.75 flex">
                        <li><a href="#schedule" class="font-figtree font-semibold tracking-[-0.05em] text-[#1F0222]">Watch
                                Live</a>
                        </li>
                        <li><a href="#highlighted-games" class="font-figtree font-semibold tracking-[-0.05em] text-[#1F0222]">View
                                Fixtures</a>
                        </li>
                        <li><a href="#article"
                                class="font-figtree font-semibold tracking-[-0.05em] text-[#1F0222]">Article</a>
                        </li>
                        <li><a href="#top-stories"
                                class="font-figtree font-semibold tracking-[-0.05em] text-[#1F0222]">Top Stories</a>
                        </li>
                        <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}"
                                class="font-figtree font-semibold tracking-[-0.05em] text-[#1F0222]">CRICKET INSIGHT</a>
                        </li>
                    </ul>
                </div>
                <div class="md:gap-x-4.5 hidden md:flex md:items-center">
                    <button @click="$store.darkMode.toggle()"
                        class="w-15 h-15 flex items-center justify-center rounded-full bg-[#1F2022] transition-all duration-200 hover:shadow-lg focus:outline-none md:h-12 md:w-12">
                        <div x-show="!$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-moon-o class="h-6 w-6 text-white" />
                        </div>
                        <div x-show="$store.darkMode.on" x-transition:enter.duration.200ms>
                            <x-tni-sun-o class="h-6 w-6 text-white" />
                        </div>
                    </button>
                    <a href="#"
                        class="font-figtree py-4.5 inline-flex items-center gap-1.5 bg-[#97775B] px-8 font-semibold text-white md:tracking-[-0.05em]">
                        Subscribe now!
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H9M17 7v8" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition
        class="border-b border-gray-100 bg-white shadow-md dark:border-gray-800 dark:bg-gray-900">
        <ul class="flex flex-col space-y-3 px-6 py-4 text-sm font-medium text-gray-700 lg:px-10 dark:text-gray-300">
            <li><a href="/"
                    class="{{ request()->is('/') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">Home</a>
            </li>
            <li><a href="/news"
                    class="{{ request()->is('news*') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">News</a>
            </li>
            <li><a href="/interview"
                    class="{{ request()->is('interview') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">Interview</a>
            </li>
            <li><a href="/tournaments"
                    class="{{ request()->is('tournaments') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">Tournaments</a>
            </li>
            <li><a href="/match-centre"
                    class="{{ request()->is('match-centre') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">Match
                    Centre</a></li>
            <li><a href="/bbi-wbbi"
                    class="{{ request()->is('bbi-wbbi') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">BBI/WBBI</a>
            </li>
            <li><a href="/archive"
                    class="{{ request()->is('archive*') ? 'text-[#EC0226] dark:text-red-400' : '' }} transition hover:text-[#EC0226] dark:hover:text-red-400">Archive</a>
            </li>
        </ul>
    </div>
</nav>
