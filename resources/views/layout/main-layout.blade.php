<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Cricket Insight'))</title>

    {{-- Preload critical assets --}}
    <link rel="preload" href="/resources/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/resources/fonts/Poppins-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/resources/fonts/Poppins-SemiBold.woff2" as="font" type="font/woff2" crossorigin>

    {{-- Prevent FOUC (Flash of Unstyled Content) --}}
    <script>
        // Jalankan SEBELUM page render
        (function() {
            if (localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-poppins dark:bg-[#121212]">

    <header>
        @include('components.navbar')
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
