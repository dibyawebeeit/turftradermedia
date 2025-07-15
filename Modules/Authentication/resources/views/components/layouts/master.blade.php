<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>
            {{ $title ?? 'Authentication' }} - {{ config('app.name', 'Laravel') }}
        </title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="{{ $keywords ?? '' }}">
        <meta name="author" content="{{ $author ?? '' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Vite CSS --}}
        {{-- {{ module_vite('build-authentication', 'resources/assets/sass/app.scss') }} --}}

        {{-- added by dibya --}}
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('uploads/siteImage/' . sitesetting()->favicon) }}">
        <!-- Theme Config Js -->
        <script src="{{ asset('assets/js/hyper-config.js') }}"></script>
        <!-- Vendor css -->
        <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{ asset('assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
        <!-- Icons css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <style>
            .error
            {
                color: red;
                font-size: 14px;
            }
        </style>
        {{-- added by dibya --}}

    </head>

    <body>
        {{ $slot }}

        {{-- Vite JS --}}
        {{-- {{ module_vite('build-authentication', 'resources/assets/js/app.js') }} --}}

        {{-- added by dibya --}}
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        {{-- added by dibya --}}

        @yield('script')

    </body>
</html>
