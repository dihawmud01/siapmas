@section('title')
    {{ __('Surat Masuk') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat Masuk')]"></x-breadcrumb>

    @if ($incomings->isEmpty())
        <div class="d-flex align-items-center justify-content-center empty-content p-4">
            <div class="text-center">
                <h1 class="text-secondary mb-3">{{ __('Belum ada surat masuk') }}</h1>
            </div>
        </div>
    @endif

    @if (! $incomings->isEmpty())
        <div class="card info-card sales-card min-vh-100">
            <div class="card-header bg-transparent text-center">
                <div class="d-flex align-items-center p-4">
                    <div class="d-flex flex-column w-100">
                        <h3 class="fw-bold">{{ __('Data Surat Masuk') }}</h3>
                    </div>
                </div>
            </div>

            <div class="container-fluid p-5">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <!-- Bagian Kiri: Total Surat Masuk -->
                    <h5 class="fw-semibold mb-0">{{ __('Total Surat Masuk: ') }} {{ count($incomings) }}</h5>

                    <!-- Bagian Kanan: Form Filter -->
                    <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end flex-wrap gap-2">
                        <div class="col-auto">
                            <x-input-filter
                                name="since"
                                label="{{__('Dari Tanggal')}}"
                                type="date"
                                :value="$since ? date('Y-m-d', strtotime($since)) : ''"
                            />
                        </div>
                        <div class="col-auto">
                            <x-input-filter
                                name="until"
                                label="{{__('Sampai Tanggal')}}"
                                type="date"
                                :value="$until ? date('Y-m-d', strtotime($until)) : ''"
                            />
                        </div>
                        <div class="col-auto">
                            <div class="mb-3">
                                <label for="filter" class="form-label mb-0">{{ __('Filter Berdasarkan') }}</label>
                                <select class="form-select" id="filter" name="filter">
                                    <option value="letter_date" @selected(old('filter', $filter) == 'letter_date')>
                                        {{ __('Tanggal Surat') }}
                                    </option>
                                    <option value="received_date" @selected(old('filter', $filter) == 'received_date')>
                                        {{ __('Tanggal Diterima') }}
                                    </option>
                                    <option value="created_at" @selected(old('filter', $filter) == 'created_at')>
                                        {{ __('Tanggal Dibuat') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-success" type="submit">
                                <i class="bi bi-filter"></i>
                                Filter
                            </button>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <table class="table" id="table">
                        <thead>
                            <tr class="fw-bold text-center">
                                <td>{{ __('No.') }}</td>
                                <td>{{ __('No. Agenda') }}</td>
                                <td>{{ __('No. Surat') }}</td>
                                <td>{{ __('Pengirim') }}</td>
                                <td>{{ __('Tanggal') }}</td>
                                <td>{{ __('Aksi') }}</td>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($incomings as $idx => $incoming)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $incoming->agenda_number }}</td>
                                    <td>
                                        <a href="#" class="text-decoration-none text-success fw-semibold">
                                            {{ $incoming->reference_number }}
                                        </a>
                                    </td>
                                    <td>{{ $incoming->from }}</td>
                                    <td>{{ $incoming->formatted_letter_date }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('Tidak ada data surat masuk') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $incomings->links() }}
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-btn').forEach((btn) => {
                btn.addEventListener('click', function (event) {
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus surat ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ya',
                        reverseButtons: true,
                        buttonsStyling: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            btn.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
