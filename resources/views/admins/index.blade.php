@section('title')
    {{ __('Admin') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Overview'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body p-4">
                    <h5 class="card-title align-items-baseline fs-5 mb-3">
                        {{ __('Kader Makesta') }}
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $cadreLevelCounts['Makesta'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body p-4">
                    <h5 class="card-title align-items-baseline fs-5 mb-3">
                        {{ __('Kader Lakmud') }}
                    </h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $cadreLevelCounts['Lakmud'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card revenue-card">
                <div class="card-body p-4">
                    <h5 class="card-title align-items-baseline fs-5 mb-3">
                        {{ __('Kader Lakut') }}
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $cadreLevelCounts['Lakut'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card revenue-card">
                <div class="card-body p-4">
                    <h5 class="card-title align-items-baseline fs-5 mb-3">
                        {{ __('Kader Latinpel') }}
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6>{{ $cadreLevelCounts['Latinpel'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-header d-flex justify-content-between align-items-center mb-4 border-0 bg-white">
                        <h5 class="card-title d-fl align-items-baseline fs-4 align-items-baseline">
                            {{ __('Data Kader') }}
                        </h5>
                        <div class="dropdown rounded filter">
                            <button
                                class="btn text-secondary fs-6 border-secondary-subtle dropdown-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                type="button"
                                id="dropdownButton"
                            >
                                <span id="selectedFilter">{{ __('Dari Tahun ke Tahun') }}</span>
                                <i class="bi bi-filter ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
                                <li>
                                    <a class="dropdown-item active" href="#" data-filter="all">
                                        {{ __('Dari Tahun ke Tahun') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-filter="today">{{ __('Hari Ini') }}</a></li>
                                <li>
                                    <a class="dropdown-item" href="#" data-filter="month">{{ __('Bulan Ini') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-filter="year">{{ __('Tahun ini') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="reportsChart"></div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const makestaCounts = @json($makestaCounts);
                            const lakmudCounts = @json($lakmudCounts);
                            const lakutCounts = @json($lakutCounts);
                            const latinpelCounts = @json($latinpelCounts);

                            const years = [
                                '2016',
                                '2017',
                                '2018',
                                '2019',
                                '2020',
                                '2021',
                                '2022',
                                '2023',
                                '2024',
                                '2025',
                                '2026',
                            ];

                            const chart = new ApexCharts(document.querySelector('#reportsChart'), {
                                series: [
                                    {
                                        name: '{{ __('Makesta') }}',
                                        data: years.map((year) => makestaCounts[year] || 0),
                                    },
                                    { name: '{{ __('Lakmud') }}', data: years.map((year) => lakmudCounts[year] || 0) },
                                    { name: '{{ __('Lakut') }}', data: years.map((year) => lakutCounts[year] || 0) },
                                    {
                                        name: '{{ __('Latinpel') }}',
                                        data: years.map((year) => latinpelCounts[year] || 0),
                                    },
                                ],
                                chart: { height: 350, type: 'area', toolbar: { show: false } },
                                markers: { size: 4 },
                                colors: ['#5CB338', '#ECE852', '#FFC145', '#FB4141'],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100],
                                    },
                                },
                                dataLabels: { enabled: false },
                                stroke: { curve: 'smooth', width: 2 },
                                xaxis: { type: 'datetime', categories: years },
                                tooltip: { x: { format: 'yyyy' } },
                                legend: { offsetY: 20, height: 52 },
                            });

                            chart.render();

                            const dropdownButton = document.getElementById('dropdownButton');
                            const dropdownMenu = document.getElementById('dropdownMenu');
                            const selectedFilterText = document.getElementById('selectedFilter');

                            function filterData(filter) {
                                const now = new Date();
                                let filteredYears = [];

                                switch (filter) {
                                    case 'today':
                                    case 'month':
                                        filteredYears = [now.getFullYear().toString()];
                                        break;
                                    case 'year':
                                        filteredYears = years.filter((year) => parseInt(year) >= now.getFullYear() - 4);
                                        break;
                                    default:
                                        filteredYears = years;
                                        break;
                                }

                                chart.updateOptions({
                                    xaxis: { categories: filteredYears },
                                    series: [
                                        {
                                            name: '{{ __('Makesta') }}',
                                            data: filteredYears.map((year) => makestaCounts[year] || 0),
                                        },
                                        {
                                            name: '{{ __('Lakmud') }}',
                                            data: filteredYears.map((year) => lakmudCounts[year] || 0),
                                        },
                                        {
                                            name: '{{ __('Lakut') }}',
                                            data: filteredYears.map((year) => lakutCounts[year] || 0),
                                        },
                                        {
                                            name: '{{ __('Latinpel') }}',
                                            data: filteredYears.map((year) => latinpelCounts[year] || 0),
                                        },
                                    ],
                                });
                            }

                            document.addEventListener('click', (event) => {
                                const target = event.target;

                                if (dropdownMenu.contains(target)) {
                                    if (target.classList.contains('dropdown-item')) {
                                        event.preventDefault();

                                        document
                                            .querySelectorAll('.dropdown-item')
                                            .forEach((item) => item.classList.remove('active'));
                                        target.classList.add('active');

                                        if (selectedFilterText) {
                                            selectedFilterText.textContent = target.textContent;
                                        }

                                        filterData(target.dataset.filter);

                                        const dropdown = new bootstrap.Dropdown(dropdownButton);
                                        dropdown.hide();
                                    }
                                } else {
                                    dropdownMenu.classList.remove('show');
                                }
                            });

                            dropdownButton.addEventListener('click', (event) => {
                                event.stopPropagation();
                                dropdownMenu.classList.toggle('show');
                            });

                            window.addEventListener('scroll', () => {
                                const buttonRect = dropdownButton.getBoundingClientRect();
                                if (buttonRect.bottom + dropdownMenu.offsetHeight > window.innerHeight) {
                                    dropdownMenu.classList.add('dropup');
                                } else {
                                    dropdownMenu.classList.remove('dropup');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>{{ __('Filter') }}</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">{{ __('Hari Ini') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('Bulan Ini') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('Tahun ini') }}</a></li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title align-items-baseline fs-4 mb-4">
                        {{ __('Data Postingan Berita') }}
                    </h5>
                    <table class="table-bordered table-hover text-nowrap table">
                        <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th>{{ __('Judul') }}</th>
                                <th>{{ __('Kategori') }}</th>
                                <th>{{ __('Penulis') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ Str::limit($post->title, 50) }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>{{ $post->user->username }}</td>
                                    <td>
                                        @if ($post->active === 1)
                                            <span class="badge bg-success">{{ __('Aktif') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Nonaktif') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form
                                            action="{{ route('news.destroy', $post->id) }}"
                                            method="post"
                                            class="float-left"
                                        >
                                            <a
                                                href="{{ url('article') }}/{{ $post->slug }}"
                                                class="btn btn-info btn-sm float-left mr-1"
                                                target="_blank"
                                            >
                                                <i class="ri-eye-fill"></i>
                                            </a>
                                            <a
                                                href="{{ route('news.edit', $post->id) }}"
                                                class="btn btn-warning btn-sm float-left mr-1"
                                            >
                                                <i class="ri-edit-fill"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-left">
                                                <i class="ri-delete-bin-5-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admins.partials._rightside')
@endsection
