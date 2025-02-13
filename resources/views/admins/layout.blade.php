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

        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin />

        @vite(['resources/js/app.js'])
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
                            <li class="breadcrumb-item active">@yield('page_title', __('Default'))</li>
                        @elseif (Route::is('news.edit'))
                            <li class="breadcrumb-item">@yield('page_title', __('Default'))</li>
                            <li class="breadcrumb-item active">@yield('path', __('Default'))</li>
                        @else
                            <li class="breadcrumb-item active">@yield('page_title', __('Default'))</li>
                        @endif
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset('js/admin.js') }}"></script>
    </body>
</html>
