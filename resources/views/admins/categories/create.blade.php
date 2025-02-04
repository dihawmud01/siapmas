@section('title')
    {{ __('Tambah Kategori') }}
@endsection

@extends('admins.layout')
@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h4 class="my-3 text-center">{{ __('Tambah Kategori Blog') }}</h4>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nama Kategori Baru') }}</label>
                    <input type="text" name="name" class="form-control mb-3" id="name" required />
                </div>
                <div class="mb-3">
                    <a href="{{ route('categories.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
