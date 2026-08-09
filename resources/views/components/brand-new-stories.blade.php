@props(['id' => "top-stories"])

<div class="mx-5 2xl:container md:mx-10 lg:flex lg:flex-col 2xl:mx-auto" id="{{ $id }}">
    <h1
        class="font-barlow-semi-condensed mb-8.75 md:mb-12.5 md:w-124 text-center text-2xl font-bold text-[#434343] md:mx-auto md:block md:text-[54px] dark:text-white">
        READ
        BBI’S BRAND NEW
        STORIES
    </h1>

    <div class="lg:gap-7.5 2xl:gap-8.5 flex flex-col gap-5 md:gap-11 lg:grid lg:grid-cols-3">
        @for ($i = 0; $i < 3; $i++)
            <x-cards.bbi-wbbi-card />
        @endfor
    </div>
</div>
