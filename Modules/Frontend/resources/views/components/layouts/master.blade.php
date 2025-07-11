<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{ $title ?? 'Home' }} - {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="{{ $keywords ?? '' }}">
        <meta name="author" content="{{ $author ?? 'Turf Trader Media' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Vite CSS --}}
        {{-- {{ module_vite('build-frontend', 'resources/assets/sass/app.scss') }} --}}

        <link rel="profile" href="https://gmpg.org/xfn/11">
        <link rel="stylesheet" href="{{ asset('frontendassets/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontendassets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontendassets/css/style-main.css') }}">
        <link rel="icon" href="{{ asset('frontendassets/image/fab.png') }}" sizes="32x32" />
        <link rel="icon" href="{{ asset('frontendassets/image/fab.png') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ asset('frontendassets/image/fab.png') }}" />
        <meta name="msapplication-TileImage" content="{{ asset('frontendassets/image/fab.png') }}" />
        <script src="{{ asset('frontendassets/js/jquery-3.6.0.min.js') }}"></script>

    </head>

    <body>

        <x-frontend::layouts.header />

        {{ $slot }}

        {{-- Vite JS --}}
        {{-- {{ module_vite('build-frontend', 'resources/assets/js/app.js') }} --}}

        <x-frontend::layouts.footer />


        <link rel="stylesheet" href="{{ asset('frontendassets/css/jquery.fancybox.min.css') }}" />
        <script src="{{ asset('frontendassets/js/jquery.fancybox.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('frontendassets/css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('frontendassets/css/slick-theme.css') }}" />
        <script src="{{ asset('frontendassets/js/slick.js') }}"></script>
        <script src="{{ asset('frontendassets/js/main-script.js') }}"></script>


    </body>
</html>
