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
                    <h5 class="card-title mb-3">
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
                    <h5 class="card-title mb-3">
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
                    <h5 class="card-title mb-3">
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
                    <h5 class="card-title mb-3">
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
                        <h5 class="card-title d-flex align-items-center mb-0">
                            {{ __('Data Makesta') }}
                            <span>| {{ __('Dari Tahun Ke Tahun') }}</span>
                        </h5>
                        <div class="dropdown filter">
                            <button
                                class="icon text-dark fs-5 border-0 bg-transparent"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>{{ __('Filter') }}</h6>
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

                            const years = ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'];
                            const data = years.map((year) => makestaCounts[year] || 0);

                            const chart = new ApexCharts(document.querySelector('#reportsChart'), {
                                series: [
                                    {
                                        name: '{{ __('Makesta') }}',
                                        data: data,
                                    },
                                ],
                                chart: {
                                    height: 350,
                                    type: 'area',
                                    toolbar: {
                                        show: false,
                                    },
                                },
                                markers: {
                                    size: 4,
                                },
                                colors: ['#008000FF', '#2eca6a', '#ff771d'],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100],
                                    },
                                },
                                dataLabels: {
                                    enabled: false,
                                },
                                stroke: {
                                    curve: 'smooth',
                                    width: 2,
                                },
                                xaxis: {
                                    type: 'category',
                                    categories: years,
                                },
                                tooltip: {
                                    x: {
                                        format: 'yyyy',
                                    },
                                },
                            });

                            chart.render();

                            function filterData(filter) {
                                const now = new Date();

                                let filteredYears = [];

                                if (filter === 'today') {
                                    filteredYears = [now.getFullYear().toString()];
                                } else if (filter === 'month') {
                                    filteredYears = [now.getFullYear().toString()];
                                } else if (filter === 'year') {
                                    filteredYears = years.filter((year) => parseInt(year) >= now.getFullYear() - 5);
                                } else {
                                    filteredYears = years;
                                }

                                const data = filteredYears.map((year) => makestaCounts[year] || 0);

                                chart.updateSharedOptions({
                                    xaxis: { categories: filteredYears },
                                    series: [{ data: data }],
                                });
                            }

                            document.getElementById('filterDropdown').addEventListener('click', function (event) {
                                if (event.target.tagName === 'A') {
                                    const filter = event.target.getAttribute('data-filter');
                                    filterData(filter);
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
                    <h5 class="card-title mb-3">
                        {{ __('Data Postingan') }}
                        <span>| {{ __('Belum Diverifikasi') }}</span>
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
