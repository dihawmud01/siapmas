@section('title')
    {{ __('Kader Lakmud') }}
@endsection

@extends('admins.layout')
@section('page_title', __('Kaderisasi Lakmud'))

@section('content')
    <div class="card info-card sales-card">
        <div class="container my-3">
            <h4 class="my-5">{{ __('Data Kader Pasca Lakmud') }}</h4>
            <table class="table-striped table-hover table">
                <tr>
                    <td class="text-center">{{ __('No.') }}</td>
                    <td>{{ __('Nama') }}</td>
                    <td class="text-start">{{ __('PAC') }}</td>
                    <td class="text-center">{{ __('Profil') }}</td>
                    <td class="text-center">{{ __('Aksi') }}</td>
                </tr>

                @foreach ($lakmudCadres as $lakmud)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $lakmud->name }}</td>
                        <td>{{ $lakmud->pac->pac }}</td>
                        <td class="text-center">
                            <img
                                class="rouded-circle"
                                style="width: 40px; height: 40px; object-fit: cover"
                                src="{{ asset('storage/images/' . $lakmud->img) }}"
                                alt="{{ __('Profil') }}"
                            />
                        </td>
                        <td class="text-center">
                            <a
                                href="{{ route('users.detail', ['id' => $lakmud->id]) }}"
                                class="btn btn-success btn-sm"
                            >
                                {{ __('Detail') }}
                            </a>
                            <a
                                href="{{ route('profile.user', ['slug' => $lakmud->slug]) }}"
                                class="btn btn-warning btn-sm"
                            >
                                {{ __('Profil') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $lakmudCadres->links() }}
        </div>
    </div>
@endsection
