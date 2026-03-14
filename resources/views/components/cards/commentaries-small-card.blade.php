<div class="py-5 border-b border-b-[#DEDEDE] 2xl:mr-15">
    <div class="flex gap-x-10 items-stretch">
        <div class="w-25 2xl:h-25 overflow-hidden rounded-[3px] shrink-0">
            <img src="{{ asset('images/dummy/commentaries/dummy-commentaries-small-card.jpg') }}"
                alt=" Commentaries Image" loading="lazy" class="w-full h-full object-cover object-center">
        </div>
        <div class="w-full">
            <div class="flex items-center gap-x-2 text-[#666666] dark:text-[#B2B2B2] mb-1">
                <x-letsicon-time-atack class="w-5 h-5" />
                <span class="font-medium text-[10px] md:text-sm">19 JAN 2026</span>
            </div>
            <h1
                class="text-[#121212] dark:text-white font-semibold text-[16px] md:text-[15px] leading-[130%] mb-1 2xl:mb-3.5">
                {{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team', 5, '...') }}
            </h1>
            <div class="flex items-center text-[#666] dark:text-[#B2B2B2] gap-x-2.5">
                <div class="w-5 h-5 rounded-full overflow-hidden">
                    <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.jpg') }}" alt="Profile Picture"
                        class="w-full h-full object-cover">
                </div>
                <p class="font-semibold text-[10px] md:text-sm"><span class="font-normal">By </span>Farhan Dudi</p>
            </div>
        </div>
    </div>
</div>
