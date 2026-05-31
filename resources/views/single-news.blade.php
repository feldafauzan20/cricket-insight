@extends('layout.main-layout')

@section('title', 'Single News - Cricket Insight')

@section('content')

    <section class="2xl:pt-30">
        <x-layout.two-column-layout paddingRight="2xl:pr-0" marginRight="2xl:mr-9" borderRight="2xl:border-none">
            <x-slot name="main">
                {{-- BREADCRUMB AND CATEGORY SECTION START  --}}
                <section
                    class="pt-30 md:pt-34 lg:pt-38 mb-3.25 md:mb-3.75 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto 2xl:pt-0">

                    {{-- BREADCRUMB --}}
                    <div class="mb-3.75">
                        <x-bread-crumb :items="[
                            ['title' => 'Home', 'url' => '/'],
                            ['title' => 'News', 'url' => '/news'],
                            ['title' => 'Global', 'url' => '/news/global'],
                            [
                                'title' => Str::words(
                                    'Garuda Gentlemen, triumphed over the Dispora India team in a thrilling encounter at the Cricket World Cup 2024',
                                    2,
                                    '...',
                                ),
                            ],
                        ]" />
                    </div>

                    {{-- CATEGORY --}}
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-cards.category.category-card :dotColor="'#EC0226'" :categoryName="'Match Results'" />
                        <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="'Leagues'" />
                    </div>
                </section>
                {{-- BREADCRUMB AND CATEGORY SECTION END  --}}

                {{-- NEWS CONTENT SECTION START --}}
                <section class="mb-7.5 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">

                    {{-- TITLE NEWS --}}
                    <h1 class="text-[22px] font-medium text-[#121212] dark:text-white">
                        {{ Str::words(
                            'Garuda Gentlemen, triumphed over the Dispora India team in a thrilling encounter at the Cricket World Cup 2024',
                            8,
                            '...',
                        ) }}
                    </h1>

                    {{-- SEPARATOR LINE --}}
                    <div class="mb-3.75 mt-2.5 flex">
                        <div class="w-58 h-px bg-[#EC0226]"></div>
                        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
                    </div>

                    {{-- INTRODUCTION PARAGRAPH --}}
                    <p class="mb-3.75 text-[15px] text-[#121212] dark:text-white">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et
                        dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                        ea
                        commodo
                        consequat.
                    </p>

                    {{-- AUTHOR, DATE, TIME READ, AND VIEW NEWS --}}
                    <div class="mb-7.5 flex items-center gap-x-2.5 md:gap-x-3">
                        <div class="md:w-11.25 md:h-11.25 h-9 w-9 overflow-hidden rounded-full">
                            {{-- <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}"
                                alt="Profile Picture" class="w-full h-full object-cover"> --}}
                            <img src="https://placehold.co/36x36" alt="Profile Picture" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="mb-0.5 text-[13px] font-medium text-[#48494A] dark:text-white">Farhan Dudi</p>
                            <div class="flex items-center gap-x-3">
                                <div class="gap-x-2.25 flex items-center">
                                    <p class="text-[13px] text-[#48494A] dark:text-white">April 16, 2025</p>
                                    <p class="text-[13px] text-[#48494A] dark:text-white">/</p>
                                    <p class="text-[13px] text-[#48494A] dark:text-white">4 Min Read</p>
                                </div>
                                <div class="flex items-center gap-x-1">
                                    <x-bi-eye class="h-3.5 w-3.5 text-[#48494A] dark:text-white" />
                                    <span class="text-[13px] text-[#48494A] dark:text-white">10</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- NEWS BODY --}}
                    <div>
                        <div class="h-58.5 md:h-109 lg:h-137 mb-7.5 overflow-hidden rounded-[5px] md:rounded-[10px]">
                            {{-- <img src="{{ asset('images/dummy/hero-home/bg-hero-home.webp') }}" alt="Dummy News Image"
                                class="w-full h-full object-cover"> --}}
                            <img src="https://placehold.co/1200x600" alt="Dummy News Image"
                                class="h-full w-full object-cover">
                        </div>
                        <div class="gap-y-6.25 mb-7.5 md:max-w-145.5 lg:max-w-193.25 flex flex-col md:mx-auto">
                            @for ($i = 0; $i < 5; $i++)
                                <div>
                                    <p class="text-[15px] leading-[163%] text-[#121212] dark:text-[#EEEEEE]">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit
                                        in
                                        voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                    </p>
                                </div>
                            @endfor
                        </div>
                        <div class="mb-7.5">
                            <div class="h-54.5 md:h-98.25 lg:h-136.75 mb-2 overflow-hidden rounded-[5px] md:rounded-[15px]">
                                {{-- <img src="{{ asset('images/dummy/hero-home/bg-hero-home.webp') }}" alt="Dummy News Image"
                                    class="w-full h-full object-cover"> --}}
                                <img src="https://placehold.co/1200x600" alt="Dummy News Image"
                                    class="h-full w-full object-cover">
                            </div>
                            {{-- IMAGE CAPTION --}}
                            <p class="text-center text-[13px] italic leading-[163%] text-[#555]">Lorem ipsum dolor sit amet
                                consectetur adipiscing elit. Ex sapien vitae pellentesque sem placerat in id.</p>
                        </div>
                        <div
                            class="gap-y-6.25 mb-4.25 lg:mb-7.5 md:max-w-145.5 lg:max-w-193.25 flex flex-col md:mx-auto md:mb-12">
                            @for ($i = 0; $i < 5; $i++)
                                <div>
                                    <p class="text-[15px] leading-[163%] text-[#121212] dark:text-[#EEEEEE]">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                        ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit
                                        in
                                        voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                    </p>
                                </div>
                            @endfor
                        </div>

                        {{-- ANOTHER ONE NEWS RELATED --}}
                        <div class="md:max-w-145.5 lg:max-w-193.25 md:mx-auto">
                            <p class="mb-6.25 text-[15px] font-medium leading-[163%] text-[#121212] dark:text-white">Don't
                                Miss: <a href=""
                                    class="text-[#EC0226] underline underline-offset-8">{{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team in a thrilling encounter at the Cricket World Cup 2024', 8, '...') }}</a>
                            </p>
                            <div class="md:mb-7.5 mb-11">
                                <div
                                    class="h-54.5 md:h-81.5 lg:h-114.75 mb-2 overflow-hidden rounded-[5px] md:rounded-[15px]">
                                    {{-- <img src="{{ asset('images/dummy/hero-home/bg-hero-home.webp') }}"
                                        alt="Dummy News Image" class="w-full h-full object-cover"> --}}
                                    <img src="https://placehold.co/1200x600" alt="Dummy News Image"
                                        class="h-full w-full object-cover">
                                </div>
                                {{-- IMAGE CAPTION --}}
                                <p class="text-center text-[13px] italic leading-[163%] text-[#555]">Lorem ipsum dolor sit
                                    amet
                                    consectetur adipiscing elit. Ex sapien vitae pellentesque sem placerat in id.</p>
                            </div>
                            <p class="mb-7.5 text-[15px] leading-[163%] text-[#121212] dark:text-[#EEEEEE]">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae
                                pellentesque
                                sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam
                                urna
                                tempor.
                                Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada
                                lacinia
                                integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora
                                torquent
                                per
                                conubia nostra inceptos himenaeos.
                            </p>
                            <div class="mb-12.5 flex flex-wrap items-center gap-2.5">
                                <p class="text-[15px] font-medium leading-[163%] text-[#121212] dark:text-white">Tags: </p>
                                <div class="flex flex-wrap items-center gap-2.5">
                                    <x-cards.category.category-card :dotColor="'#EC0226'" :categoryName="'Cricket Champions'" />
                                    <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="'Interviews'" />
                                </div>
                            </div>

                            {{-- SHARE THIS ARTICLE --}}
                            <div>
                                {{-- SHARE ARTICLE TITLE --}}
                                <p
                                    class="mb-2.5 text-center text-[16px] font-medium leading-[163%] text-[#121212] dark:text-white">
                                    Share
                                    Article</p>

                                {{-- SOCIAL MEDIA ICONS --}}
                                <div class="mb-6 flex justify-center gap-x-3.5">
                                    <div
                                        class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <x-bi-facebook class="w-3.75 h-3.75 text-[#1977F2]" />
                                        </a>
                                    </div>
                                    <div
                                        class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <x-bi-twitter-x class="w-3.75 h-3.75 text-[#000000] dark:text-white" />
                                        </a>
                                    </div>
                                    <div
                                        class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                                            <x-bi-instagram class="w-3.75 h-3.75 text-[#E4405F]" />
                                        </a>
                                    </div>
                                    <div
                                        class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                                        <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">
                                            <x-bi-youtube class="w-3.75 h-3.75 text-[#FF0000]" />
                                        </a>
                                    </div>
                                </div>

                                {{-- SHARE LINK URL --}}
                                <div
                                    class="md:max-w-125 flex items-center gap-x-2.5 bg-[#F7F7F7] px-2.5 py-2 md:mx-auto dark:bg-[#353434]">
                                    <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly
                                        class="flex-1 cursor-default bg-transparent text-[16px] leading-[163%] text-[#75788D] outline-none dark:text-[#75788D]">
                                    <button onclick="copyToClipboard()"
                                        class="shrink-0 rounded p-1.5 transition-colors hover:bg-[#EEEEEE] dark:hover:bg-[#4B4B4B]">
                                        <x-bi-clipboard class="h-4 w-4 text-[#EC0226] dark:text-white" />
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                {{-- NEWS CONTENT SECTION END --}}
            </x-slot>
            <x-slot name="sidebar">
                {{-- POPULAR & RECENT NEWS SECTION START --}}
                <section class="mx-6 mb-7 md:mx-8 md:mb-0 lg:mb-7 2xl:mx-0">
                    <x-popular-recent-news />
                </section>
                {{-- POPULAR & RECENT NEWS SECTION END --}}
            </x-slot>
        </x-layout.two-column-layout>
    </section>

    {{-- RELATED ARTICLES SECTION START --}}
    <section class="dark:bg-[#121212]">
        <x-related-articles />
    </section>
    {{-- RELATED ARTICLES SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="lg:mt-7.5 md:mx-7.5 mx-6 mb-7 mt-6 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="lg:pb-12.5 bg-[#FAFAFA] pb-5 md:pb-10 2xl:pb-20 dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="md:mx-7.5 mx-6 2xl:container lg:mx-10 2xl:mx-auto">
            <x-footer />
        </div>
    </section>
    {{-- FOOTER SECTION END --}}

    {{-- COPY TO CLIPBOARD SCRIPT --}}
    <script>
        function copyToClipboard() {
            const urlInput = document.getElementById('shareUrl');
            urlInput.select();
            urlInput.setSelectionRange(0, 99999); // For mobile devices

            navigator.clipboard.writeText(urlInput.value).then(() => {
                // Optional: Show success feedback
                alert('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>

@endsection
