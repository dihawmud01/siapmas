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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

        <title>{{ __('Masuk') }}</title>
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
                                        alt="login form"
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
                                        <form method="POST" action="{{ route('validation') }}">
                                            @csrf
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-6 pb-1 text-center"
                                            >
                                                <span class="h1 fw-bold mb-0">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('storage/images/logokomi.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>

                                            <h5 class="fw-normal mb-3" style="letter-spacing: 1px">
                                                {{ __('Masukkan NIM') }}
                                            </h5>

                                            <div class="form-outline mb-2">
                                                <input
                                                    type="text"
                                                    placeholder=""
                                                    name="nim"
                                                    id="nim"
                                                    autofocus
                                                    class="form-control form-control-lg"
                                                />
                                            </div>

                                            <div class="form-outline">
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger">
                                                        {{ Session::get('error') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-between mb-4 pt-1">
                                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                                                    {{ __('Kembali') }}
                                                </a>
                                                <div>
                                                    <button class="btn btn-success btn-lg" type="submit">
                                                        {{ __('Lanjutkan') }}
                                                    </button>
                                                </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let passwordInput = document.getElementById('form2Example27');
            let toggleButton = document.getElementById('togglePassword');
            let toggleIcon = document.getElementById('toggleIcon');

            toggleButton.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa fa-eye');
                    toggleIcon.classList.add('fa fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa fa-eye-slash');
                    toggleIcon.classList.add('fa fa-eye');
                }
            });
        </script>

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
