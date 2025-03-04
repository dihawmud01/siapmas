@section('title')
    {{ __('Anggota') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Anggota'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="fw-bold my-4 pt-4 text-center">
                {{ __('Data Anggota ') }}
                {{ in_array(auth()->user()->pac_id, [28, 29]) ? ucwords(strtolower(auth()->user()->pac->pac)) : 'PAC ' . ucwords(strtolower(auth()->user()->pac->pac)) }}
            </h2>

            <div class="row align-items-center mb-3">
                <div class="col-12 d-flex justify-content-between align-items-end">
                    <h5 class="fw-semibold mb-2">{{ __('Total Anggota: ') }} {{ $members->count() }}</h5>

                    <div class="d-flex w-50 justify-content-end">
                        <form action="{{ route('members.index') }}" method="GET" class="d-flex position-relative w-75">
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

                        <a href="{{ route('members.create') }}" class="btn btn-success fw-semibold ms-2">
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
                            <td class="text-start">{{ __('Nama') }}</td>
                            <td class="text-start">{{ __('PAC') }}</td>
                            <td class="text-center">{{ __('Aksi') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $idx => $cadre)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $cadre['name'] }}</td>
                                <td>
                                    <a
                                        class="text-decoration-none text-success"
                                        href="{{ route('members.pac.list', ['slug' => $cadre->pac->slug]) }}"
                                    >
                                        {{ $cadre->pac->pac }}
                                    </a>
                                </td>
                                @auth
                                    <td class="text-center">
                                        <a
                                            href="{{ route('members.detail', ['id' => $cadre->id]) }}"
                                            class="btn btn-success btn-sm"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a
                                            href="{{ route('members.edit', ['id' => $cadre->id]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            <i class="bi bi-pen-fill"></i>
                                        </a>
                                        @if (auth()->user()->role_id == 3)
                                            <form
                                                action="{{ route('members.destroy', $cadre->id) }}"
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
