@section('title')
    {{ __('User') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Anggota'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="text-center my-4 pt-4 fw-bold">{{ __('Data Anggota') }}</h2>
            <div class="row align-items-center mb-3">
                <div class="col-12 d-flex justify-content-between align-items-end">
                    <div>
                        <h5 class="mb-2 fw-semibold">{{ __('Total Kader: ') }} {{ $userCounts }}</h5>
                        <div class="d-flex gap-2">

                            <a href="{{ route('users.create') }}"
                               class="btn btn-success fw-semibold">{{ __('Tambah Anggota') }}</a>
                        </div>
                    </div>
                    <div class="position-relative d-inline-block w-25">
                        <input
                            type="text"
                            class="form-control search-input pe-4"
                            data-table-id="table"
                            data-columns="1,2"
                            placeholder="Cari Nama atau PAC..."
                        />
                        <span
                            style="
                            display: none;
                            position: absolute;
                            right: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            cursor: pointer;
                            color: gray;
                            font-size: 14px;
                            user-select: none;
                        "
                        >
                        &#x2715;
                    </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <table class="table" id="table">
                    <tr class="fw-bold">
                        <td class="text-center">{{ __('No.') }}</td>
                        <td class="text-start">{{ __('Nama') }}</td>
                        <td class="text-start">{{ __('PAC') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                    </tr>

                    @foreach ($user as $idx => $cadre)
                        <tr>
                            <td class="text-center">{{ $idx + $user -> firstItem() }}</td>
                            <td>{{ $cadre['name'] }}</td>
                            <td>
                                <a class="text-decoration-none text-success"
                                   href="{{ route('users.pac.list', ['slug' => $cadre->pac->slug]) }}">{{ $cadre->pac->pac }}</a>
                            </td>

                            @auth
                                <td class="text-center">
                                    <form action="{{ route('users.destroy', $cadre->id) }}" method="POST">
                                        <a href="{{ route('users.detail', ['id' => $cadre->id]) }}"
                                           class="btn btn-success btn-sm"> <i class="ri-eye-fill"></i></a>
                                        <a href="{{ route('profile.user', ['slug' => $cadre->slug]) }}"
                                           class="btn btn-secondary btn-sm"><i class="ri-user-fill"></i></a>
                                        <a href="{{ route('users.edit', ['id' => $cadre->id]) }}"
                                           class="btn btn-warning btn-sm"><i class="ri-edit-fill"></i></a>
                                        @if (auth()->user()->role_id == 1)
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm
                            ('{{ __('Apakah Anda yakin ingin menghapus user ini?') }}')"><i
                                                    class="ri-delete-bin-5-line"></i>
                                            </button>
                                    </form>
                                </td>
                            @endif
                            @endauth
                        </tr>
                    @endforeach
                </table>
            </div>

            {{ $user->links() }}
        </div>

    </div>
@endsection
