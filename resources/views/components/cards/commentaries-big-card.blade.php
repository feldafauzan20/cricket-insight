<div>
    <div class="w-full h-35.5 lg:h-60 2xl:h-74 rounded-[3px] overflow-hidden mb-4 md:mb-5">
        <img src="{{ asset('images/dummy/commentaries/dummy-commentaries-1.webp') }}" alt="Commentaries Image"
            loading="lazy" class="w-full h-full object-cover">
    </div>
    <div>
        <p class="text-[13px] md:text-sm font-semibold text-[#666] dark:text-[#B2B2B2] mb-2 md:mb-4">Don't miss daily
            news</p>
        <h1 class="text-[#121212] dark:text-white font-semibold text-lg md:text-[20px] leading-[130%] mb-2 md:mb-4">
            {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}
        </h1>
        <div class="w-57 md:w-67.25 lg:h-fit flex justify-between items-center mb-7 2xl:mb-0">
            <div class="flex items-center text-[#121212] dark:text-white gap-x-2.5">
                <div class="w-9 h-9 rounded-full overflow-hidden">
                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="w-full h-full object-cover">
                </div>
                <p class="font-semibold text-[10px] md:text-sm"><span class="font-normal">By </span>Farhan Dudi</p>
            </div>
            <div class="flex items-center gap-x-2 text-[#121212] dark:text-white">
                <x-letsicon-time-atack class="w-5 h-5" />
                <span class="font-medium text-[10px] md:text-[13px]">19 JAN 2026</span>
            </div>
        </div>
    </div>
</div>
