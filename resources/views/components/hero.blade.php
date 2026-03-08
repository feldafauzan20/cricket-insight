<section class="relative">
    <img src="{{ asset('images/dummy/hero-home/bg-hero-home.jpg') }}" alt="Hero Image" width="1920" height="1080"
        fetchpriority="high" class="absolute inset-0 w-full h-full object-cover">

    <!-- Overlay gradient -->
    <div class="absolute inset-0 bg-linear-to-b from-black/0 to-black/50 w-full"></div>

    {{-- content --}}
    <div class="relative mx-6 pt-18 pb-8.5">
        {{-- Loading spinner dummy start --}}
        <div class="flex justify-end">
            <div class="w-10 h-10 border-2 border-[#EC0226] rounded-full border-l-[#48494A]">
            </div>
        </div>
        {{-- Loading spinner dummy end --}}

        <div class="bg-[#D6111A] w-fit py-1.5 px-5 rounded-[3px] mb-1">
            <span class="text-white font-medium text-xs">Matches</span>
        </div>

        <h1 class="font-semibold text-white text-2xl mb-2.5">Garuda Gentlemen, triumphed over the Dispora India team
        </h1>

        <p class="font-playfair-display text-xs text-white mb-2.5">As cricket continues to grow across the archipelago,
            we're
            bringing you stories
            from the pitch, updates from
            local leagues, and progress from national development programs.</p>

        <div class="w-57 flex justify-between items-center text-white">
            <div class="w-9 h-9 rounded-full overflow-hidden">
                <img src="{{ asset('images/dummy/hero-home/profile-pitcure-dummy.jpg') }}" alt=""
                    class="w-full h-full object-cover">
            </div>

            <p class="font-semibold text-[10px]">BY FARHAN DUDI</p>
            <div class="w-2.5 h-2.5 bg-[#EC0226] rounded-full"></div>
            <span class="font-semibold text-[10px]">19 JAN 2026</span>
        </div>


    </div>
</section>
