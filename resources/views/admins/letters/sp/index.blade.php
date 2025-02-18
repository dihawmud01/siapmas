@section('title')
    {{ __('Surat Pengesahan (SP)') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Pengajuan Surat Pengesahan (SP)')]">
        <a href="{{ route('dashboard.letters.validation.create') }}" class="btn btn-success btn-lg">
            <i class="bi bi-envelope-arrow-up me-2"></i>
            {{ __('Ajukan SP') }}
        </a>
    </x-breadcrumb>

    @foreach ($data as $letter)
        <x-letter-card :letter="$letter" />
    @endforeach
@endsection
