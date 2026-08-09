<div
    class="{{ $py ?? 'py-4' }} {{ $bgColor ?? 'bg-[#F9F9F9]' }} flex items-center justify-between border-b border-b-[#C7C7C7] px-6 last:border-b-0 dark:border-b-[#515050]">
    <div class="flex items-center gap-x-3">
        <span class="w-7 text-[15px] font-semibold text-[#666] dark:text-white">{{ $rank }}</span>
        <span class="text-[15px] text-[#666] dark:text-white">|</span>
        <img src="{{ $flag }}" alt="{{ $country }} flag" class="w-6 h-4 object-cover rounded-sm">
        {{-- <img src="https://placehold.co/24x16" alt="{{ $country }} flag" class="h-4 w-6 rounded-sm object-cover"> --}}
        <span class="text-[15px] font-medium text-[#666] dark:text-white">{{ $country }}</span>
    </div>
    <span class="text-[15px] font-semibold text-[#666] dark:text-white">{{ $points }}</span>
</div>
