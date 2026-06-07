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
            <section class="pt-30 md:pt-34 lg:pt-38 2xl:pt-0 mx-6 md:mx-8 lg:mx-10 2xl:container 2xl:mx-auto mb-3.25 md:mb-3.75">
                <div class="mb-3.75">
                    <x-bread-crumb :items="[
                        ['title' => 'Home', 'url' => '/'],
                        ['title' => 'News', 'url' => '/news'],
                        ['title' => $article->category->name ?? 'Category', 'url' => '#'],
                        ['title' => Str::words($article->title, 2, '...'), 'url' => '#'],
                    ]" />
                </div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-cards.category.category-card :dotColor="'#EC0226'" :categoryName="$article->category->name ?? 'News'" />
                    @foreach($article->tags as $tag)
                        <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="$tag->name" />
                    @endforeach
                </div>
            </section>

            {{-- NEWS CONTENT SECTION --}}
            <section class="mx-6 md:mx-8 lg:mx-10 2xl:container 2xl:mx-auto mb-7.5">
                
                {{-- TITLE --}}
                <h1 class="text-[#121212] dark:text-white font-medium text-[22px] md:text-[32px] leading-tight">
                    {{ $article->title }}
                </h1>

                <div class="flex mt-2.5 mb-3.75">
                    <div class="w-58 h-px bg-[#EC0226]"></div>
                    <div class="w-full h-px bg-[#C7C7C7] dark:bg-[#DEDEDE]"></div>
                </div>

                {{-- INTRO --}}
                <p class="text-[#121212] dark:text-white text-[15px] mb-3.75 leading-relaxed italic">
                    {{ $article->description }}
                </p>

                {{-- AUTHOR INFO --}}
                <div class="flex items-center gap-x-2.5 md:gap-x-3 mb-7.5">
                    <div class="w-9 md:w-11.25 h-9 md:h-11.25 rounded-full overflow-hidden shrink-0">
                        <img src="{{ asset('images/dummy/hero-home/profile-picture-dummy.webp') }}" alt="Author" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-medium text-[13px] mb-0.5 text-[#48494A] dark:text-white">{{ $article->uploader->name ?? 'Admin' }}</p>
                        <div class="flex items-center gap-x-3 text-[13px] text-[#48494A] dark:text-white">
                            <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                            <span>/</span>
                            <span>{{ $readTime }} Min Read</span>
                        </div>
                    </div>
                </div>

                {{-- CONTENT BODY --}}
                <div>
                    {{-- THUMBNAIL UTAMA --}}
                    @if($article->thumbnail)
                        <div class="rounded-[5px] md:rounded-[10px] overflow-hidden h-58.5 md:h-109 lg:h-137 mb-7.5">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    {{-- ARTICLE TEXT --}}
                    <div class="prose dark:prose-invert max-w-none text-[#121212] dark:text-[#EEEEEE] text-[15px] leading-[170%] mb-7.5">
                        {!! $article->content !!}
                    </div>

                    {{-- FOTO 1 --}}
                    @if($article->foto1)
                        <div class="mb-7.5">
                            <div class="rounded-[5px] md:rounded-[15px] overflow-hidden h-54.5 md:h-98.25 lg:h-136.75 mb-2">
                                <img src="{{ asset('storage/' . $article->foto1) }}" alt="News Photo 1" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    {{-- FOTO 2 --}}
                    @if($article->foto2)
                        <div class="mb-7.5">
                            <div class="rounded-[5px] md:rounded-[15px] overflow-hidden h-54.5 md:h-98.25 lg:h-136.75 mb-2">
                                <img src="{{ asset('storage/' . $article->foto2) }}" alt="News Photo 2" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    {{-- SHARE & TAGS --}}
                    <div class="flex flex-wrap items-center gap-2.5 mb-12.5 border-t pt-10 border-gray-200">
                        <p class="text-[#121212] dark:text-white text-[15px] font-medium">Tags: </p>
                        @foreach($article->tags as $tag)
                            <x-cards.category.category-card :dotColor="'#007DFC'" :categoryName="$tag->name" />
                        @endforeach
                    </div>

                    {{-- SHARE BUTTONS --}}
                    <div class="bg-gray-50 dark:bg-[#1a1a1a] p-6 rounded-lg">
                        <p class="text-[#121212] dark:text-white font-medium text-center mb-4">Share Article</p>
                        <div class="flex gap-4 justify-center mb-6">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="p-3 bg-white rounded shadow hover:bg-gray-100"><x-bi-facebook class="w-5 h-5 text-[#1977F2]" /></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="p-3 bg-white rounded shadow hover:bg-gray-100"><x-bi-twitter-x class="w-5 h-5 text-black" /></a>
                        </div>
                        <div class="flex items-center gap-x-2.5 bg-[#F7F7F7] dark:bg-[#353434] py-2 px-3 rounded">
                            <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly class="flex-1 bg-transparent text-[#75788D] outline-none">
                            <button onclick="copyToClipboard()" class="p-2 text-[#EC0226]"><x-bi-clipboard class="w-5 h-5" /></button>
                        </div>
                    </div>
                </div>
            </section>
        </x-slot>
        
        <x-slot name="sidebar">
            <section class="mx-6 md:mx-8 2xl:mx-0 mb-7">
                <x-popular-recent-news />
            </section>
        </x-slot>
    </x-layout.two-column-layout>
</section>

{{-- RELATED ARTICLES & FOOTER --}}
<section class="dark:bg-[#121212]"><x-related-articles :category="$article->category_id" :exclude="$article->id" /></section>
<section class="mt-10 mx-6 lg:mx-10"><x-ads /></section>
<section class="bg-[#FAFAFA] dark:bg-[#171717] py-10"><div class="mx-6 lg:mx-10"><x-streaming-partner /></div></section>
<footer class="bg-[#FAFAFA] dark:bg-[#171717]"><div class="mx-6 lg:mx-10"><x-footer /></div></footer>

<script>
    function copyToClipboard() {
        const urlInput = document.getElementById('shareUrl');
        urlInput.select();
        navigator.clipboard.writeText(urlInput.value).then(() => alert('Link copied!'));
    }
</script>

@endsection