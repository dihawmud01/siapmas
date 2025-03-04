@section('title')
    {{ __('Kader Lakut') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Kaderisasi Lakut'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Data Kader Pasca Lakut') }}</h4>
            <table class="table-striped table-hover table">
                <tr>
                    <td class="text-center">{{ __('No.') }}</td>
                    <td>{{ __('Nama') }}</td>
                    <td class="text-start">{{ __('PAC') }}</td>
                    <td class="text-center">{{ __('Profile') }}</td>
                    <td class="text-center">{{ __('Aksi') }}</td>
                </tr>

                @foreach ($lakutCadres as $lakut)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $lakut->name }}</td>
                        <td>{{ $lakut->pac->pac }}</td>
                        <td class="text-center">
                            <img
                                class="rouded-circle"
                                style="width: 40px; height: 40px; object-fit: cover"
                                src="{{ asset('storage/images/' . $lakut->img) }}"
                                alt="{{ __('profile') }}"
                            />
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.detail', ['id' => $lakut->id]) }}" class="btn btn-success btn-sm">
                                {{ __('Detail') }}
                            </a>
                            <a
                                href="{{ route('profile.user', ['slug' => $lakut->slug]) }}"
                                class="btn btn-warning btn-sm"
                            >
                                {{ __('Profile') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $lakutCadres->links() }}
        </div>
    </div>
@endsection
