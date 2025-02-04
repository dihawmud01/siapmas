<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title') | {{ __('PC IPNU IPPNU BMS') }}</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <link href="{{ asset('assets/vendor/user-assets/images/favicon.png') }}" rel="icon" />
        <link href="{{ asset('assets/vendor/user-assets/images/favicon.png') }}" rel="apple-touch-icon" />
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:300,300i,400,400i,700,700i" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/user-assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/user-assets/vendor/aos/aos.css') }}" rel="stylesheet" />
        <link
            href="{{ asset('assets/vendor/user-assets/vendor/bootstrap/css/bootstrap.min.css') }}"
            rel="stylesheet"
        />
        <link
            href="{{ asset('assets/vendor/user-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"
            rel="stylesheet"
        />
        <link
            href="{{ asset('assets/vendor/user-assets/vendor/glightbox/css/glightbox.min.css') }}"
            rel="stylesheet"
        />
        <link href="{{ asset('assets/vendor/user-assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/user-assets/css/style.css') }}" rel="stylesheet" />
        {{-- <link --}}
        {{-- rel="stylesheet" --}}
        {{-- href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" --}}
        {{-- integrity="sha512-B2tEivVN/4VghK2ejzVWzW3FkmvHqfN98+Mu7H6QgJY1X1LzOD0PTtIP2Hs5mV6C3y8SvA04O7j/VoIcN44+pw==" --}}
        {{-- crossorigin="anonymous" --}}
        {{-- referrerpolicy="no-referrer" --}}
        {{-- /> --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/user-assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/stylenews.css') }}" />
        <link href="{{ asset('assets/vendor/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/css/style.css') }}" />
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

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
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset('assets/vendor/user-assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('assets/vendor/user-assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('assets/vendor/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        @include('sweetalert::alert')

        <script src="{{ asset('assets/vendor/user-assets/js/main.js') }}"></script>
    </body>
</html>
