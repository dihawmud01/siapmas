<aside id="sidebar" class="sidebar p-4">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index') }}/">
                <i class="bi bi-house-door"></i>
                <span>{{ __('Home') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('dashboard') ? ' active' : ' collapsed' }}"
                href="{{ route('dashboard') }}"
            >
                <i class="bi bi-grid"></i>
                <span>{{ __('Overview') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <hr />
        </li>
        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('users.*') ? ' active' : ' collapsed' }}"
                href="{{ route('users.index') }}"
            >
                <i class="bi bi-people"></i>
                <span>{{ __('Anggota') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i>
                <span>{{ __('Kaderisasi') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('makesta') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Makesta') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('lakmud') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Lakmud') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('lakut') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Lakut') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('latinpel') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Latinpel') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        @auth
            @if (in_array(auth()->user()->role_id, [1, 2]))
                <li class="nav-item">
                    <a
                        class="nav-link{{ request()->routeIs('pac.*') ? ' active' : ' collapsed' }}"
                        href="{{ route('pac.index') }}"
                    >
                        <i class="bi bi-exclude"></i>
                        <span>{{ __('PAC') }}</span>
                    </a>
                </li>
            @endif
        @endauth

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#tables-nav"
                data-bs-toggle="collapse"
                href="{{ route('news.index') }}"
            >
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>{{ __('Berita') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('news.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('List Berita') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Kategori Berita') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tags.index') }}">
                        <i class="bi bi-circle"></i>
                        <span>{{ __('Tags') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('admin.calendar.*') ? ' active' : ' collapsed' }}"
                href="{{ route('admin.calendar.index') }}"
            >
                <i class="bi bi-calendar-date"></i>
                <span>{{ __('Agenda') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('hbn.*') ? ' active' : ' collapsed' }}"
                href="{{ route('hbn.index') }}"
            >
                <i class="bi bi-bookmark-check"></i>
                <span>{{ __('Hari Besar') }}</span>
            </a>
        </li>

        @auth
            @if (in_array(auth()->user()->role_id, [1]))
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('admins') ? ' active' : ' collapsed' }}"
                        href="{{ route('admins') }}"
                    >
                        <i class="bi bi-people"></i>
                        <span>{{ __('Admin') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('pages.*') ? ' active' : ' collapsed' }}"
                        href="{{ route('pages.index') }}"
                    >
                        <i class="bi bi-menu-button-wide"></i>
                        <span>{{ __('Pages') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('quotes.*') ? ' active' : ' collapsed' }}"
                        href="{{ route('quotes.index') }}"
                    >
                        <i class="bi bi-chat-left-text"></i>
                        <span>{{ __('Quotes') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('administrators.*') ? ' active' : ' collapsed' }}"
                        href="{{ route('administrators.index') }}"
                    >
                        <i class="bi bi-person-lines-fill"></i>
                        <span>{{ __('Pengurus') }}</span>
                    </a>
                </li>
            @endif
        @endauth

        {{-- <li class="nav-item"> --}}
        {{-- <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"> --}}
        {{-- <i class="bi bi-box-arrow-right btn btn-success m-4"><span>{{ __('Keluar') }}</span></i> --}}
        {{-- </a> --}}
        {{-- </li> --}}
    </ul>
</aside>
