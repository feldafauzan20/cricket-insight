@props(['title', 'columnLabel', 'valueColor' => '#1A56DB', 'dataExpr', 'loadingExpr', 'seeAllUrlExpr' => "'#'"])
{{-- $dataExpr & $loadingExpr & $seeAllUrlExpr adalah nama expression Alpine (string), bukan data PHP --}}
{{-- $dataExpr wajib berupa array of {name, avatar, value} --}}

<div class="mt-4 overflow-hidden rounded-xl border border-gray-100 dark:border-none">

    {{-- TITLE BAR --}}
    <div class="bg-linear-to-r from-[#0A0E27] to-[#1E3A6E] px-5 py-4 dark:bg-[#1F1F1F] dark:bg-none">
        <h2 class="text-lg font-bold tracking-wide text-white 2xl:text-[22px]">{{ $title }}</h2>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 dark:bg-[#353434]">
                <th scope="col"
                    class="px-5 py-3 text-sm font-bold tracking-wide text-[#121212] 2xl:text-[22px] dark:text-white">
                    PLAYER
                </th>
                <th scope="col"
                    class="px-5 py-3 text-right text-sm font-bold tracking-wide text-[#121212] 2xl:text-[22px] dark:text-white">
                    {{ $columnLabel }}</th>
            </tr>
        </thead>
        <tbody>
            <template x-if="{{ $loadingExpr }}">
                <tr>
                    <td colspan="2" class="px-5 py-6 text-center text-sm text-gray-400">Loading...</td>
                </tr>
            </template>

            <template x-if="!({{ $loadingExpr }}) && {{ $dataExpr }}.length === 0">
                <tr>
                    <td colspan="2" class="px-5 py-6 text-center text-sm text-gray-400">Belum ada data</td>
                </tr>
            </template>

            <template x-for="(player, index) in {{ $dataExpr }}" :key="player.name + index">
                <tr
                    :class="index % 2 === 1 ? 'bg-gray-50 dark:bg-[#5B5A5A]' : 'bg-white dark:bg-[#515050]'"
                    class="border-b border-gray-100 last:border-b-0 dark:border-none">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-x-3">
                            <img :src="player.avatar" :alt="player.name"
                                class="h-8 w-8 shrink-0 rounded-full object-cover dark:text-white">
                            <span class="text-[#121212] dark:text-white" x-text="player.name"></span>
                        </div>
                    </td>
                    <td class="text-(--value-color)] px-5 py-3 text-right font-bold dark:text-white"
                        style="--value-color: {{ $valueColor }}" x-text="player.value">
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <a :href="{{ $seeAllUrlExpr }}" target="__blank"
        class="flex items-center justify-center gap-x-1 bg-gray-50 py-4 text-[#121212] hover:bg-gray-100 dark:bg-[#353434]">
        <span class="font-medium dark:text-white">See all</span>
        <x-ri-arrow-right-s-line class="h-6 w-6 text-gray-400 dark:text-white" />
    </a>

</div>
