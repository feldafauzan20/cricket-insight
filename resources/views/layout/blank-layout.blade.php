@extends('layout.app')

@section('body')
    @hasSection('navbar')
        <header>
            @yield('navbar')
        </header>
    @endif

    <main>
        @yield('content')
    </main>
@endsection
