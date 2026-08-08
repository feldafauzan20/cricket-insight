@extends('layout.main-layout')

@section('title', $article->title . ' - Cricket Insight')

@section('content')

    @php
        use Illuminate\Support\Str;
        // Hitung estimasi waktu baca (200 kata per menit)
        $wordCount = str_word_count(strip_tags($article->content));
        $readTime = max(1, ceil($wordCount / 200));
    @endphp

    <section class="2xl:pt-30">
        <x-layout.two-column-layout paddingRight="2xl:pr-0" marginRight="2xl:mr-9" borderRight="2xl:border-none">
            <x-slot name="main">
                {{-- BREADCRUMB AND CATEGORY SECTION --}}
                <section
                    class="pt-30 md:pt-34 lg:pt-38 mb-3.25 md:mb-3.75 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto 2xl:pt-0">
                    <div class="mb-3.75">
                        <x-bread-crumb :items="[
                            ['title' => 'Home', 'url' => route('home', ['locale' => app()->getLocale()])],
                            ['title' => 'News', 'url' => route('news.index', ['locale' => app()->getLocale()])],
                            ['title' => $article->category->name ?? 'Category', 'url' => '#'],
                            ['title' => Str::words($article->title, 2, '...'), 'url' => '#'],
                        ]" />
                    </div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <x-cards.category.category-card :dotColor="'#EC0226'" :categoryName="$article->category->name ?? 'News'" />
                        @foreach ($article->tags as $tag)
                            <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="$tag->name" />
                        @endforeach
                    </div>
                </section>

                {{-- NEWS CONTENT SECTION --}}
                <section class="mb-7.5 mx-6 2xl:container md:mx-8 lg:mx-10 2xl:mx-auto">

                    {{-- TITLE --}}
                    <h1 class="text-[22px] font-medium leading-tight text-[#121212] md:text-[32px] dark:text-white">
                        {{ $article->title }}
                    </h1>

                    <div class="mb-3.75 mt-2.5 flex">
                        <div class="w-58 h-px bg-[#EC0226]"></div>
                        <div class="h-px w-full bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
                    </div>

                    {{-- INTRO --}}
                    <p class="mb-3.75 text-[15px] wrap-break-word italic leading-relaxed text-[#121212] dark:text-white">
                        {{ $article->description }}
                    </p>

                    {{-- AUTHOR INFO --}}
                    <div class="mb-7.5 flex items-center gap-x-2.5 md:gap-x-3">
                        <div class="md:w-11.25 md:h-11.25 h-9 w-9 shrink-0 overflow-hidden rounded-full">
                            <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Author"
                                class="h-full w-full object-cover">
                        </div>
                        <div>
                            <p class="mb-0.5 text-[13px] font-medium text-[#48494A] dark:text-white">
                                {{ $article->uploader->name ?? 'Admin' }}</p>
                            <div class="flex items-center gap-x-3 text-[13px] text-[#48494A] dark:text-white">
                                <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                                <span>/</span>
                                <span>{{ $readTime }} Min Read</span>
                            </div>
                        </div>
                    </div>

                    {{-- CONTENT BODY --}}
                    <div class="space-y-6">
                        {{-- HERO / THUMBNAIL --}}
                        <div class="h-58.5 md:h-109 lg:h-137 mb-7.5 overflow-hidden rounded-[5px] md:rounded-[10px]">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                    class="h-full w-full object-cover">
                            @elseif($article->foto1)
                                <img src="{{ asset('storage/' . $article->foto1) }}" alt="{{ $article->title }}"
                                    class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('images/dummy/hero-home/bg-hero-home.webp') }}" alt="Dummy News Image"
                                    class="h-full w-full object-cover">
                            @endif
                        </div>
                        @php
                            // 1. Pecah konten berdasarkan paragraf agar tidak rusak tag HTML-nya
                            $content = $article->content;
                            $paragraphs = explode('</p>', $content);

                            // Bersihkan array dari elemen kosong
                            $paragraphs = array_filter($paragraphs, fn($p) => trim(strip_tags($p)) !== '');

                            // 2. Hitung titik tengah
                            $totalParagraphs = count($paragraphs);
                            $midPoint = ceil($totalParagraphs / 2);

                            // 3. Bagi menjadi dua bagian
                            $part1 = array_slice($paragraphs, 0, $midPoint);
                            $part2 = array_slice($paragraphs, $midPoint);
                        @endphp

                        {{-- BAGIAN TEKS PERTAMA --}}
                        <div
                            class="prose dark:prose-invert max-w-none text-[15px] leading-[170%] text-[#121212] dark:text-[#EEEEEE] wrap-break-word">
                            @foreach ($part1 as $p)
                                {!! $p !!}</p>
                            @endforeach
                        </div>

                        {{-- FOTO 1 (Tengah) --}}
                        @if ($article->foto1)
                            <div class="my-8">
                                <div
                                    class="h-54.5 md:h-98.25 lg:h-136.75 overflow-hidden rounded-[5px] shadow-lg md:rounded-[15px]">
                                    <img src="{{ asset('storage/' . $article->foto1) }}" alt="Foto Tengah"
                                        class="h-full w-full object-cover">
                                </div>
                            </div>
                        @endif

                        {{-- BAGIAN TEKS KEDUA --}}
                        <div
                            class="prose dark:prose-invert max-w-none text-[15px] leading-[170%] text-[#121212] dark:text-[#EEEEEE] wrap-break-word">
                            @foreach ($part2 as $p)
                                {!! $p !!}</p>
                            @endforeach
                        </div>

                        {{-- FOTO 2 (Paling Bawah) --}}
                        @if ($article->foto2)
                            <div class="mb-7.5 mt-8">
                                <div
                                    class="h-54.5 md:h-98.25 lg:h-136.75 overflow-hidden rounded-[5px] shadow-lg md:rounded-[15px]">
                                    <img src="{{ asset('storage/' . $article->foto2) }}" alt="Foto Bawah"
                                        class="h-full w-full object-cover">
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- SHARE THIS ARTICLE --}}
                    <div>
                        {{-- SHARE ARTICLE TITLE --}}
                        <p class="mb-2.5 text-center text-[16px] font-medium leading-[163%] text-[#121212] dark:text-white">
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
                </section>
            </x-slot>

            <x-slot name="sidebar">
                <section class="mx-6 mb-7 md:mx-8 2xl:mx-0">
                    <x-popular-recent-news />
                </section>
            </x-slot>
        </x-layout.two-column-layout>
    </section>

    {{-- RELATED ARTICLES & FOOTER --}}
    <section class="dark:bg-[#121212]">
        <x-related-articles :category="$article->category_id" :exclude="$article->id" />
    </section>

    {{-- ADS SECTION START --}}
    <section class="lg:mt-7.5 md:mx-7.5 mx-6 mb-7 mt-6 2xl:container md:mb-6 lg:mx-10 lg:mb-10 2xl:mx-auto">
        <x-ads position="single_news_bottom" />
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

    <script>
        function copyToClipboard() {
            const urlInput = document.getElementById('shareUrl');
            urlInput.select();
            navigator.clipboard.writeText(urlInput.value).then(() => alert('Link copied!'));
        }
    </script>

@endsection
