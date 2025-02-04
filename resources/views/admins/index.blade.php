@section('title')
    {{ __('Admin') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Overview'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Pasca') }}
                        <span>| {{ __('Makesta') }}</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $cadreLevelCounts['Makesta'] }}</h6>
                            <span class="text-primary small fw-bold pt-1"></span>
                            <span class="text-muted small ps-1 pt-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Kader') }}
                        <span>| {{ __('Lakmud') }}</span>
                    </h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $cadreLevelCounts['Lakmud'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Kader') }}
                        <span>| {{ __('Lakut') }}</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $cadreLevelCounts['Lakut'] }}</h6>
                            <span class="text-danger small fw-bold pt-1"></span>
                            <span class="text-muted small ps-1 pt-2"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Kader') }}
                        <span>| {{ __('Latinpel') }}</span>
                    </h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $cadreLevelCounts['Latinpel'] }}</h6>
                            <span class="text-danger small fw-bold pt-1"></span>
                            <span class="text-muted small ps-1 pt-2"></span>
                        </div>
                    </div>
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

                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Data Makesta') }}
                        <span>| {{ __('Dari Tahun Ke Tahun') }}</span>
                    </h5>
                    <div id="reportsChart"></div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const makestaCounts = @json($makestaCounts);

                            const years = ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'];
                            const data = years.map((year) => makestaCounts[year] || 0);

                            new ApexCharts(document.querySelector('#reportsChart'), {
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
                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
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
                                    type: 'datetime',
                                    categories: [
                                        '2016',
                                        '2017',
                                        '2018',
                                        '2019',
                                        '2020',
                                        '2021',
                                        '2022',
                                        '2023',
                                        '2024',
                                    ],
                                },
                                tooltip: {
                                    x: {
                                        format: 'yyyy',
                                    },
                                },
                            }).render();
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
                <div class="card-body">
                    <h5 class="card-title">
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
                                            action="{{ route('posts.destroy', $post->id) }}"
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
                                                href="{{ route('posts.edit', $post->id) }}"
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
