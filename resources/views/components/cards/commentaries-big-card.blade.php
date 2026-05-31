<div>
    <div class="h-35.5 2xl:h-74 mb-4 w-full overflow-hidden rounded-[3px] md:mb-5 lg:h-60">
        {{-- <img src="{{ asset('images/dummy/commentaries/dummy-commentaries-1.webp') }}" alt="Commentaries Image"
            loading="lazy" class="w-full h-full object-cover"> --}}
        <img src="https://placehold.co/800x600" alt="Commentaries Image" loading="lazy" class="h-full w-full object-cover">
    </div>
    <div>
        <p class="mb-2 text-[13px] font-semibold text-[#666] md:mb-4 md:text-sm dark:text-[#B2B2B2]">Don't miss daily
            news</p>
        <h1 class="mb-2 text-lg font-semibold leading-[130%] text-[#121212] md:mb-4 md:text-[20px] dark:text-white">
            {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 8, '...') }}
        </h1>
        <div class="w-57 md:w-67.25 mb-7 flex items-center justify-between lg:h-fit 2xl:mb-0">
            <div class="flex items-center gap-x-2.5 text-[#121212] dark:text-white">
                <div class="h-9 w-9 overflow-hidden rounded-full">
                    {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="w-full h-full object-cover"> --}}
                    <img src="https://placehold.co/36x36" alt="Profile Picture" class="h-full w-full object-cover">
                </div>
                <p class="text-[10px] font-semibold md:text-sm"><span class="font-normal">By </span>Farhan Dudi</p>
            </div>
            <div class="flex items-center gap-x-2 text-[#121212] dark:text-white">
                <x-letsicon-time-atack class="h-5 w-5" />
                <span class="text-[10px] font-medium md:text-[13px]">19 JAN 2026</span>
            </div>
        </div>
    </div>
</div>
