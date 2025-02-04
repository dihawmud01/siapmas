@section('title')
    {{ __('Profil') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container my-4" style="padding-top: 5rem">
        <header class="pt-3 pb-5 bg-white">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/images/'. $profile->img) }}" alt="{{ __('Profile Image') }}"
                         class="rounded-circle mr-4 profile-image-desktop"
                         style="width: 125px; height: 125px; object-fit: cover;">
                    <div class="d-flex flex-column">
                        <h1 class="h4 font-weight-bold">
                            {{ $profile->username }}

                            @if($profile->check == '1')
                                <i class="fas fa-check-circle text-primary"></i>
                            @endif

                        </h1>
                        <div class="d-flex align-items-center">
                            <span class="mr-4"><strong>{{ $postCounts }}</strong> {{ __('Postingan') }}</span>
                            <span><strong>{{ $libraryCounts }}</strong> {{ __('Perpustakaan') }}</span>
                        </div>

                        @if($profile->cadre_level == 'Belum Makesta')
                            <button class="btn btn-danger">{{ __('Belum Makesta') }}</button>
                        @endif

                        @if($profile->cadre_level == 'Makesta')
                            <button class="btn btn-success">{{ __('Kader Makesta') }}</button>
                        @endif

                        @if($profile->cadre_level == 'Lakmud')
                            <button class="btn btn-success">{{ __('Kader Lakmud') }}</button>
                        @endif

                        @if($profile->cadre_level == 'Lakut')
                            <button class="btn btn-success">{{ __('Kader Lakut') }}</button>
                        @endif

                        @if($profile->cadre_level == 'Latinpel')
                            <button class="btn btn-success">{{ __('Kader Latinpel') }}</button>
                        @endif

                        <p class="mt-2">{{ $profile->bio }}</p>
                    </div>
                </div>
            </div>
        </header>
        <br>
@endsection
