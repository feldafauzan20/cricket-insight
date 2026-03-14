<div>
    {{-- Men's and Women's ranking tabs --}}
    <div class="flex justify-center bg-blue-500 rounded-t-[3px] overflow-hidden">
        <a href=""
            class="block w-1/2 text-center font-semibold bg-[#D6111A] text-[10px] py-2.5 2xl:py-4 text-white">
            MEN'S RANKING
        </a>
        <a href="" class="block w-1/2 text-center font-semibold bg-[#222] text-[10px] py-2.5 2xl:py-4 text-white">
            WOMEN'S RANKING
        </a>
    </div>

    {{-- Ranking list --}}
    <div>
        <x-cards.mens-womens-rangking-card rank="01" flag="https://flagcdn.com/in.svg" country="India" points="5"
            py="py-[30px]" bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" />
        <x-cards.mens-womens-rangking-card rank="02" flag="https://flagcdn.com/nz.svg" country="New Zealand"
            points="109" bgColor="bg-white dark:bg-[#353434]" />
        <x-cards.mens-womens-rangking-card rank="03" flag="https://flagcdn.com/au.svg" country="Australia"
            points="109" bgColor="bg-white dark:bg-[#353434]" />
        <x-cards.mens-womens-rangking-card rank="04" flag="https://flagcdn.com/pk.svg" country="Pakistan"
            points="109" bgColor="bg-white dark:bg-[#353434]" />
        <x-cards.mens-womens-rangking-card rank="05" flag="https://flagcdn.com/za.svg" country="South Africa"
            points="109" bgColor="bg-white dark:bg-[#353434]" />
        <x-cards.mens-womens-rangking-card rank="10" flag="https://flagcdn.com/id.svg" country="Indonesia"
            points="109" py="py-[14px]" bgColor="bg-[#EEEEEE] dark:bg-[#1F1F1F]" />
    </div>

    {{-- Footer --}}
    <div class="bg-linear-to-r from-[#EC0226] to-[#007DFC] py-1.5 text-center rounded-b-[3px]">
        <span class="text-white font-semibold text-[11px]">Cricket Insight Live Score</span>
    </div>
</div>
