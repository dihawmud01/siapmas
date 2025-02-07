<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title') | {{ __('PC IPNU IPPNU BMS') }}</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" />
        <link href="{{ asset('assets/images/favicon.png') }}" rel="apple-touch-icon" />
        <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/css/news.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/style.css') }}" />

        <link href="https://fonts.googleapis.com/css?family=PT+Sans:300,300i,400,400i,700,700i" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet" />

        <script
            async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7116013508016238"
            crossorigin="anonymous"
        ></script>
        <script
            async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7116013508016238"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />

        @vite([])

        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>
    </head>

    <body>
        <div id="preloader"></div>

        @include('users.partials._navbar')
        @yield('content')
        @include('users.partials._footer')

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('assets/vendor/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        @include('sweetalert::alert')

        <script src="{{ asset('assets/js/user.js') }}"></script>
    </body>
</html>
