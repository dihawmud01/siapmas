<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />

        <title>{{ __('Lupa Kata Sandi') }}</title>
    </head>
    <body>
        <section class="vh-100" style="background-color: #363636">
            <div class="h-100 container py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img
                                        src="{{ asset('storage/images/login2.jpg') }}"
                                        alt="{{ __('Form Login') }}"
                                        class="img-fluid"
                                        style="
                                            width: 100%;
                                            height: 35rem;
                                            object-fit: cover;
                                            border-radius: 1rem 0 0 1rem;
                                        "
                                    />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-lg-5 p-4 text-black">
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-6 pb-1 text-center"
                                            >
                                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219"></i>
                                                <span class="h1 fw-bold mb-0">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('storage/images/logokomi.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>

                                            <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px">
                                                {{ __('Lupa Kata Sandi Anda') }}
                                            </h3>
                                            <h6 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px">
                                                {{ __('Masukkan Email') }}
                                            </h6>
                                            @if (session('status') === trans('passwords.sent'))
                                                <div class="alert alert-success">
                                                    {{ trans('passwords.sent') }}
                                                </div>
                                            @endif

                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif

                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold text-uppercase">
                                                    {{ __('Email') }}
                                                </label>
                                                <input
                                                    id="email"
                                                    type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    required
                                                    autocomplete="email"
                                                    autofocus
                                                    placeholder="{{ __('Masukkan Email') }}"
                                                />
                                            </div>

                                            <div class="d-flex justify-content-between mb-4 pt-1">
                                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                                                    {{ __('Kembali') }}
                                                </a>
                                                <button class="btn btn-success btn-lg" type="submit">
                                                    {{ __('Atur Ulang') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @include('sweetalert::alert')

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
