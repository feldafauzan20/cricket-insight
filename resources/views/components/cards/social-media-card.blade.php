<div data-social-url="{{ $url }}" data-social-name="{{ $name }}"
    class="social-media-card flex items-center gap-x-4 px-4 py-3.5 bg-white dark:bg-[#1F1F1F] border border-[#E5E5E5] dark:border-[#121212] rounded-[5px] hover:shadow-md transition-shadow cursor-pointer">
    <div class="w-9 h-9 flex items-center justify-center rounded-[5px] {{ $bgColor }}">
        {!! $icon !!}
    </div>
    <span class="text-[#666] dark:text-white font-medium text-[15px]">{{ $name }}</span>
</div>
