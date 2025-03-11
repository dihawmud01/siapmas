@section('title')
    {{ __('Kader Makesta') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Makesta'))
@section('path', __('Kaderisasi'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h4 class="m-0">{{ __('Data Kader Makesta') }}</h4>
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

            <table class="table-striped table-hover table" id="table">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('No.') }}</th>
                        <th onclick="sortTable(1)" style="cursor: pointer">
                            {{ __('Nama') }}
                            <span style="color: gray">&#x25B2;&#x25BC;</span>
                        </th>
                        <th onclick="sortTable(2)" style="cursor: pointer">
                            {{ __('PAC') }}
                            <span style="color: gray">&#x25B2;&#x25BC;</span>
                        </th>
                        <th class="text-center">{{ __('Profile') }}</th>
                        <th class="text-center">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($makestaCadres as $cadre)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $cadre->name }}</td>
                            <td>{{ $cadre->pac->pac }}</td>
                            <td class="text-center">
                                <img
                                    class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover"
                                    src="{{ asset('storage/images/' . $cadre->img) }}"
                                    alt="profile"
                                />
                            </td>
                            <td class="text-center">
                                <a
                                    href="{{ route('users.detail', ['id' => $cadre->id]) }}"
                                    class="btn btn-success btn-sm"
                                >
                                    {{ __('Detail') }}
                                </a>
                                <a
                                    href="{{ route('profile.user', ['slug' => $cadre->slug]) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    {{ __('Profil') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $makestaCadres->links() }}
        </div>
    </div>

    <script></script>
@endsection
