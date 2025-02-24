@section('title')
    {{ __('Surat Pengesahan (SP)') }}
@endsection

@extends('admins.layout')

@section('content')
    <x-breadcrumb :values="[__('Surat-menyurat'), __('Pengajuan Surat Pengesahan (SP)')]">
        @if (in_array(auth()->user()->role_id, [3]))
            <a href="{{ route('dashboard.letters.validation-submission.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-envelope-arrow-up me-2"></i>
                {{ __('Ajukan SP') }}
            </a>
        @endif
    </x-breadcrumb>

    @if ($letters->isEmpty())
        <div class="d-flex align-items-center justify-content-center empty-content p-4">
            <h1 class="text-secondary">{{ __('Belum ada pengajuan SP yang dilakukan') }}</h1>
        </div>
    @endif

    @foreach ($letters as $letter)
        <x-letter-card :letter="$letter" />
    @endforeach
@endsection
