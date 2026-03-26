@extends('layout.main-layout')

@section('title', 'Gallery - Cricket Insight')

@section('content')

    {{-- HERO GALLERY WITH BREADCRUMB SECTION START --}}
    <section class="mb-17.5 bg-[#F3F3F3]">
        <x-hero.gallery-hero />
    </section>
    {{-- HERO GALLERY WITH BREADCRUMB SECTION END --}}

    {{-- HEADING SECTION START --}}
    <section class="md:mx-7.5 md:mb-7.75 lg:mb-12.5 mx-6 mb-7 2xl:container lg:mx-10 2xl:mx-auto">
        <h1 class="text-[22px] font-semibold text-[#121212] dark:text-white">Explore the story through visuals</h1>
        <p class="text-[13px] font-semibold text-[#666]">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="mt-3.75 flex">
            <div class="w-48.5 h-px bg-[#1069F7]"></div>
            <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
        </div>
    </section>
    {{-- HEADING SECTION END --}}

    {{-- GALLERY CONTENT SECTION START --}}
    <section class="mb-7 md:mb-10" x-data="{
        galleries: {{ Js::from($galleries) }},
        itemsToShow: 6,
        itemsPerLoad: 6,
        isLoading: false,
        get displayedGalleries() {
            return this.galleries;
        },
        get hasMore() {
            return this.itemsToShow < this.galleries.length;
        },
        loadMore() {
            this.isLoading = true;
            this.itemsToShow += this.itemsPerLoad;
            this.isLoading = false;
        }
    }">
        <div class="md:mx-7.5 mx-6 mb-7 2xl:container lg:mx-10 2xl:mx-auto">
            <x-gallery.gallery-wrapper :galleries="$galleries" />
        </div>
        {{-- SEE MORE BUTTON SECTION --}}
        <template x-if="hasMore || isLoading">
            <div>
                <div class="lg:my-12.5 my-10 h-px border border-dashed border-[#E0E0E0] dark:border-[#353434]"></div>

                <div class="flex justify-center">
                    {{-- Loading Spinner --}}
                    <div x-show="isLoading" x-transition class="flex items-center gap-x-3">
                        <svg class="h-5 w-5 animate-spin text-[#EC0226]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="text-[15px] font-medium text-[#666] dark:text-[#989292]">Loading more
                            galleries...</span>
                    </div>

                    {{-- See More Button --}}
                    <button x-show="!isLoading" @click="loadMore" x-transition
                        class="py-2.75 cursor-pointer rounded-[3px] border border-[#EFEFEF] bg-white px-6 text-[15px] font-medium text-[#232323] transition-colors hover:bg-[#F3F3F3] dark:border-[#353434] dark:bg-[#232323] dark:text-white dark:hover:bg-[#353434]">
                        SEE MORE
                    </button>
                </div>
            </div>
        </template>
    </section>
    {{-- GALLERY CONTENT SECTION END --}}

    {{-- SHARE THIS GALLERY SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container lg:mx-10 2xl:mx-auto">
        {{-- SHARE GALLERY TITLE --}}
        <p class="mb-2.5 text-center text-[16px] font-medium leading-[163%] text-[#121212] dark:text-white">
            Share
            Gallery</p>

        {{-- SOCIAL MEDIA ICONS --}}
        <div class="mb-6 flex justify-center gap-x-3.5">
            <div
                class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                    rel="noopener noreferrer">
                    <x-bi-facebook class="w-3.75 h-3.75 text-[#1977F2]" />
                </a>
            </div>
            <div
                class="p-3.25 cursor-pointer rounded-[5px] bg-white shadow-md transition-shadow hover:shadow-lg dark:bg-[#353434]">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"
                    rel="noopener noreferrer">
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
        <div class="md:max-w-125 flex items-center gap-x-2.5 bg-[#F7F7F7] px-2.5 py-2 md:mx-auto dark:bg-[#353434]">
            <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly
                class="flex-1 cursor-default bg-transparent text-[16px] leading-[163%] text-[#75788D] outline-none dark:text-[#75788D]">
            <button onclick="copyToClipboard()"
                class="shrink-0 rounded p-1.5 transition-colors hover:bg-[#EEEEEE] dark:hover:bg-[#4B4B4B]">
                <x-bi-clipboard class="h-4 w-4 text-[#EC0226] dark:text-white" />
            </button>
        </div>
    </section>
    {{-- SHARE THIS GALLERY SECTION END --}}

    {{-- ADS SECTION START --}}
    <section class="md:mx-7.5 mx-6 mb-7 2xl:container lg:mx-10 2xl:mx-auto">
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
