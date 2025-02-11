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
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
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
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
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
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
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
                    <h5 class="card-title fw-bold align-items-baseline fs-5 mb-3">
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
                        <h5 class="card-title fw-bold d-flex align-items-baseline fs-4 mb-0">
                            {{ __('Data Kader') }}
                        </h5>
                        <div class="dropdown rounded filter" data-target="cadre">
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
                        window.chartData = {
                            makestaCounts: @json($makestaCounts),
                            lakmudCounts: @json($lakmudCounts),
                            lakutCounts: @json($lakutCounts),
                            latinpelCounts: @json($latinpelCounts),
                        };

                        window.chartLables = {
                            makesta: '{{ __('Makesta') }}',
                            lakmud: '{{ __('Lakmud') }}',
                            lakut: '{{ __('lakut') }}',
                            latinpel: '{{ __('Latinpel') }}',
                        };
                    </script>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="card-header d-flex justify-content-between align-items-center mb-4 border-0 bg-white">
                        <h5 class="card-title fw-bold align-items-baseline fs-4 d-flex mb-0">
                            {{ __('Data Postingan Berita') }}
                        </h5>
                        <div class="dropdown rounded filter" data-target="news">
                            <button
                                class="btn text-secondary fs-6 border-secondary-subtle dropdown-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                type="button"
                                id="dropdownButton"
                            >
                                <span id="selectedFilter">{{ __('Semua') }}</span>
                                <i class="bi bi-filter ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="dropdownMenu">
                                <li>
                                    <a class="dropdown-item active" href="#" data-filter="all">
                                        {{ __('Semua') }}
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

                    <table class="table-bordered table-hover text-nowrap table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px">{{ __('No.') }}</th>
                                <th class="text-start">{{ __('Judul') }}</th>
                                <th class="text-center">{{ __('Kategori') }}</th>
                                <th class="text-center">{{ __('Penulis') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-start">{{ __('Dibuat pada') }}</th>
                                <th class="text-start">{{ __('Diperbarui pada') }}</th>
                                <th class="text-center">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody id="newsTable">
                            @foreach ($news as $post)
                                <tr data-updated="{{ $post->formatted_updated_date }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-start">{{ $post->title }}</td>
                                    <td class="text-center">{{ $post->category->title }}</td>
                                    <td class="text-center">{{ $post->user->username }}</td>
                                    <td class="text-center">
                                        @if ($post->active === 1)
                                            <span class="badge bg-success">{{ __('Aktif') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('Nonaktif') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-start">
                                        {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="text-start">
                                        {{ \Carbon\Carbon::parse($post->updated_at)->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        <form
                                            action="{{ route('news.destroy', $post->id) }}"
                                            method="post"
                                            class="float-left"
                                        >
                                            <a
                                                href="{{ url('article') }}/{{ $post->slug }}"
                                                class="btn btn-success btn-sm"
                                                target="_blank"
                                            >
                                                <i class="ri-eye-fill"></i>
                                            </a>
                                            <a
                                                href="{{ route('news.edit', $post->id) }}"
                                                class="btn btn-warning btn-sm"
                                            >
                                                <i class="ri-edit-fill"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
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
