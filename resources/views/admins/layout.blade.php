<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title') | {{ __('SIAPMAS') }}</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" />

        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet"
        />

        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin />

        @vite([])
    </head>

    <body>
        @include('admins.partials._sidebar')
        @include('admins.partials._topbar')

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>@yield('page_title', __('Default'))</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="{{ route('index') }}">{{ __('Home') }}</a>
                        </li>
                        @if (Route::is('makesta') || Route::is('lakmud') || Route::is('lakut') || Route::is('latinpel'))
                            <li class="breadcrumb-item">@yield('path', __('Default'))</li>
                        @endif

                        <li class="breadcrumb-item active">@yield('page_title', __('Default'))</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center rounded-circle">
            <i class="bi bi-arrow-up-short"></i>
        </a>

        @include('admins.partials._footer')
        @include('admins.partials._script')

        @include('sweetalert::alert')

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="{{ asset('js/statistic.js') }}"></script>
    </body>
</html>
