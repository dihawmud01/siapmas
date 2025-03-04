@section('title')
    {{ __('Detail') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 card my-3">
            <h4 class="my-2 text-center">{{ __('Detail Profil') }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img
                        src="{{ asset('storage/images/' . $user->img) }}"
                        alt="{{ $user->name }}"
                        class="rounded-circle img-fluid"
                        style="width: 150px; height: 150px; object-fit: cover"
                    />
                    <h5 class="my-3">{{ $user->name }}</h5>
                    <h6 class="my-3">{{ __('Kaderisasi') }} {{ $user->cadre_level }}</h6>
                    <h6 class="my-3">{{ __('PAC') }} {{ $user->pac->pac }}</h6>
                    <h6 class="my-3">{{ __('Prodi') }} {{ $user->prodi }}</h6>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    @foreach ($detailUser as $label => $value)
                        <div class="row pt-3">
                            <div class="col-sm-3">
                                <p class="mb-0">{{ __($label) }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $value }}</p>
                            </div>
                        </div>
                        <hr />
                    @endforeach

                    <div class="text-center">
                        <a href="{{ route('users.index') }}" class="btn btn-warning sm">{{ __('Kembali') }}</a>
                        <a href="{{ route('users.cadre-pdf', ['id' => $user->id]) }}" class="btn btn-success sm">
                            {{ __('Unduh KTA') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
