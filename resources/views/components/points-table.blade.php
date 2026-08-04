@props(['seriesList' => [], 'currentYear' => now()->year])

<div x-data="pointsTable(@js($seriesList), {{ $currentYear }})">
    {{-- HEADER --}}
    <div class="mb-6.25 flex items-center gap-x-3.5">
        <h1 class="text-2xl font-semibold text-[#121212] lg:text-4xl dark:text-white">POINTS TABLE
        </h1>
        <x-eva-info-outline class="h-6 w-6 text-[#EC0226]" />
    </div>

    {{-- FILTER --}}
    <div class="swiper points-table-filters-swiper mb-7.5 overflow-hidden">
        <div class="swiper-wrapper">
            {{-- YEAR FILTER --}}
            <div class="swiper-slide w-auto!">
                <div class="flex items-center gap-2">
                    <button x-ref="ptYearBtn" @click="toggleYearDropdown()"
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
                                    <button @click="fetchSeries(year); openYear = false"
                                        :class="year === selectedYear ?
                                            'bg-[#EC0226] text-white' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="rounded-[3px] px-2 py-1 text-sm transition-colors" x-text="year">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
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
                    }
                }">
                    <div @click="toggle()" x-ref="btn" class="cursor-pointer">
                        <div
                            class="flex w-fit items-center gap-x-2 rounded-[3px] border border-[#E0E0E0] bg-white p-2 shadow-md dark:border-[#353434] dark:bg-[#353434]">
                            <div class="gap-x-0.75 flex items-center">
                                <x-ri-flag-line class="h-6 w-6" style="color: #EC0226" />
                                <p class="max-w-40 truncate text-[15px] text-[#121212] dark:text-white"
                                    x-text="selectedSeriesName"></p>
                            </div>
                            <div>
                                <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #EC0226" />
                            </div>
                        </div>
                    </div>
                    <template x-teleport="body">
                        <div x-show="open" @click.away="open = false" x-cloak :title="selectedSeriesName"
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
                                    :class="!selectedSeriesId ? 'bg-[#EC0226] bg-opacity-10 text-[#121212] dark:text-white' :
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
                                        :class="selectedSeriesId === series.seriesID ? 'bg-[#EC0226] bg-opacity-10 text-white' :
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

            {{-- GROUP FILTER --}}
            <div class="swiper-slide w-auto!" x-show="groupNameList.length > 0">
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
                                <x-ri-flag-line class="h-6 w-6" style="color: #007DFC" />
                                <p class="text-[15px] text-[#121212] dark:text-white"
                                    x-text="selectedGroupName || 'All Groups'"></p>
                            </div>
                            <div>
                                <x-ri-arrow-down-s-line class="h-3 w-3" style="color: #007DFC" />
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
                            class="absolute z-50 max-h-64 overflow-y-auto rounded-[3px] border border-[#E0E0E0] bg-white shadow-lg dark:border-[#353434] dark:bg-[#353434]">
                            <div class="py-1">
                                <button @click="selectGroup(null); open = false"
                                    :class="!selectedGroupName ? 'bg-[#007DFC] bg-opacity-10 text-[#121212] dark:text-white' :
                                        'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                    class="w-full px-4 py-2 text-left text-sm transition-colors">
                                    All Groups
                                </button>
                                <template x-for="name in groupNameList" :key="name">
                                    <button @click="selectGroup(name); open = false"
                                        :class="selectedGroupName === name ? 'bg-[#007DFC] bg-opacity-10 text-white' :
                                            'text-[#121212] dark:text-white hover:bg-gray-100 dark:hover:bg-[#171717]'"
                                        class="w-full px-4 py-2 text-left text-sm transition-colors" x-text="name">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    {{-- POINTS TABLE --}}
    <template x-if="groupsLoading">
        <div class="py-8 text-center text-sm text-[#A2A6A9]">Loading points table...</div>
    </template>

    <template x-if="!groupsLoading && selectedSeriesId && filteredGroups.length === 0">
        <div class="py-8 text-center text-sm text-[#A2A6A9]">No points table data found for this series.</div>
    </template>

    <template x-if="!groupsLoading && !selectedSeriesId">
        <div class="py-8 text-center text-sm text-[#A2A6A9]">Select a series to view the points table.</div>
    </template>

    <template x-for="group in filteredGroups" :key="group.groupId">
        <div class="mb-6">
            <h2 class="mb-2 text-lg font-semibold text-[#121212] dark:text-white" x-text="group.groupName"></h2>

            <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-none">
                <table class="w-full min-w-max text-left">
                    <thead class="bg-[#0A0E27] text-white dark:bg-[#1F1F1F]">
                        <tr>
                            <th class="px-4 py-4 text-xs font-semibold tracking-wide">RANK</th>
                            <th class="px-4 py-4 text-xs font-semibold tracking-wide">TEAM</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">MAT</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">WON</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">LOST</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">N/R</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">WIN%</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">NRR</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">PTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(team, index) in group.teams" :key="team.teamId">
                            <tr :class="index % 2 === 1 ? 'bg-gray-50 dark:bg-[#5B5A5A]' : 'bg-white dark:bg-[#515050]'"
                                class="cursor-pointer border-b border-gray-100 last:border-b-0 hover:bg-gray-100 dark:border-none">
                                <td class="px-4 py-4 text-[#121212] dark:text-white" x-text="team.rank"></td>
                                <td class="px-4 py-4 dark:text-white">
                                    <div class="flex items-center gap-x-3">
                                        <img :src="team.logo" :alt="team.name"
                                            class="h-8 w-8 shrink-0 rounded-full object-cover">
                                        <span class="text-[#121212] dark:text-white" x-text="team.name"></span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white"
                                    x-text="team.matches"></td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white" x-text="team.won">
                                </td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white" x-text="team.lost">
                                </td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white"
                                    x-text="team.noResult"></td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white"
                                    x-text="`${team.winPercentage.toFixed(2)}%`"></td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white"
                                    x-text="team.netRunRate.toFixed(2)"></td>
                                <td class="px-4 py-4 text-center text-[#121212] dark:text-white"
                                    x-text="team.points.toFixed(4)"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </template>

    {{-- PLAYER STAT AND SERIES HIGHLIGHT --}}
    <div class="mt-7.5 lg:mt-12.5 md:gap-x-5.5 md:flex md:flex-row-reverse">
        <div class="md:w-[50%] 2xl:w-[30%]">
            <h1 class="text-2xl font-semibold text-[#121212] dark:text-white">
                SERIES HIGHLIGHT
            </h1>

            @php
                // TODO: ganti dengan data asli dari controller
                // dots & activeDot nantinya di-drive oleh state slider (Swiper/GSAP), bukan hardcode
                $highlights = [
                    ['value' => 26, 'label' => 'Total Matches', 'dots' => 4, 'activeDot' => 0],
                    ['value' => 18, 'label' => 'Total Wins', 'dots' => 4, 'activeDot' => 0],
                    ['value' => 26, 'label' => 'Total Matches', 'dots' => 4, 'activeDot' => 0],
                    ['value' => 18, 'label' => 'Total Wins', 'dots' => 4, 'activeDot' => 0],
                    ['value' => 26, 'label' => 'Total Matches', 'dots' => 4, 'activeDot' => 0],
                    ['value' => 18, 'label' => 'Total Wins', 'dots' => 4, 'activeDot' => 0],
                ];
            @endphp

            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach ($highlights as $index => $item)
                    @php
                        // kolom genap (0, 2, 4...) = merah, kolom ganjil = biru
                        $isRed = $index % 2 === 0;

                        $gradientClass = $isRed
                            ? 'bg-[#EC0226] bg-[linear-gradient(to_bottom_left,rgba(194,75,93,0)_0%,#860116_100%)]'
                            : 'bg-[#0E2E75] bg-[linear-gradient(to_bottom_left,#1A56DB_0%,#0E2E75_100%)]';
                    @endphp

                    <div
                        class="{{ $gradientClass }} relative flex h-32 flex-col items-center justify-center overflow-hidden rounded-[7px]">

                        {{-- CONTENT LAYER — nanti ini yang jadi slide-nya kalau dipasang swiper --}}
                        <div class="flex flex-col items-center justify-center">
                            <p
                                class="text-[40px] font-semibold tracking-[2px] text-transparent [-webkit-text-fill-color:transparent] [-webkit-text-stroke:1px_#ffffff]">
                                {{ $item['value'] }}
                            </p>
                            <p class="text-base font-semibold text-white">{{ $item['label'] }}</p>
                        </div>

                        {{-- DOT INDICATOR — absolute, nempel di bawah card, independen dari content layer --}}
                        <div class="absolute bottom-3 left-1/2 flex -translate-x-1/2 items-center gap-1.5">
                            @for ($d = 0; $d < $item['dots']; $d++)
                                <span
                                    class="{{ $d === $item['activeDot'] ? 'bg-white' : 'bg-white/40' }} h-1.5 w-1.5 rounded-full transition-all duration-300"></span>
                            @endfor
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-5.5 md:mt-0 md:w-[50%] 2xl:w-[70%]">
            <h1 class="text-2xl font-semibold text-[#121212] dark:text-white">PLAYER STATS</h1>

            <x-tables.stat-table title="BATTING" columnLabel="RUNS" value-color="#1A56DB"
                dataExpr="battingStats" loadingExpr="playerStatsLoading" seeAllUrlExpr="battingSeeAllUrl" />

            <x-tables.stat-table title="BOWLING" columnLabel="WICKETS" value-color="#EC0226"
                dataExpr="bowlingStats" loadingExpr="playerStatsLoading" seeAllUrlExpr="bowlingSeeAllUrl" />

            <x-tables.stat-table title="FIELDING" columnLabel="DISMISSALS" value-color="#121212"
                dataExpr="fieldingStats" loadingExpr="playerStatsLoading" seeAllUrlExpr="fieldingSeeAllUrl" />
        </div>
    </div>

</div>
