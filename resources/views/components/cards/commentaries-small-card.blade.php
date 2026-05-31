<div class="2xl:mr-15 border-b border-b-[#DEDEDE] py-5">
    <div class="flex items-stretch gap-x-10">
        <div class="w-25 2xl:h-25 shrink-0 overflow-hidden rounded-[3px]">
            {{-- <img src="{{ asset('images/dummy/commentaries/dummy-commentaries-small-card.webp') }}"
                alt=" Commentaries Image" loading="lazy" class="w-full h-full object-cover object-center"> --}}
            <img src="https://placehold.co/400x400" alt=" Commentaries Image" loading="lazy"
                class="h-full w-full object-cover object-center">
        </div>
        <div class="w-full">
            <div class="mb-1 flex items-center gap-x-2 text-[#666666] dark:text-[#B2B2B2]">
                <x-letsicon-time-atack class="h-5 w-5" />
                <span class="text-[10px] font-medium md:text-sm">19 JAN 2026</span>
            </div>
            <h1
                class="mb-1 text-[16px] font-semibold leading-[130%] text-[#121212] md:text-[15px] 2xl:mb-3.5 dark:text-white">
                {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 5, '...') }}
            </h1>
            <div class="flex items-center gap-x-2.5 text-[#666] dark:text-[#B2B2B2]">
                <div class="h-5 w-5 overflow-hidden rounded-full">
                    {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Profile Picture"
                        class="w-full h-full object-cover"> --}}
                    <img src="https://placehold.co/20x20" alt="Profile Picture" class="h-full w-full object-cover">
                </div>
                <p class="text-[10px] font-semibold md:text-sm"><span class="font-normal">By </span>Farhan Dudi</p>
            </div>
        </div>
    </div>
</div>
