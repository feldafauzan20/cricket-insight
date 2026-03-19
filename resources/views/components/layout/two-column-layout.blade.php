@props([
    'paddingRight' => '2xl:pr-5',
    'marginRight' => '2xl:mr-5',
])

<section class="2xl:container 2xl:mx-auto mt-4 md:mt-6 lg:mt-8.5 mb-6 lg:mb-7.5 2xl:flex">
    <div
        class="2xl:border-r 2xl:border-r-[#DEDEDE] dark:border-r-[#DEDEDE] {{ $paddingRight }} {{ $marginRight }} 2xl:w-7/10">
        {{ $main }}
    </div>
    <div class="2xl:w-3/10">
        {{ $sidebar }}
    </div>
</section>
