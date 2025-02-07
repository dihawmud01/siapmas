<header id="header" class="header fixed-top d-flex align-items-center px-4 py-5">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
            <img class="mr-2" src="{{ asset('assets/images/logokomi.png') }}" alt="{{ __('Logo') }}" />
            <div class="d-block">
                <h3 class="d-none d-lg-block lh-1 fw-bold mb-0">{{ __('SIAPMAS') }}</h3>
                <span class="text-secondary fw-semibold">
                    {{ __('Sistem Informasi Administrasi Pelajar NU Banyumas') }}
                </span>
            </div>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar"></div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-right btn btn-success m-4"><span>{{ __(' Keluar') }}</span></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
