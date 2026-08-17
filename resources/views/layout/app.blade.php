<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M9JGWQ5B1Q"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-M9JGWQ5B1Q');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Cricket Insight'))</title>
    <x-seo-meta
        :title="$seoTitle ?? null"
        :description="$seoDescription ?? null"
        :image="$seoImage ?? null"
        :type="$seoType ?? null"
        :published-time="$seoPublishedTime ?? null"
        :modified-time="$seoModifiedTime ?? null"
        :canonical-route="$seoCanonicalRoute ?? null"
        :canonical-params="$seoCanonicalParams ?? []"
        :hreflang-route="$seoHreflangRoute ?? null"
        :hreflang-params="$seoHreflangParams ?? []"
        :noindex="$seoNoindex ?? false"
        :json-ld="$seoJsonLd ?? null"
    />

    <script>
        (function() {
            if (localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-poppins dark:bg-[#121212]">
    @yield('body')
    @stack('scripts')
</body>

</html>
