<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <link href="{{ asset('assets/images/favicon.png') }}" rel="icon" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

        <title>{{ __('Masuk') }}</title>

        @vite(['resources/js/app.js', 'resources/css/login.css'])
    </head>
    <body>
        <div id="preloader"></div>

        <section class="d-flex justify-content-center align-items-center bg-login">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img
                                        src="{{ asset('storage/images/waduh.jpeg') }}"
                                        alt="{{ __('Form Login') }}"
                                        class="img-fluid h-100 w-100"
                                        style="object-fit: cover; border-radius: 1rem 0 0 1rem"
                                    />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-lg-5 p-4 text-black">
                                        <form method="POST" action="{{ route('authenticate') }}">
                                            @csrf
                                            <div
                                                class="d-flex align-items-center justify-content-center mb-4 pb-1 text-center"
                                            >
                                                <span class="h1 fw-bold mb-0">
                                                    <img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ asset('assets/images/logokomiii.png') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </div>

                                            <h5 class="fw-normal mb-4">
                                                {{ __('Masuk ke akun Anda') }}
                                            </h5>

                                            <div class="mb-3">
                                                <div class="form-outline mb-3">
                                                    <label class="form-label" for="form2Example17">
                                                        {{ __('Email') }}
                                                    </label>
                                                    <input
                                                        type="email"
                                                        placeholder="{{ __('Email') }}"
                                                        name="email"
                                                        id="form2Example17"
                                                        autofocus
                                                        class="form-control form-control-lg"
                                                    />
                                                </div>

                                                <div class="form-outline mb-3">
                                                    @if (Session::has('error'))
                                                        <div class="alert alert-danger">
                                                            {{ Session::get('error') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="form-outline mb-2">
                                                    <label class="form-label" for="form2Example27">
                                                        {{ __('Kata Sandi') }}
                                                    </label>
                                                    <div class="input-group">
                                                        <input
                                                            type="password"
                                                            placeholder="{{ __('Kata Sandi') }}"
                                                            name="password"
                                                            id="form2Example27"
                                                            class="form-control form-control-lg"
                                                        />
                                                        <button
                                                            type="button"
                                                            id="togglePassword"
                                                            class="btn btn-success"
                                                        >
                                                            <i id="toggleIcon" class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <a
                                                    href="{{ route('password.request') }}"
                                                    style="text-decoration: none"
                                                >
                                                    <p class="text-secondary fs-6 text-success">
                                                        {{ __('Lupa Kata Sandi') }}
                                                    </p>
                                                </a>
                                                <a
                                                    href="{{ route('validation.index') }}"
                                                    style="text-decoration: none"
                                                >
                                                    <p class="text-secondary fs-6 text-success">
                                                        {{ __('Belum Punya Akun?') }}
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="d-flex justify-content-between mb-4">
                                                <a
                                                    href="{{ route('index') }}"
                                                    class="btn btn-lg text-success back-btn bg-transparent px-0"
                                                >
                                                    {{ __('Kembali') }}
                                                </a>
                                                <div>
                                                    <button class="btn btn-success btn-lg" type="submit">
                                                        {{ __('Masuk') }}
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

        <script src="{{ asset('js/user.js') }}"></script>

        <script>
            var passwordInput = document.getElementById('form2Example27');
            var toggleButton = document.getElementById('togglePassword');
            var toggleIcon = document.getElementById('toggleIcon');

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

        @include('sweetalert::alert')
    </body>
</html>
