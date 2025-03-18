@section('title')
    {{ __('Surat-menyurat') }}
@endsection

@extends('admins.layout')
@section('path', __('Surat-Menyurat'))
@section('page_title', __('Surat Masuk'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-4 pt-4">
            <!-- Judul -->
            {{-- <h2 class="fw-bold my-4 pt-4 text-center">{{ __('Surat Masuk') }}</h2> --}}

            <!-- Info Jumlah Surat -->
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">{{ __('Total Surat Masuk: ') }} {{ count($incomings) }}</h5>
                    {{-- <div class="position-relative d-inline-block w-25"> --}}
                    {{-- <input --}}
                    {{-- type="text" --}}
                    {{-- class="form-control search-input pe-4" --}}
                    {{-- placeholder="Cari berdasarkan Nomor atau Pengirim..." --}}
                    {{-- /> --}}
                    {{-- <span --}}
                    {{-- style=" --}}
                    {{-- display: none; --}}
                    {{-- position: absolute; --}}
                    {{-- right: 10px; --}}
                    {{-- top: 50%; --}}
                    {{-- transform: translateY(-50%); --}}
                    {{-- cursor: pointer; --}}
                    {{-- color: gray; --}}
                    {{-- font-size: 14px; --}}
                    {{-- user-select: none; --}}
                    {{-- " --}}
                    {{-- > --}}
                    {{-- &#x2715; --}}
                    {{-- </span> --}}
                    {{-- </div> --}}

                    <form action="{{ url()->current() }}" method="GET" class="d-flex">
                        <div class="d-flex align-items-end">
                            <div class="me-2">
                                <x-input-form
                                    name="since"
                                    :label="__('Dari Tanggal')"
                                    type="date"
                                    :value="$since ? date('Y-m-d', strtotime($since)) : ''"
                                />
                            </div>
                            <div class="me-2">
                                <x-input-form
                                    name="until"
                                    :label="__('Sampai Tanggal')"
                                    type="date"
                                    :value="$until ? date('Y-m-d', strtotime($until)) : ''"
                                />
                            </div>
                            <div class="me-2">
                                <label for="filter" class="form-label">{{ __('Filter Berdasarkan') }}</label>
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
                            <div>
                                {{-- <a href="" target="_blank" class="btn btn-secondary"> --}}
                                {{-- {{ __('menu.general.print') }} --}}
                                {{-- </a> --}}
                            </div>
                            <button class="btn btn-success ms-3" type="submit">
                                <i class="bi bi-filter"></i>
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Surat Masuk -->
            <div class="row">
                <table class="table-hover table" id="table">
                    <thead class="table">
                        <tr class="fw-bold text-center">
                            <td>{{ __('No.') }}</td>
                            <td>{{ __('No. Agenda') }}</td>
                            <td class="text-start">{{ __('No. Surat') }}</td>
                            <td class="text-start">{{ __('Pengirim') }}</td>
                            <td class="text-start">{{ __('Tanggal') }}</td>
                            <td>{{ __('Aksi') }}</td>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($incomings as $idx => $incoming)
                            <tr>
                                <td class="text-center">{{ $idx + 1 }}</td>
                                <td class="text-center">{{ $incoming->agenda_number }}</td>
                                <td class="text-start">
                                    <a href="" class="text-decoration-none text-success fw-semibold">
                                        {{ $incoming->reference_number }}
                                    </a>
                                </td>
                                <td class="text-start">{{ $incoming->from }}</td>
                                <td class="text-start">{{ $incoming->formatted_letter_date }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-success btn-sm me-1"><i class="bi bi-eye-fill"></i></a>
                                    <a href="#" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')"
                                        >
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                    {{-- <a href="#" class="btn btn-success btn-sm me-1"> --}}
                                    {{-- <i class="bi bi-check"></i> --}}
                                    {{-- Setujui --}}
                                    {{-- </a> --}}
                                    {{-- <a href="#" class="btn btn-danger btn-sm"> --}}
                                    {{-- <i class="bi bi-x"></i> --}}
                                    {{-- Tolak --}}
                                    {{-- </a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('menu.general.empty') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $incomings->links() }}
        </div>
    </div>
@endsection
