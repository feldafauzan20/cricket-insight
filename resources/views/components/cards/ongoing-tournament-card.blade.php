<div class="h-53.5 relative w-full overflow-hidden rounded-md">
    {{-- <img src="{{ $image }}" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 w-full h-full object-cover"> --}}
    <img src="https://placehold.co/1200x800" alt="Hero Image" width="1920" height="1080" loading="lazy"
        class="absolute inset-0 h-full w-full object-cover">

    <!-- Overlay gradient -->
    <div class="bg-radial absolute inset-0 w-full from-[#000080]/5 from-0% to-[#0A172A]/90 to-100%"></div>

    {{-- content --}}
    <div class="relative flex h-full flex-col items-center justify-center">
        <p class="text-[11px] font-semibold text-[#EC0226]">LIVE IN</p>
        {{-- COUNTDOWN TIMER --}}
        <div class="flex gap-x-1">
            {{-- HOUR --}}
            <div class="flex flex-col items-center">
                <span class="font-semibold text-white">03</span>
                <p class="text-[11px] font-semibold text-white">HR</p>
            </div>
            <span class="font-semibold text-white">:</span>
            {{-- MINUTE --}}
            <div class="flex flex-col items-center">
                <span class="font-semibold text-white">15</span>
                <p class="text-[11px] font-semibold text-white">MIN</p>
            </div>
            <span class="font-semibold text-white">:</span>
            {{-- SECOND --}}
            <div class="flex flex-col items-center">
                <span class="font-semibold text-white">42</span>
                <p class="text-[11px] font-semibold text-white">SEC</p>
            </div>
        </div>
    </div>
</div>
<div class="px-7.5 pt-6.25 pb-3.75 relative rounded-b-[5px] bg-white shadow-lg">
    {{-- Tournament Title --}}
    <h1 class="font-semibold text-[#121212]">{{ Str::words('Mali v Sierra Leone', 5, '...') }}</h1>

    {{-- Tournament Description --}}
    <p class="mt-2 text-[11px] text-[#666]">
        {{ Str::words('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies lacinia, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc.', 15, '...') }}
    </p>

    {{-- Line separator --}}
    <hr class="my-3.75 border-t border-[#E0E0E0]">

    {{-- DATE AND TIME --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-x-2.5">
            <span class="text-[11px] font-medium text-[#666]">Date: </span>
            <span class="text-[17px] font-semibold text-[#121212]">Jun 06, 2024</span>
        </div>
        <div class="flex items-center gap-x-2.5">
            <x-letsicon-time-atack class="h-4 w-4 text-[#EC0226]" />
            <span class="text-[11px] font-medium text-[#666666]">14.30</span>
        </div>
    </div>
</div>
