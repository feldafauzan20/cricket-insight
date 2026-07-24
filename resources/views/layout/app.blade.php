<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Cricket Insight'))</title>

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
