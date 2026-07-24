<div>
    {{-- HEADER --}}
    <div class="mb-6.25 flex items-center gap-x-3.5">
        <h1 class="text-2xl font-semibold text-[#121212] lg:text-4xl dark:text-white">POINTS TABLE
        </h1>
        <x-eva-info-outline class="h-6 w-6 text-[#EC0226]" />
    </div>

    {{-- FILTER --}}
    <div class="swiper points-table-filters-swiper mb-7.5 overflow-hidden">
        <div class="swiper-wrapper">
            <div class="swiper-slide w-auto!">
                <x-filter.filter-card icon="ri-time-line" category="Year" categoryValue="2026" iconColor="#EC0226" />
            </div>
            <div class="swiper-slide w-auto!">
                <x-filter.filter-card icon="ri-team-line" category="Team"
                    categoryValue="S'8 Sma Putri Walikota Cup Jakarta Timur" iconColor="#EC0226" />
            </div>
        </div>
    </div>

    {{-- POINTS TABLE --}}
    @php
        $teams = collect([
            (object) [
                'rank' => 1,
                'name' => 'Persatuan Cricket Indonesia',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 2,
                'lost' => 0,
                'no_result' => 0,
                'points' => 4.9167,
                'url' => '/teams/1',
            ],
            (object) [
                'rank' => 2,
                'name' => 'Garuda Cricket Club',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 1,
                'lost' => 1,
                'no_result' => 0,
                'points' => 2.4583,
                'url' => '/teams/2',
            ],
            (object) [
                'rank' => 3,
                'name' => 'Jakarta Timur Cricket Association',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 1,
                'lost' => 1,
                'no_result' => 0,
                'points' => 2.1,
                'url' => '/teams/3',
            ],
            (object) [
                'rank' => 4,
                'name' => 'Bandung Cricket League',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 0,
                'lost' => 2,
                'no_result' => 0,
                'points' => 0.5,
                'url' => '/teams/4',
            ],
            (object) [
                'rank' => 5,
                'name' => 'Surabaya United Cricket',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 0,
                'lost' => 2,
                'no_result' => 0,
                'points' => 0.0,
                'url' => '/teams/5',
            ],
            (object) [
                'rank' => 6,
                'name' => 'Surabaya United Cricket',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 0,
                'lost' => 2,
                'no_result' => 0,
                'points' => 0.0,
                'url' => '/teams/5',
            ],
            (object) [
                'rank' => 7,
                'name' => 'Surabaya United Cricket',
                'logo' => 'https://placehold.co/40x40',
                'matches' => 2,
                'won' => 0,
                'lost' => 2,
                'no_result' => 0,
                'points' => 0.0,
                'url' => '/teams/5',
            ],
        ]);
    @endphp

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
                    <th class="px-4 py-4 text-center text-xs font-semibold tracking-wide">PTS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $index => $team)
                    <tr onclick="window.location='{{ $team->url }}'"
                        class="{{ $index % 2 == 1 ? 'bg-gray-50 dark:bg-[#5B5A5A]' : 'bg-white dark:bg-[#515050]' }} cursor-pointer border-b border-gray-100 last:border-b-0 hover:bg-gray-100 dark:border-none">
                        <td class="px-4 py-4 text-[#121212] dark:text-white">{{ $team->rank }}</td>
                        <td class="px-4 py-4 dark:text-white">
                            <div class="flex items-center gap-x-3">
                                <img src="{{ $team->logo }}" alt="{{ $team->name }}"
                                    class="h-8 w-8 shrink-0 rounded-full object-cover">
                                <span class="text-[#121212] dark:text-white">{{ $team->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-center text-[#121212] dark:text-white">{{ $team->matches }}</td>
                        <td class="px-4 py-4 text-center text-[#121212] dark:text-white">{{ $team->won }}</td>
                        <td class="px-4 py-4 text-center text-[#121212] dark:text-white">{{ $team->lost }}</td>
                        <td class="px-4 py-4 text-center text-[#121212] dark:text-white">{{ $team->no_result }}</td>
                        <td class="px-4 py-4 text-center text-[#121212] dark:text-white">
                            {{ number_format($team->points, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
            @php
                // TODO: ganti collect() ini dengan data dari controller.
                // Field WAJIB seragam: name, avatar, value — biar 1 component bisa dipakai semua kategori.
                $statTables = [
                    [
                        'title' => 'BATTING',
                        'columnLabel' => 'RUNS',
                        'valueColor' => '#1A56DB',
                        'seeAllUrl' => '#',
                        'data' => collect([
                            (object) [
                                'name' => 'Farhan Dudi Prasetyo',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 42,
                            ],
                            (object) [
                                'name' => 'Rizky Alamsyah',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 38,
                            ],
                            (object) [
                                'name' => 'Bayu Setiawan',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 35,
                            ],
                        ]),
                    ],
                    [
                        'title' => 'BOWLING',
                        'columnLabel' => 'WICKETS',
                        'valueColor' => '#EC0226',
                        'seeAllUrl' => '#',
                        'data' => collect([
                            (object) [
                                'name' => 'Dimas Prayoga',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 5,
                            ],
                            (object) ['name' => 'Andika Putra', 'avatar' => 'https://placehold.co/40x40', 'value' => 4],
                        ]),
                    ],
                    [
                        'title' => 'RANKING',
                        'columnLabel' => 'POINTS',
                        'valueColor' => '#121212',
                        'seeAllUrl' => '#',
                        'data' => collect([
                            (object) [
                                'name' => 'Persatuan Cricket Indonesia',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 4.9167,
                            ],
                            (object) [
                                'name' => 'Garuda Cricket Club',
                                'avatar' => 'https://placehold.co/40x40',
                                'value' => 2.4583,
                            ],
                        ]),
                    ],
                ];
            @endphp

            @foreach ($statTables as $table)
                <x-tables.stat-table :title="$table['title']" :columnLabel="$table['columnLabel']" :data="$table['data']" :value-color="$table['valueColor']"
                    :see-all-url="$table['seeAllUrl']" />
            @endforeach
        </div>
    </div>
</div>
