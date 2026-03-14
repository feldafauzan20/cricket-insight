<div
    class="flex items-center justify-between px-6 {{ $py ?? 'py-4' }} border-b border-b-[#C7C7C7] dark:border-b-[#515050] {{ $bgColor ?? 'bg-[#F9F9F9]' }} last:border-b-0">
    <div class="flex items-center gap-x-3">
        <span class="text-[#666] dark:text-white font-semibold text-[15px] w-7">{{ $rank }}</span>
        <span class="text-[#666] dark:text-white text-[15px]">|</span>
        <img src="{{ $flag }}" alt="{{ $country }} flag" class="w-6 h-4 object-cover rounded-sm">
        <span class="text-[#666] dark:text-white font-medium text-[15px]">{{ $country }}</span>
    </div>
    <span class="text-[#666] dark:text-white font-semibold text-[15px]">{{ $points }}</span>
</div>
