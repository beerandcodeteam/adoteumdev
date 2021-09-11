<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
        <meta name="msapplication-TileColor" content="#b91d47">
        <meta name="theme-color" content="#ffffff">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url(asset('assets/apple-touch-icon.png')) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url(asset('assets/favicon-32x32.png')) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url(asset('assets/favicon-16x16.png')) }}">
        <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
        <link rel="manifest" href="{{ url(asset('site.webmanifest')) }}">
        <link rel="mask-icon" href="{{ url(asset('assets/safari-pinned-tab.svg')) }}" color="#b91d47">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')

        @livewireScripts
        @yield('scripts')
    </body>
</html>
