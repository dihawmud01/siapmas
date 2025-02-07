<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-11 d-flex align-items-center justify-content-between">
                <h1 class="logo">
                    <a href="{{ route('index') }}" style="text-decoration: none">
                        <img
                            src="{{ asset('assets/images/logokomi.png') }}"
                            alt="{{ __('Logo') }}"
                            class="img-fluid"
                        />
                        {{ __('SIAPMAS') }}
                    </a>
                </h1>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li>
                            <a
                                class="nav-link scrollto {{ request()->routeIs('index') ? 'active' : '' }}"
                                href="{{ route('index') }}"
                            >
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('index') }}#about">
                                <span>{{ __('Tentang') }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul>
                                <li><a href="{{ route('index') }}#about">{{ __('Tentang Kami') }}</a></li>
                                <li><a href="{{ route('administrators.index') }}">{{ __('Pengurus') }}</a></li>
                                <li><a href="{{ route('calendar.index') }}">{{ __('Agenda') }}</a></li>
                                <li><a href="{{ route('news') }}">{{ __('News') }}</a></li>
                            </ul>
                        </li>
                        <li>
                            <a
                                class="nav-link scrollto {{ request()->routeIs('calendar.index') ? 'active' : '' }}"
                                href="{{ route('calendar.index') }}"
                            >
                                {{ __('Agenda') }}
                            </a>
                        </li>
                        <li>
                            <a
                                class="nav-link scrollto {{ request()->routeIs('news') ? 'active' : '' }}"
                                href="{{ route('news') }}"
                            >
                                {{ __('Berita') }}
                            </a>
                        </li>

                        @auth
                            @if (in_array(auth()->user()->role_id, [1, 2]))
                                <li>
                                    <a
                                        class="nav-link scrollto {{ request()->routeIs('dashboard') ? 'active' : '' }}"
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
                                        class="nav-link scrollto {{ request()->routeIs('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}"
                                    >
                                        {{ __('Masuk') }}
                                    </a>
                                @endif
                            @else
                                <li class="nav-item dropdown pe-3 pl-3">
                                    <a
                                        class="nav-link nav-profile d-flex align-items-center pe-0"
                                        href="#"
                                        data-bs-toggle="dropdown"
                                    >
                                        <span>{{ Str::limit($user->username, 6) }}</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                        <li class="dropdown-header">
                                            <img
                                                src="{{ asset('storage/images/' . $user->img) }}"
                                                style="width: 40px; height: 40px; object-fit: cover"
                                                alt="{{ __('Profil') }}"
                                                class="rounded-circle"
                                            />
                                            <h6>{{ $user->username }}</h6>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item d-flex align-items-start"
                                                href="{{ route('profile.index') }}"
                                            >
                                                <span>{{ __('Profilku') }}</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item d-flex align-items-center"
                                                href="{{ route('profile.account') }}"
                                            >
                                                <span>{{ __('Pengaturan Akun') }}</span>
                                            </a>
                                        </li>

                                        @auth
                                            @if (in_array(auth()->user()->role_id, [1, 2, 3]))
                                                <li>
                                                    <a
                                                        class="dropdown-item d-flex align-items-center"
                                                        href="{{ route('uploads') }}"
                                                    >
                                                        <span>{{ __('Unggahan') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endauth

                                        <li>
                                            <a
                                                class="dropdown-item d-flex align-items-center"
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
