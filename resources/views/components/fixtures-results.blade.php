@props(['seriesList' => [], 'currentYear' => now()->year])

<div class="rounded-[7px] border border-[#EDF1F6] dark:border-[#353434]" x-data="fixturesFilters(@js($seriesList), {{ $currentYear }})">
    @php
        $dummyFixturesPaginator = new \Illuminate\Pagination\LengthAwarePaginator(collect(range(1, 50)), 50, 30, 1);
    @endphp

    {{-- HEADER --}}
    <div class="md:pl-9.5 rounded-t-[7px] bg-[#0A1628] py-3.5 pl-2.5 dark:bg-[#1F1F1F]">
        <h1 class="text-xl font-semibold text-white lg:text-[22px]">FIXTURES & RESULTS</h1>
    </div>

    {{-- TAB NAVIGATION: MEN, WOMEN, RESULTS, FIXTURES --}}
    <div class="border-b border-[#E0E0E0] bg-white md:pl-3.5 dark:border-[#353434] dark:bg-[#353434]">
        <div class="swiper fixtures-tabs-swiper overflow-hidden">
            <div class="swiper-wrapper">
                {{-- <div class="swiper-slide w-auto!">
                    <button @click="activeTab = 'men'"
                        :class="activeTab === 'men' ? 'border-b-2 border-[#007DFC]' : ''"
                        class="px-6 py-4 text-base font-medium text-[#121212] transition-colors hover:bg-gray-50 dark:text-white dark:hover:bg-[#353434]">
                        MEN
                    </button>
                </div>
                <div class="swiper-slide w-auto!">
                    <button @click="activeTab = 'women'"
                        :class="activeTab === 'women' ? 'border-b-2 border-[#007DFC]' : ''"
                        class="px-6 py-4 text-base font-medium text-[#121212] transition-colors hover:bg-gray-50 dark:text-white dark:hover:bg-[#353434]">
                        WOMEN
                    </button>
                </div> --}}
                <div class="swiper-slide w-auto!">
                    <button @click="activeTab = 'results'"
                        :class="activeTab === 'results' ? 'border-b-2 border-[#007DFC]' : ''"
                        class="px-6 py-4 text-base font-medium text-[#121212] transition-colors hover:bg-gray-50 dark:text-white dark:hover:bg-[#353434]">
                        RESULTS
                    </button>
                </div>
                <div class="swiper-slide w-auto!">
                    <button @click="activeTab = 'fixtures'"
                        :class="activeTab === 'fixtures' ? 'border-b-2 border-[#007DFC]' : ''"
                        class="px-6 py-4 text-base font-medium text-[#121212] transition-colors hover:bg-gray-50 dark:text-white dark:hover:bg-[#353434]">
                        FIXTURES
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER: YEAR, FORMATS, AND TEAMS --}}
    <div class="md:px-6.5 bg-[#F8FAFC] p-4 md:p-0 md:py-4 dark:bg-[#515050]">
        <div class="swiper fixtures-filters-swiper">
            <div class="swiper-wrapper">
                {{-- YEAR FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div class="flex items-center gap-2">
                        <button @click="previousYear()"
                            class="flex h-8 w-8 items-center justify-center rounded text-[#121212] transition-colors hover:bg-gray-100 dark:text-white dark:hover:bg-[#353434]">
                            <x-ri-arrow-left-s-line class="h-5 w-5" />
                        </button>

                        <button x-ref="yearBtn" @click="toggleYearDropdown()"
                            class="w-20 cursor-pointer rounded-[3px] border border-[#E0E0E0] px-3 py-2 text-center text-sm font-medium text-[#121212] transition-colors hover:border-[#EC0226] dark:border-[#353434] dark:bg-[#353434] dark:text-white">
                            <span x-text="selectedYear"></span>
                        </button>

                        <template x-teleport="body">
                            <div x-show="openYear" @click.away="openYear = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${yearDropdownStyle.top}; left: ${yearDropdownStyle.left};`"
                                class="absolute z-50 max-h-64 w-48 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-lg dark:border-[#171717] dark:bg-[#353434]">
                                <div class="grid grid-cols-3 gap-1">
                                    <template x-for="year in yearList" :key="year">
                                        <button
                                            @click="openYear = false; resetFiltersForYearChange(year); fetchSeries(year)"
                                            :class="year === selectedYear ?
                                                'bg-[#EC0226] text-white' :
                                                'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                            class="rounded-[3px] px-2 py-1 text-sm transition-colors" x-text="year">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>

                        <button @click="nextYear()"
                            class="flex h-8 w-8 items-center justify-center rounded text-[#121212] transition-colors hover:bg-gray-100 dark:text-white dark:hover:bg-[#353434]">
                            <x-ri-arrow-right-s-line class="h-5 w-5" />
                        </button>
                    </div>
                </div>

                {{-- SERIES FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div class="relative" x-data="{
                        open: false,
                        pos: {},
                        toggle() {
                            this.open = !this.open;
                            if (this.open) {
                                const r = this.$refs.btn.getBoundingClientRect();
                                this.pos = {
                                    top: r.bottom + window.scrollY + 8 + 'px',
                                    left: r.left + window.scrollX + 'px',
                                    width: r.width + 'px',
                                };
                            }
                        },
                        close() {
                            this.open = false;
                        }
                    }" x-init="window.addEventListener('fixtures-filters-reset', () => this.close())">
                        <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                            <div
                                class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                                <div class="gap-x-0.75 flex items-center">
                                    <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                    <p class="text-[15px] text-[#121212] dark:text-white"
                                        x-text="selectedSeriesId ? selectedFormat : 'All Series'"></p>
                                </div>
                                <div x-show="selectedSeriesId" class="px-3.25 rounded-full"
                                    style="background-color: #EC022630">
                                    <p class="text-[15px] font-normal" style="color: #EC0226" x-text="selectedFormat">
                                    </p>
                                </div>
                                <div>
                                    <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                                </div>
                            </div>
                        </div>
                        <template x-teleport="body">
                            <div x-show="open" @click.away="open = false" x-cloak
                                :title="selectedFormat || 'All Series'"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${pos.top}; left: ${pos.left}; width: ${pos.width};`"
                                class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#353434] dark:bg-[#353434]">
                                <div class="py-1">
                                    <button @click="selectSeries(null); open = false"
                                        :class="!selectedSeriesId ?
                                            'bg-[#EC0226] bg-opacity-10 text-[#121212] dark:text-white' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">
                                        All Series
                                    </button>

                                    <template x-if="seriesLoading">
                                        <div class="px-4 py-3 text-sm text-[#A2A6A9]">Loading...</div>
                                    </template>

                                    <template x-if="!seriesLoading && seriesList.length === 0">
                                        <div class="px-4 py-3 text-sm text-[#A2A6A9]">No series found</div>
                                    </template>

                                    <template x-for="series in seriesList" :key="series.seriesID">
                                        <button @click="selectSeries(series); open = false" :title="series.seriesName"
                                            :class="selectedSeriesId === series.seriesID ?
                                                'bg-[#EC0226] bg-opacity-10 text-white' :
                                                'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                            class="w-full truncate px-4 py-2 text-left text-sm transition-colors"
                                            x-text="series.seriesName">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{--  FILTER --}}
                {{-- <div class="swiper-slide w-auto!">
                    <div class="relative" x-data="{
                        open: false,
                        pos: {},
                        toggle() {
                            this.open = !this.open;
                            if (this.open) {
                                const r = this.$refs.btn.getBoundingClientRect();
                                this.pos = {
                                    top: r.bottom + window.scrollY + 8 + 'px',
                                    left: r.left + window.scrollX + 'px',
                                    width: r.width + 'px',
                                };
                            }
                        }
                    }">
                        <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                            <div
                                class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                                <div class="gap-x-0.75 flex items-center">
                                    <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                    <p class="text-[15px] text-[#121212] dark:text-white">All Grounds</p>
                                </div>
                                <div x-show="selectedTeam" class="px-3.25 rounded-full"
                                    style="background-color: #EC022630">
                                    <p class="text-[15px] font-normal" style="color: #EC0226" x-text="selectedTeam">
                                    </p>
                                </div>
                                <div>
                                    <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                                </div>
                            </div>
                        </div>
                        <template x-teleport="body">
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${pos.top}; left: ${pos.left}; width: ${pos.width};`"
                                class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#171717] dark:bg-[#353434]">
                                <div class="py-1">
                                    <button @click="selectTeam('India'); open = false"
                                        :class="selectedTeam === 'India' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">India</button>
                                    <button @click="selectTeam('Australia'); open = false"
                                        :class="selectedTeam === 'Australia' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Australia</button>
                                    <button @click="selectTeam('England'); open = false"
                                        :class="selectedTeam === 'England' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">England</button>
                                    <button @click="selectTeam('Pakistan'); open = false"
                                        :class="selectedTeam === 'Pakistan' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Pakistan</button>
                                    <button @click="selectTeam('South Africa'); open = false"
                                        :class="selectedTeam === 'South Africa' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">South
                                        Africa</button>
                                    <button @click="selectTeam('New Zealand'); open = false"
                                        :class="selectedTeam === 'New Zealand' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">New
                                        Zealand</button>
                                    <button @click="selectTeam('Sri Lanka'); open = false"
                                        :class="selectedTeam === 'Sri Lanka' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Sri Lanka</button>
                                    <button @click="selectTeam('Bangladesh'); open = false"
                                        :class="selectedTeam === 'Bangladesh' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Bangladesh</button>
                                    <button @click="selectTeam('West Indies'); open = false"
                                        :class="selectedTeam === 'West Indies' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">West
                                        Indies</button>
                                    <button @click="selectTeam('Afghanistan'); open = false"
                                        :class="selectedTeam === 'Afghanistan' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Afghanistan</button>
                                    <button @click="selectTeam(''); open = false"
                                        :class="selectedTeam === '' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full border-t border-[#E0E0E0] px-4 py-2 text-left text-sm transition-colors dark:border-[#171717]">All
                                        Teams</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div> --}}

                {{-- TEAMS FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div class="relative" x-data="{
                        open: false,
                        pos: {},
                        toggle() {
                            this.open = !this.open;
                            if (this.open) {
                                const r = this.$refs.btn.getBoundingClientRect();
                                this.pos = {
                                    top: r.bottom + window.scrollY + 8 + 'px',
                                    left: r.left + window.scrollX + 'px',
                                    width: r.width + 'px',
                                };
                            }
                        },
                        close() {
                            this.open = false;
                        }
                    }" x-init="window.addEventListener('fixtures-filters-reset', () => this.close())">
                        <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                            <div
                                class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                                <div class="gap-x-0.75 flex items-center">
                                    <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                    <p class="text-[15px] text-[#121212] dark:text-white"
                                        x-text="selectedTeamName || 'All Teams'"></p>
                                </div>
                                <div x-show="selectedTeamId" class="px-3.25 rounded-full"
                                    style="background-color: #EC022630">
                                    <p class="text-[15px] font-normal" style="color: #EC0226"
                                        x-text="selectedTeamName"></p>
                                </div>
                                <div>
                                    <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                                </div>
                            </div>
                        </div>

                        <template x-teleport="body">
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${pos.top}; left: ${pos.left}; width: ${pos.width};`"
                                class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#171717] dark:bg-[#353434]">
                                <div class="py-1">
                                    <button @click="selectTeam(null); open = false"
                                        :class="!selectedTeamId ? 'bg-[#EC0226] bg-opacity-10 text-[#121212] dark:text-white' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">
                                        All Teams
                                    </button>

                                    <template x-if="teamsLoading">
                                        <div class="px-4 py-3 text-sm text-[#A2A6A9]">Loading...</div>
                                    </template>

                                    <template x-if="!teamsLoading && teamsList.length === 0">
                                        <div class="px-4 py-3 text-sm text-[#A2A6A9]">No teams found</div>
                                    </template>

                                    <template x-for="team in teamsList" :key="team.teamID">
                                        <button @click="selectTeam(team); open = false" :title="team.teamName"
                                            :class="selectedTeamId === team.teamID ?
                                                'bg-[#EC0226] bg-opacity-10 text-white' :
                                                'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                            class="w-full px-4 py-2 text-left text-sm transition-colors"
                                            x-text="team.teamName">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- CLUBS FILTER --}}
                {{-- <div class="swiper-slide w-auto!">
                    <div class="relative" x-data="{
                        open: false,
                        pos: {},
                        toggle() {
                            this.open = !this.open;
                            if (this.open) {
                                const r = this.$refs.btn.getBoundingClientRect();
                                this.pos = {
                                    top: r.bottom + window.scrollY + 8 + 'px',
                                    left: r.left + window.scrollX + 'px',
                                    width: r.width + 'px',
                                };
                            }
                        }
                    }">
                        <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                            <div
                                class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                                <div class="gap-x-0.75 flex items-center">
                                    <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                    <p class="text-[15px] text-[#121212] dark:text-white">All Clubs</p>
                                </div>
                                <div x-show="selectedTeam" class="px-3.25 rounded-full"
                                    style="background-color: #EC022630">
                                    <p class="text-[15px] font-normal" style="color: #EC0226" x-text="selectedTeam">
                                    </p>
                                </div>
                                <div>
                                    <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                                </div>
                            </div>
                        </div>
                        <template x-teleport="body">
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${pos.top}; left: ${pos.left}; width: ${pos.width};`"
                                class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#171717] dark:bg-[#353434]">
                                <div class="py-1">
                                    <button @click="selectTeam('India'); open = false"
                                        :class="selectedTeam === 'India' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">India</button>
                                    <button @click="selectTeam('Australia'); open = false"
                                        :class="selectedTeam === 'Australia' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Australia</button>
                                    <button @click="selectTeam('England'); open = false"
                                        :class="selectedTeam === 'England' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">England</button>
                                    <button @click="selectTeam('Pakistan'); open = false"
                                        :class="selectedTeam === 'Pakistan' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Pakistan</button>
                                    <button @click="selectTeam('South Africa'); open = false"
                                        :class="selectedTeam === 'South Africa' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">South
                                        Africa</button>
                                    <button @click="selectTeam('New Zealand'); open = false"
                                        :class="selectedTeam === 'New Zealand' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">New
                                        Zealand</button>
                                    <button @click="selectTeam('Sri Lanka'); open = false"
                                        :class="selectedTeam === 'Sri Lanka' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Sri Lanka</button>
                                    <button @click="selectTeam('Bangladesh'); open = false"
                                        :class="selectedTeam === 'Bangladesh' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Bangladesh</button>
                                    <button @click="selectTeam('West Indies'); open = false"
                                        :class="selectedTeam === 'West Indies' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">West
                                        Indies</button>
                                    <button @click="selectTeam('Afghanistan'); open = false"
                                        :class="selectedTeam === 'Afghanistan' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">Afghanistan</button>
                                    <button @click="selectTeam(''); open = false"
                                        :class="selectedTeam === '' ? 'bg-[#EC0226] bg-opacity-10 text-[#EC0226]' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full border-t border-[#E0E0E0] px-4 py-2 text-left text-sm transition-colors dark:border-[#171717]">All
                                        Teams</button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div> --}}

                {{-- DAYS FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div class="relative" x-data="{
                        open: false,
                        pos: {},
                        toggle() {
                            this.open = !this.open;
                            if (this.open) {
                                const r = this.$refs.btn.getBoundingClientRect();
                                this.pos = {
                                    top: r.bottom + window.scrollY + 8 + 'px',
                                    left: r.left + window.scrollX + 'px',
                                    width: r.width + 'px',
                                };
                            }
                        },
                        close() {
                            this.open = false;
                        }
                    }" x-init="window.addEventListener('fixtures-filters-reset', () => this.close())">
                        <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                            <div
                                class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                                <div class="gap-x-0.75 flex items-center">
                                    <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                    <p class="text-[15px] text-[#121212] dark:text-white"
                                        x-text="selectedDay || 'All Days'"></p>
                                </div>
                                <div x-show="selectedDay" class="px-3.25 rounded-full"
                                    style="background-color: #EC022630">
                                    <p class="text-[15px] font-normal" style="color: #EC0226" x-text="selectedDay">
                                    </p>
                                </div>
                                <div>
                                    <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                                </div>
                            </div>
                        </div>
                        <template x-teleport="body">
                            <div x-show="open" @click.away="open = false" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                :style="`top: ${pos.top}; left: ${pos.left}; width: ${pos.width};`"
                                class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#171717] dark:bg-[#353434]">
                                <div class="py-1">
                                    <button @click="selectDay(null); open = false"
                                        :class="!selectedDay ? 'bg-[#EC0226] bg-opacity-10 text-[#121212] dark:text-white' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors">
                                        All Days
                                    </button>

                                    <template x-for="day in dayList" :key="day">
                                        <button @click="selectDay(day); open = false"
                                            :class="selectedDay === day ? 'bg-[#EC0226] bg-opacity-10 text-white' :
                                                'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                            class="w-full px-4 py-2 text-left text-sm transition-colors"
                                            x-text="day">
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- FROM DATE FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div
                        class="flex items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                        <x-ri-calendar-line class="h-6 w-6 shrink-0" style="color: #EC0226" />
                        <input type="text" x-ref="fromDateInput" placeholder="From Date" readonly
                            class="w-28 cursor-pointer bg-transparent text-[15px] text-[#121212] placeholder-[#121212]/70 focus:outline-none dark:text-white dark:placeholder-white/60">
                    </div>
                </div>

                {{-- TO DATE FILTER --}}
                <div class="swiper-slide w-auto!">
                    <div
                        class="flex items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                        <x-ri-calendar-line class="h-6 w-6 shrink-0" style="color: #EC0226" />
                        <input type="text" x-ref="toDateInput" placeholder="To Date" readonly
                            class="w-28 cursor-pointer bg-transparent text-[15px] text-[#121212] placeholder-[#121212]/70 focus:outline-none dark:text-white dark:placeholder-white/60">
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- FIXTURES CONTENT --}}
    <div class="dark:bg-[#515050]">
        <div class="dark:bg-[#515050]">
            <template x-if="matchesLoading">
                <div class="px-4 py-8 text-center text-sm text-[#A2A6A9]">
                    Loading matches...
                </div>
            </template>

            <template x-if="!matchesLoading && filteredMatchesGroups.length === 0">
                <div class="px-4 py-8 text-center text-sm text-[#A2A6A9]">
                    No matches found for the selected filters.
                </div>
            </template>

            <template x-for="group in filteredMatchesGroups" :key="group.date">
                <div>
                    <div
                        class="md:px-9.5 bg-linear-to-r py-1.25 from-[#1A56DB] from-0% to-[#0E2E75] to-100% px-2.5 dark:bg-[#1F1F1F] dark:bg-none">
                        <p class="text-sm font-semibold text-white lg:text-lg" x-text="group.date"></p>
                    </div>

                    <template x-for="match in group.matches" :key="match.matchId">
                        <div
                            class="md:px-9.5 border-b border-[#EDF1F6] px-2.5 py-5 md:flex dark:border-none dark:bg-[#515050]">
                            <div class="flex gap-x-4 md:gap-x-0 2xl:w-full">
                                <div class="flex flex-col gap-y-2">
                                    <div>
                                        <span
                                            class="text-xs font-medium text-[#718096] lg:text-[14px] dark:text-[#D8D8D8]"
                                            x-text="match.type"></span>
                                    </div>
                                    <div>
                                        <h1 class="text-[15px] font-medium text-[#121212] lg:text-xl dark:text-white"
                                            x-text="match.title"></h1>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-[#A0AEC0] md:text-sm lg:text-[14px] dark:text-[#D8D8D8]"
                                            x-text="match.venue"></p>
                                    </div>
                                </div>

                                <div class="my-3.75 mx-5.75 lg:mx-8.25 hidden w-px bg-[#EDF1F6] md:block lg:my-0">
                                </div>

                                <div class="gap-2.25 flex flex-col py-2.5 md:flex-1">
                                    <div class="flex justify-between">
                                        <div class="flex items-center gap-x-2">
                                            <img :src="match.teamOne.logo" :alt="match.teamOne.name"
                                                class="h-5 w-5 rounded-full object-cover">
                                            <h2 class="text-xs text-[#A2A6A9] md:text-xl dark:text-[#D8D8D8]"
                                                x-text="match.teamOne.name"></h2>
                                        </div>
                                        <p class="text-xs text-[#A2A6A9] md:text-xl dark:text-[#D8D8D8]"
                                            x-text="match.teamOne.score"></p>
                                    </div>

                                    <div class="flex justify-between">
                                        <div class="flex items-center gap-x-2">
                                            <img :src="match.teamTwo.logo" :alt="match.teamTwo.name"
                                                class="h-5 w-5 rounded-full object-cover">
                                            <h2 class="text-xs text-[#48494A] md:text-xl dark:text-white"
                                                x-text="match.teamTwo.name"></h2>
                                        </div>
                                        <p class="text-xs text-[#48494A] md:text-xl dark:text-white"
                                            x-text="match.teamTwo.score"></p>
                                    </div>

                                    <p class="text-[8.5px] italic text-[#A0AEC0] md:text-sm dark:text-[#D8D8D8]"
                                        x-text="match.result"></p>
                                </div>
                            </div>

                            <hr class="my-2.5 border-[#EFEFEF] md:hidden dark:border-[#DEDEDE]" />
                            <div class="my-3.75 mx-5.75 lg:mx-8.25 hidden w-px bg-[#EDF1F6] md:block lg:my-0"></div>

                            <div class="md:flex md:items-center">
                                <button
                                    class="flex w-full items-center justify-center gap-x-1.5 rounded-[7px] border border-[#EC0226] py-2 text-sm font-medium text-[#EC0226] transition-colors hover:bg-[#EC0226] hover:text-white md:w-auto md:px-4 dark:hover:bg-[#EC0226] dark:hover:text-white">
                                    Shortcut <x-ionicon-play-sharp class="h-4 w-4" />
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <template x-if="pagination.last_page > 1">
                <div class="mx-10 flex flex-wrap items-center justify-center gap-2 pb-4 md:py-4">
                    <button @click="prevPage()"
                        :class="currentPage === 1 ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-50'"
                        class="rounded-[3px] border border-[#CFD6DC] bg-white px-3 py-2 text-sm font-medium text-[#121212] dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-300">
                        Previous
                    </button>

                    <template x-for="page in paginationPages" :key="page">
                        <button @click="goToPage(page)"
                            :class="page === currentPage ? 'bg-[#EC0226] text-white' :
                                'bg-white text-[#121212] hover:bg-gray-50 dark:bg-[#1F1F1F] dark:text-gray-300'"
                            class="rounded-[3px] border border-[#CFD6DC] px-3 py-2 text-sm font-medium">
                            <span x-text="page"></span>
                        </button>
                    </template>

                    <button @click="nextPage()"
                        :class="currentPage === pagination.last_page ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-50'"
                        class="rounded-[3px] border border-[#CFD6DC] bg-white px-3 py-2 text-sm font-medium text-[#121212] dark:border-[#CFD6DC] dark:bg-[#1F1F1F] dark:text-gray-300">
                        Next
                    </button>
                </div>
            </template>
        </div>
    </div>
</div>
