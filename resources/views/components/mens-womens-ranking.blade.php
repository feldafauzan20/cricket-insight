<div x-data="{ activeTab: 'mens' }">
    {{-- Men's and Women's ranking tabs --}}
    <div class="flex justify-center bg-blue-500 rounded-t-[3px] overflow-hidden">
        <a href="#" @click.prevent="activeTab = 'mens'"
            class="block w-1/2 text-center font-semibold text-[10px] py-2.5 2xl:py-4 text-white"
            :class="activeTab === 'mens' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            MEN'S RANKING
        </a>
        <a href="#" @click.prevent="activeTab = 'womens'" 
            class="block w-1/2 text-center font-semibold text-[10px] py-2.5 2xl:py-4 text-white"
            :class="activeTab === 'womens' ? 'bg-[#D6111A]' : 'bg-[#222]'">
            WOMEN'S RANKING
        </a>
    </div>

    {{-- Ranking list --}}
    <div>
        {{-- MEN'S RANKING LIST --}}
        <div x-show="activeTab === 'mens'">
            @php
                $m1 = $mensRankings->get(0);
                $m2 = $mensRankings->get(1);
                $m3 = $mensRankings->get(2);
                $m4 = $mensRankings->get(3);
                $m5 = $mensRankings->get(4);
                $mId = $mensRankings->first(fn($r) => \Illuminate\Support\Str::lower($r->country_name) === 'indonesia');
            @endphp
            
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $m1->rank ?? 1)" 
                :flag="$m1 && $m1->flag_image ? asset('storage/' . $m1->flag_image) : ''" 
                :country="$m1->country_name ?? ''" 
                :points="$m1->score ?? '0'" 
                py="py-[30px]" 
                bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $m2->rank ?? 2)" 
                :flag="$m2 && $m2->flag_image ? asset('storage/' . $m2->flag_image) : ''" 
                :country="$m2->country_name ?? ''" 
                :points="$m2->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $m3->rank ?? 3)" 
                :flag="$m3 && $m3->flag_image ? asset('storage/' . $m3->flag_image) : ''" 
                :country="$m3->country_name ?? ''" 
                :points="$m3->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $m4->rank ?? 4)" 
                :flag="$m4 && $m4->flag_image ? asset('storage/' . $m4->flag_image) : ''" 
                :country="$m4->country_name ?? ''" 
                :points="$m4->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $m5->rank ?? 5)" 
                :flag="$m5 && $m5->flag_image ? asset('storage/' . $m5->flag_image) : ''" 
                :country="$m5->country_name ?? ''" 
                :points="$m5->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $mId->rank ?? 10)" 
                :flag="$mId && $mId->flag_image ? asset('storage/' . $mId->flag_image) : ''" 
                :country="$mId->country_name ?? ''" 
                :points="$mId->score ?? '0'" 
                py="py-[14px]" 
                bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" 
            />
        </div>

        {{-- WOMEN'S RANKING LIST --}}
        <div x-show="activeTab === 'womens'" style="display: none;">
            @php
                $w1 = $womensRankings->get(0);
                $w2 = $womensRankings->get(1);
                $w3 = $womensRankings->get(2);
                $w4 = $womensRankings->get(3);
                $w5 = $womensRankings->get(4);
                $wId = $womensRankings->first(fn($r) => \Illuminate\Support\Str::lower($r->country_name) === 'indonesia');
            @endphp
            
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $w1->rank ?? 1)" 
                :flag="$w1 && $w1->flag_image ? asset('storage/' . $w1->flag_image) : ''" 
                :country="$w1->country_name ?? ''" 
                :points="$w1->score ?? '0'" 
                py="py-[30px]" 
                bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $w2->rank ?? 2)" 
                :flag="$w2 && $w2->flag_image ? asset('storage/' . $w2->flag_image) : ''" 
                :country="$w2->country_name ?? ''" 
                :points="$w2->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $w3->rank ?? 3)" 
                :flag="$w3 && $w3->flag_image ? asset('storage/' . $w3->flag_image) : ''" 
                :country="$w3->country_name ?? ''" 
                :points="$w3->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $w4->rank ?? 4)" 
                :flag="$w4 && $w4->flag_image ? asset('storage/' . $w4->flag_image) : ''" 
                :country="$w4->country_name ?? ''" 
                :points="$w4->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $w5->rank ?? 5)" 
                :flag="$w5 && $w5->flag_image ? asset('storage/' . $w5->flag_image) : ''" 
                :country="$w5->country_name ?? ''" 
                :points="$w5->score ?? '0'" 
                bgColor="bg-white dark:bg-[#353434]" 
            />
            <x-cards.mens-womens-rangking-card 
                :rank="sprintf('%02d', $wId->rank ?? 10)" 
                :flag="$wId && $wId->flag_image ? asset('storage/' . $wId->flag_image) : ''" 
                :country="$wId->country_name ?? ''" 
                :points="$wId->score ?? '0'" 
                py="py-[14px]" 
                bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" 
            />
        </div>
    </div>

    {{-- Footer --}}
    <div class="bg-linear-to-r from-[#EC0226] to-[#007DFC] py-1.5 text-center rounded-b-[3px]">
        <span class="text-white font-semibold text-[11px]">Cricket Insight Live Score</span>
    </div>
</div>