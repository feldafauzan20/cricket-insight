@extends('layout.app')

@section('body')
    <header>
        @include('components.navbar.navbar')
    </header>
    <main>
        @yield('content')
    </main>
@endsection
