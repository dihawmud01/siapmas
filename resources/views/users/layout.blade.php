<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>@yield('title') | {{ __('SIAPMAS') }}</title>

        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" />

        {{-- <script --}}
        {{-- async --}}
        {{-- src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7116013508016238" --}}
        {{-- crossorigin="anonymous" --}}
        {{-- ></script> --}}

        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @stack('style')
        @stack('script')
    </head>

    <body>
        <div id="preloader"></div>

        @include('users.partials._navbar')
        @yield('content')
        @include('users.partials._footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        @include('sweetalert::alert')
    </body>
</html>
