@extends('layout.main-layout')

@section('title', 'Single News - Cricket Insight')

@section('content')

    {{-- BREADCRUMB AND CATEGORY SECTION START  --}}
    <section class="pt-30 mx-6 md:mx-8 lg:mx-10 2xl:container 2xl:mx-auto mb-3.25">

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
    <section class="mx-6 md:mx-8 lg:mx-10 2xl:container 2xl:mx-auto">

        {{-- TITLE NEWS --}}
        <h1 class="text-[#121212] font-medium text-[22px]">
            {{ Str::words(
                'Garuda Gentlemen, triumphed over the Dispora India team in a thrilling encounter at the Cricket World Cup 2024',
                8,
                '...',
            ) }}
        </h1>

        {{-- SEPARATOR LINE --}}
        <div class="flex mt-2.5 mb-3.75">
            <div class="w-58 h-px bg-[#EC0226]"></div>
            <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
        </div>

        {{-- INTRODUCTION PARAGRAPH --}}
        <p class="text-[#121212] dark:text-[#EEEEEE] text-[15px] mb-3.75">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
        </p>

        {{-- AUTHOR, DATE, TIME READ, AND VIEW NEWS --}}
        <div class="flex items-center gap-x-2.5 mb-7.5">
            <div class="w-9 h-9 rounded-full overflow-hidden">
                <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.jpg') }}" alt="Profile Picture"
                    class="w-full h-full object-cover">
            </div>
            <div>
                <p class="font-medium text-[13px] mb-0.5 text-[#48494A]">Farhan Dudi</p>
                <div class="flex items-center gap-x-3">
                    <div class="flex items-center gap-x-2.25">
                        <p class="text-[13px] text-[#48494A]">April 16, 2025</p>
                        <p class="text-[13px] text-[#48494A]">/</p>
                        <p class="text-[13px] text-[#48494A]">4 Min Read</p>
                    </div>
                    <div class="flex items-center gap-x-1">
                        <x-bi-eye class="w-3.5 h-3.5 text-[#48494A]" />
                        <span class="text-[13px] text-[#48494A]">10</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- NEWS BODY --}}
        <div>
            <div class="rounded-[5px] overflow-hidden h-58.5 mb-7.5">
                <img src="{{ asset('images/dummy/hero-home/bg-hero-home.jpg') }}" alt="Dummy News Image"
                    class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col gap-y-6.25 mb-7.5">
                @for ($i = 0; $i < 5; $i++)
                    <div>
                        <p class="text-[#121212] dark:text-[#EEEEEE] text-[15px] leading-[163%]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur.
                        </p>
                    </div>
                @endfor
            </div>
            <div class="mb-7.5">
                <div class="rounded-[5px] overflow-hidden h-54.5 mb-2">
                    <img src="{{ asset('images/dummy/hero-home/bg-hero-home.jpg') }}" alt="Dummy News Image"
                        class="w-full h-full object-cover">
                </div>
                {{-- IMAGE CAPTION --}}
                <p class="text-[#555] italic text-[13px] leading-[163%] text-center">Lorem ipsum dolor sit amet
                    consectetur adipiscing elit. Ex sapien vitae pellentesque sem placerat in id.</p>
            </div>
            <div class="flex flex-col gap-y-6.25 mb-4.25">
                @for ($i = 0; $i < 5; $i++)
                    <div>
                        <p class="text-[#121212] dark:text-[#EEEEEE] text-[15px] leading-[163%]">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla
                            pariatur.
                        </p>
                    </div>
                @endfor
            </div>

            {{-- ANOTHER ONE NEWS RELATED --}}
            <div>
                <p class="text-[#121212] font-medium text-[15px] leading-[163%] mb-6.25">Don't Miss: <a href=""
                        class="text-[#EC0226] underline underline-offset-8">{{ Str::words('Garuda Gentlemen, triumphed over the Dispora India team in a thrilling encounter at the Cricket World Cup 2024', 8, '...') }}</a>
                </p>
                <div class="mb-11">
                    <div class="rounded-[5px] overflow-hidden h-54.5 mb-2">
                        <img src="{{ asset('images/dummy/hero-home/bg-hero-home.jpg') }}" alt="Dummy News Image"
                            class="w-full h-full object-cover">
                    </div>
                    {{-- IMAGE CAPTION --}}
                    <p class="text-[#555] italic text-[13px] leading-[163%] text-center">Lorem ipsum dolor sit amet
                        consectetur adipiscing elit. Ex sapien vitae pellentesque sem placerat in id.</p>
                </div>
                <p class="text-[#121212] dark:text-[#EEEEEE] text-[15px] leading-[163%] mb-7.5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.
                </p>
                <div class="flex items-center gap-x-2.5 mb-12.5">
                    <p class="text-[#121212] text-[15px] font-medium leading-[163%]">Tags: </p>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-cards.category.category-card :dotColor="'#EC0226'" :categoryName="'Cricket Champions'" />
                        <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="'Interviews'" />
                    </div>
                </div>

                {{-- SHARE THIS ARTICLE --}}
                <div>
                    {{-- SHARE ARTICLE TITLE --}}
                    <p class="text-[#121212] font-medium text-[16px] leading-[163%] mb-2.5 text-center">Share Article</p>

                    {{-- SOCIAL MEDIA ICONS --}}
                    <div class="flex gap-x-3.5 mb-6 justify-center">
                        <div
                            class="bg-white p-3.25 shadow-md rounded-[5px] cursor-pointer hover:shadow-lg transition-shadow">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener noreferrer">
                                <x-bi-facebook class="w-3.75 h-3.75 text-[#1877F2]" />
                            </a>
                        </div>
                        <div
                            class="bg-white p-3.25 shadow-md rounded-[5px] cursor-pointer hover:shadow-lg transition-shadow">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"
                                rel="noopener noreferrer">
                                <x-bi-twitter-x class="w-3.75 h-3.75 text-[#000000]" />
                            </a>
                        </div>
                        <div
                            class="bg-white p-3.25 shadow-md rounded-[5px] cursor-pointer hover:shadow-lg transition-shadow">
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                                <x-bi-instagram class="w-3.75 h-3.75 text-[#E4405F]" />
                            </a>
                        </div>
                        <div
                            class="bg-white p-3.25 shadow-md rounded-[5px] cursor-pointer hover:shadow-lg transition-shadow">
                            <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">
                                <x-bi-youtube class="w-3.75 h-3.75 text-[#FF0000]" />
                            </a>
                        </div>
                    </div>

                    {{-- SHARE LINK URL --}}
                    <div class="flex items-center gap-x-2.5 bg-[#F5F5F5] border border-[#E0E0E0] rounded-[5px] p-3">
                        <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly
                            class="flex-1 bg-transparent text-[#48494A] text-[13px] outline-none cursor-default">
                        <button onclick="copyToClipboard()"
                            class="shrink-0 p-1.5 hover:bg-[#EEEEEE] rounded transition-colors">
                            <x-bi-clipboard class="w-4 h-4 text-[#EC0226]" />
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- NEWS CONTENT SECTION END --}}

    {{-- RELATED ARTICLES SECTION START --}}
    <section class="dark:bg-[#171717]">
        <x-related-articles />
    </section>
    {{-- RELATED ARTICLES SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="mt-6 lg:mt-7.5 mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto mb-7 md:mb-6 lg:mb-10">
        <x-ads />
    </section>
    {{-- ADS SECTION END --}}

    {{-- STREAMING PARTNER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717] pb-5 md:pb-10 lg:pb-12.5 2xl:pb-20">
        <div class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
            <x-streaming-partner />
        </div>
    </section>
    {{-- STREAMING PARTNER SECTION END --}}

    {{-- FOOTER SECTION START --}}
    <section class="bg-[#FAFAFA] dark:bg-[#171717]">
        <div class="mx-6 md:mx-7.5 lg:mx-10 2xl:container 2xl:mx-auto">
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
