@php
    $newsCards = [
        ['title' => 'Title Ipsum', 'description' => 'Description Ipsum', 'url' => '#'],
        ['title' => 'Title Ipsum', 'description' => 'Description Ipsum', 'url' => '#'],
        ['title' => 'Title Ipsum', 'description' => 'Description Ipsum', 'url' => '#'],
        ['title' => 'Title Ipsum', 'description' => 'Description Ipsum', 'url' => '#'],
    ];
@endphp

<div class="mt-25 mb-12.5 md:mb-8.75 mx-5 md:mx-10">
    <div
        class="flex flex-col items-center 2xl:container md:flex-row md:items-start lg:items-center lg:justify-between 2xl:mx-auto">
        <h1
            class="font-barlow-semi-condensed md:w-124 mb-5 text-center text-2xl font-bold text-[#434343] md:block md:text-left md:text-[54px] dark:text-white">
            WATCH
            OUR
            HIGHLIGHTED GAMES.
        </h1>
        <a href="" class="py-4.5 flex w-fit items-center justify-center gap-x-1.5 bg-[#B90F16] px-8 text-white">
            Youtube
            <svg width="13" height="13" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.4 13L0 11.6L9.6 2H1V0H13V12H11V3.4L1.4 13Z" fill="currentColor" />
            </svg>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4">
    @foreach ($newsCards as $card)
        <a href="{{ $card['url'] }}"
            class="h-118.25 md:h-122.75 lg:h-144.5 group relative block w-full overflow-hidden">

            {{-- Image --}}
            <img src="{{ asset('images/dummy/latest-news-card/dummy-latest-news-card.webp') }}"
                alt="{{ $card['title'] }}"
                class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">

            {{-- Dark overlay --}}
            <div
                class="bg-linear-to-b absolute inset-0 from-[#A6A182]/30 to-[#A6A182] opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            </div>

            {{-- Arrow button --}}
            <div
                class="h-16.5 w-16.5 absolute right-4 top-4 flex -translate-y-3 items-center justify-center rounded-full bg-[#97775B] text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.93846 18L0 16.0615L13.2923 2.76923H1.38462V0H18V16.6154H15.2308V4.70769L1.93846 18Z"
                        fill="currentColor" />
                </svg>

            </div>

            {{-- Title & description --}}
            <div
                class="absolute inset-x-0 bottom-0 translate-y-6 bg-white px-6 py-5 text-center opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100 dark:bg-[#1D1F20]">
                <h3 class="font-barlow-semi-condensed text-2xl font-bold uppercase text-[#434343] dark:text-white">
                    {{ $card['title'] }}</h3>
                <p class="mt-1.25 font-figtree text-xl font-medium leading-[135%] tracking-[-0.05em] text-[#97775B]">
                    {{ $card['description'] }}</p>
            </div>
        </a>
    @endforeach
</div>
