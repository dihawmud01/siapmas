<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-11 d-flex align-items-center justify-content-between">
                <div class="d-block">
                    <h1 class="logo">
                        <a href="{{ route('index') }}" style="text-decoration: none" class="d-lg-block">
                            <div class="d-flex align-items-center">
                                <img
                                    src="{{ asset('assets/images/logokomi.png') }}"
                                    alt="{{ __('Logo') }}"
                                    class="img-fluid"
                                />
                                <div class="logo-text d-flex flex-column ms-2">
                                    <h1 class="fw-bold fs-2 logo-title m-0">
                                        {{ __('SIAPMAS') }}
                                    </h1>
                                    <span class="logo-text-secondary text-secondary fw-normal">
                                        {{ __('Sistem Informasi Administrasi Pelajar NU Banyumas') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </h1>
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li>
                            <a
                                class="nav-link fs-6 scrollto {{ request()->routeIs('index') ? 'active' : '' }}"
                                href="{{ route('index') }}"
                            >
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('index') }}#about" class="text-decoration-none">
                                <span class="fs-6">{{ __('Tentang') }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="rounded">
                                <li>
                                    <a class="fs-6" href="{{ route('index') }}#about">{{ __('Tentang Kami') }}</a>
                                </li>
                                <li><a class="fs-6" href="{{ route('administrators') }}">{{ __('Pengurus') }}</a></li>
                                <li><a class="fs-6" href="{{ route('calendar.index') }}">{{ __('Agenda') }}</a></li>
                                <li><a class="fs-6" href="{{ route('news') }}">{{ __('Berita') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a
                                class="nav-link fs-6 scrollto {{ request()->routeIs('calendar.index') ? 'active' : '' }}"
                                href="{{ route('calendar.index') }}"
                            >
                                {{ __('Agenda') }}
                            </a>
                        </li>
                        <li>
                            <a
                                class="nav-link fs-6 scrollto {{ request()->routeIs('news') ? 'active' : '' }}"
                                href="{{ route('news') }}"
                            >
                                {{ __('Berita') }}
                            </a>
                        </li>

                        @auth
                            @if (in_array(auth()->user()->role_id, [1, 2]))
                                <li>
                                    <a
                                        class="nav-link fs-6 scrollto {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                        href="{{ route('dashboard') }}"
                                    >
                                        {{ __('Dashboard') }}
                                    </a>
                                </li>
                            @endif
                        @endauth

                        <li>
                            @guest
                                @if (Route::has('login'))
                                    <a
                                        class="nav-link fs-6 scrollto {{ request()->routeIs('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}"
                                    >
                                        {{ __('Masuk') }}
                                    </a>
                                @endif
                            @else
                                <li class="nav-item dropdown pe-3 pl-3">
                                    <a
                                        class="nav-link fs-6 nav-profile d-flex align-items-center pe-0"
                                        href="#"
                                        data-bs-toggle="dropdown"
                                    >
                                        <span>{{ __('Profil') }}</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                        <li class="dropdown-header">
                                            <div class="d-flex align-items-center mb-3">
                                                <img
                                                    src="{{ asset('storage/images/' . $user->img) }}"
                                                    style="width: 40px; height: 40px; object-fit: cover"
                                                    alt="{{ __('Profil') }}"
                                                    class="rounded-circle"
                                                />
                                                <h6 class="text-uppercase fw-bold text-dark ms-2">
                                                    {{ $user->username }}
                                                </h6>
                                            </div>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item fs-6 d-flex align-items-start"
                                                href="{{ route('profile.index') }}"
                                            >
                                                <span>{{ __('Profilku') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item fs-6 d-flex align-items-center"
                                                href="{{ route('profile.account') }}"
                                            >
                                                <span>{{ __('Pengaturan Akun') }}</span>
                                            </a>
                                        </li>

                                        @auth
                                            @if (in_array(auth()->user()->role_id, [1, 2, 3]))
                                                <li>
                                                    <a
                                                        class="dropdown-item fs-6 d-flex align-items-center"
                                                        href="{{ route('uploads') }}"
                                                    >
                                                        <span>{{ __('Unggahan') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endauth

                                        <li class="border-top">
                                            <a
                                                class="dropdown-item fs-6 d-flex align-items-center"
                                                href="{{ route('logout') }}"
                                            >
                                                <span>{{ __('Keluar') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            </div>
        </div>
    </div>
</header>
