@section('title')
    {{ __('Admin') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Data Admin') }}</h4>

            <table class="table-striped table-hover table">
                <tr>
                    <td class="text-center">{{ __('No.') }}</td>
                    <td>{{ __('Nama') }}</td>
                    <td class="text-start">{{ __('PAC/Komisariat') }}</td>
                    <td class="text-center">{{ __('Profile') }}</td>
                    <td class="text-center">{{ __('Aksi') }}</td>
                </tr>

                @foreach ($admins as $admin)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->pac->pac }}</td>
                        <td class="text-center">
                            <img
                                class="rouded-circle"
                                style="width: 40px; height: 40px; object-fit: cover"
                                src="{{ asset('storage/images/' . $admin->img) }}"
                                alt="{{ __('profile') }}"
                            />
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.detail', ['id' => $admin->id]) }}" class="btn btn-success btn-sm">
                                {{ __('Detail') }}
                            </a>
                            <a
                                href="{{ route('profile.user', ['slug' => $admin->slug]) }}"
                                class="btn btn-warning btn-sm"
                            >
                                {{ __('Profile') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
