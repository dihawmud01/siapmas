<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') | {{ __('SIAPMAS') }}</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" />

        <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/news.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/calendar.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" />

        <script
            async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7116013508016238"
            crossorigin="anonymous"
        ></script>

        @vite(['resources/js/app.js'])
        @include('sweetalert::alert')
    </head>

    <body>
        <div id="preloader"></div>

        @include('users.partials._navbar')
        @yield('content')
        @include('users.partials._footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('js/user.js') }}"></script>

    </body>
</html>
