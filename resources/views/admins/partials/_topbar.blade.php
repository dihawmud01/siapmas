<header id="header" class="header fixed-top d-flex align-items-center p-5">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/images/logokomi.png') }}" alt="{{ __('Logo') }}" />
            <span class="d-none d-lg-block">{{ __('PELAJAR NU BANYUMAS') }}</span>
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
                    <i class="bi bi-box-arrow-right btn btn-success m-4"><span>{{ __('Keluar') }}</span></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
