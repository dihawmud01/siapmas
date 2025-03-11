@section('title')
    {{ __('Anggota') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Anggota'))

@push('script')
    @vite('resources/js/plugins/glightbox.js')
@endpush

@section('content')
    <x-breadcrumb :values="[__('Anggota'), __('Tambah Anggota')]"></x-breadcrumb>

    <div class="card info-card sales-card min-vh-100">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">
                        {{ __('Data Anggota') }}
                        {{ in_array(auth()->user()->pac_id, [28, 29]) ? ' ' . ucwords(strtolower(auth()->user()->pac->pac)) : ' PAC ' . ucwords(strtolower(auth()->user()->pac->pac)) }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="container-fluid p-5">
            <div class="row align-items-center mb-3">
                <div class="col-12 d-flex justify-content-between align-items-end">
                    <h5 class="fw-semibold mb-2">{{ __('Total Anggota: ') }} {{ $members->count() }}</h5>

                    <div class="d-flex w-50 justify-content-end">
                        <form
                            action="{{ route('dashboard.members.index') }}"
                            method="GET"
                            class="d-flex position-relative w-75"
                        >
                            <input
                                type="text"
                                name="search"
                                id="search-input"
                                class="form-control search-input pe-5"
                                value="{{ old('search', request('search')) }}"
                                placeholder="Cari Nama Kader..."
                            />
                            <button
                                type="button"
                                id="clear-search"
                                class="btn btn-clear text-secondary"
                                style="display: none"
                            >
                                &#x2715;
                            </button>

                            <button type="submit" class="btn ms-2">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <a href="{{ route('dashboard.members.create') }}" class="btn btn-success fw-semibold ms-2">
                            <i class="bi bi-person-plus-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <table class="table" id="table">
                    <thead>
                        <tr class="fw-bold">
                            <td class="text-center">{{ __('No.') }}</td>
                            <td>{{ __('Nama') }}</td>
                            <td class="text-center">{{ __('Foto') }}</td>
                            <td class="text-center">{{ __('Jenis Kelamin') }}</td>
                            <td>{{ __('Tempat, Tanggal Lahir') }}</td>
                            <td>{{ __('Alamat Lengkap') }}</td>
                            <td class="text-center">
                                {{ __('Makesta') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Lakmud') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Lakut') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Diklatama') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Diklatnas') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Diklatmad') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                            </td>
                            <td class="text-center">
                                {{ __('Latinpel') }}
                                <br />
                                <small class="text-secondary fw-light">{{ __('(Non-Formal)') }}</small>
                            </td>
                            <td class="text-center">{{ __('Status Keanggotaan') }}</td>
                            <td class="text-center">{{ __('No. HP') }}</td>
                            <td class="text-center">{{ __('Aksi') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $idx => $member)
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $member['name'] }}</td>
                                <td class="text-center">
                                    <a
                                        href="{{ asset('storage/images/' . ($member['photo'] != 'default.png' ? 'members/' . strtolower(str_replace(' ', '-', auth()->user()->pac->pac)) . '/photo/' . $member['photo'] : 'default.png')) }}"
                                        class="glightbox"
                                        data-gallery="member-gallery"
                                    >
                                        <img
                                            src="{{ asset('storage/images/' . ($member['photo'] != 'default.png' ? 'members/' . strtolower(str_replace(' ', '-', auth()->user()->pac->pac)) . '/photo/' . $member['photo'] : 'default.png')) }}"
                                            width="60"
                                            class="img-fluid img-thumbnail"
                                            style="max-height: 60px"
                                            alt="{{ __('Foto Anggota') }}"
                                        />
                                    </a>
                                </td>
                                <td class="text-center">
                                    {{ $member['gender'] == 'male' ? __('Laki-laki') : __('Perempuan') }}
                                </td>
                                <td>{{ $member['place_of_birth'] . ', ' . $member->formatted_date_of_birth }}</td>
                                <td class="address">{{ $member['address'] }}</td>
                                <td class="text-center">
                                    @if ($member['is_makesta'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_lakmud'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_lakut'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_diklatama'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_diklatnas'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_diklatmad'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member['is_latinpel'])
                                        <i class="bi bi-check text-success"></i>
                                        {{ __('Ya') }}
                                    @else
                                        <i class="bi bi-x text-danger"></i>
                                        {{ __('Tidak') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ 'Anggota ' . ($member['membership_status'] == 'pac_member') ? __('PAC') : __('PC') }}
                                </td>
                                <td class="text-center">{{ $member->phone }}</td>
                                @auth
                                    <td class="btn-action text-center">
                                        <a
                                            href="{{ route('dashboard.members.show', $member) }}"
                                            class="btn btn-success btn-sm"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a
                                            href="{{ route('dashboard.members.edit', $member) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            <i class="bi bi-pen-fill"></i>
                                        </a>
                                        @if (auth()->user()->role_id == 3)
                                            <form
                                                action="{{ route('dashboard.members.destroy', $member->id) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('Apakah Anda yakin ingin menghapus user ini?') }}')"
                                                >
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $members->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let searchInput = document.getElementById('search-input');
            let clearButton = document.getElementById('clear-search');

            function toggleClearButton() {
                if (searchInput.value.trim() !== '') {
                    clearButton.style.display = 'block'; // Tampilkan tombol clear jika input terisi
                } else {
                    clearButton.style.display = 'none'; // Sembunyikan tombol clear jika kosong
                }
            }

            // Saat halaman dimuat, pastikan tombol clear ditampilkan jika ada input
            toggleClearButton();

            // Tambahkan event listener untuk menampilkan/sembunyikan tombol
            searchInput.addEventListener('input', toggleClearButton);

            // Fungsi untuk menghapus input saat tombol clear diklik
            clearButton.addEventListener('click', function () {
                searchInput.value = '';
                toggleClearButton();
                searchInput.focus(); // Kembalikan fokus ke input setelah dikosongkan
            });
        });
    </script>
@endsection
