<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('User | PC IPNU IPPNU BANYUMAS') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<body>
@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">

            <div class="text-center pt-5 mt-5">
                <h4>{{ __('Tambah Kader') }}</h4>
            </div>
            <div class="row pt-4 mt-5">
                <div class="col-md-6">

                    <form action="{{ route('store.users') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Lengkap Sesuai KTP') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   id="name">

                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                            <select name="gender" id="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                <option disabled selected>{{ __('-- Pilih --') }}</option>
                                @foreach ($genders as $value => $label)
                                    <option value="{{ $value }}" {{ old('gender') == $value ? 'selected' : '' }}>
                                        {{ __($label) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">{{ __('Nomor Induk Mahasiswa (NIM)') }}</label>
                            <input type="text" name="nim" id="nim"
                                   class="form-control @error('nim') is-invalid @enderror" required>

                            @error('nim')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label for="place" class="form-label">{{ __('Tempat Lahir') }}</label>
                            <input type="text" name="place" id="place"
                                   class="form-control @error('place') is-invalid @enderror">

                            @error('place')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">{{ __('Tanggal Lahir') }}</label>
                            <input type="date" name="date" id="date"
                                   class="form-control @error('date') is-invalid @enderror" required>

                            @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('Alamat Lengkap') }}</label>
                            <textarea name="address" id="address"
                                      class="form-control @error('address') is-invalid @enderror" rows="4"></textarea>

                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="boarding-school" class="form-label">{{ __('Pesantren') }}</label>
                            <input type="text" name="boarding-school" id="boardingSchool"
                                   class="form-control @error('boarding-school') is-invalid @enderror"
                                   placeholder="Jika Sempat Tinggal di Pondok">

                            @error('boarding-school')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="highschool" class="form-label">{{ __('SMA/SMK/MA/Sederajat') }}</label>
                            <input type="text" name="highschool"
                                   class="form-control @error('highschool') is-invalid @enderror" id="highschool"
                                   required>

                            @error('highschool')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="grad-year"
                                   class="form-label">{{ __('Tahun Lulus SMA/SMK/MA/Sederajat') }}</label>
                            <input type="number" name="grad-year" id="gradYear"
                                   class="form-control @error('grad-year') is-invalid @enderror" required>

                            @error('grad-year')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="college-year" class="form-label">{{ __('Tahun Masuk Kuliah') }}</label>
                            <input type="number" name="college-year" id="collegeYear"
                                   class="form-control @error('college-year') is-invalid @enderror" required>

                            @error('college-year')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pac-id" class="form-label">{{ __('PAC') }}</label>
                            <div>
                                <select id="pacId" name="pac-id" class="form-select" required onchange="showOptions()">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>
                                    @foreach ($pacList as $pac)
                                        <option value="{{ $pac }}" {{ old('pac') == $pac ? 'selected' : '' }}>
                                            {{ $pac }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cadre_level" class="form-label">{{ __('Jenjang Kaderisasi') }}</label>
                            <div>
                                <select id="cadreLevel" name="cadre_level" class="form-select" onchange="showOptions()">
                                    {{ __('-- Pilih --') }}
                                    @foreach($cadreLevels as $level)
                                        <option
                                            value="{{ $level }}" {{old('cadre_level') == $level ? 'selected' : ''}}>{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-md-6">
                                <select id="makestaYear" name="makesta_year" class="form-select" style="display:none;">
                                    <option disabled selected>{{ __('-- Tahun Makesta --') }}</option>
                                    @foreach ($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ old('makesta_year') == $value ? 'selected' : '' }}>
                                            {{ __($label) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-md-6">
                                <select id="lakmudYear" name="lakmud_year" class="form-select" style="display:none;">
                                    <option disabled selected>{{ __('-- Tahun Lakmud --') }}</option>
                                    @foreach ($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ old('makesta_year') == $value ? 'selected' : '' }}>
                                            {{ __($label) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="informal" class="form-label">{{ __('Mengikuti Sekolah Informal') }}</label>
                            <div>
                                <select name="informal" class="form-select" required aria-label="informal">
                                    @foreach ($attendanceCount as $idx => $label)
                                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                                        <option value="{{ $idx }}" {{ old('informal') == $idx ? 'selected' : '' }}>
                                            {{ __($label) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="wa" class="form-label">{{ __('Nomor WhatsApp') }}</label>
                            <input type="text" name="wa" class="form-control" id="wa">
                        </div>

                        <div class="my-3">
                            <label for="role_id" class="form-label">{{ __('Status Keanggotaan') }}</label><br>
                            <div>
                                <select id="roleId" name="role_id" class="form-select">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>

                                    @if (in_array(auth()->user()->role_id, [1]))
                                        <option
                                            value="1" {{ old('role_id') == '1' ? 'selected' : '' }}>{{ __('Admin PAC/Komisariat') }}</option>
                                    @endif

                                    <option
                                        value="2" {{ old('role_id') == '2' ? 'selected' : '' }}>{{ __('Kader PC IPNU IPPNU BANYUMAS') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-3 text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">{{ __('Kembali') }}</a>
                            <button type="submit" class="btn btn-success btn-sm">{{ __('Simpan') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @endsection

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
                integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $('body').on('change', '#province_id', function() {
                    let id = $(this).val();
                    let route = "{{ route('get.city') }}";

                    $.ajax({
                        type: 'get',
                        url: route,
                        data: {
                            province_id: id,
                        },
                        success: function(data) {
                            $('#form-kota').html(data);
                        },
                    });
                });

                $('body').on('change', '#city_id', function() {
                    let id = $(this).val();
                    let route = "{{ route('get.district') }}";

                    $.ajax({
                        type: 'get',
                        url: route,
                        data: {
                            city_id: id,
                        },
                        success: function(data) {
                            $('#form-kecamatan').html(data);
                        },
                    });
                });

                $('body').on('change', '#kecamatan_id', function() {
                    let id = $(this).val();
                    let route = "{{ route('get.village') }}";

                    $.ajax({
                        type: 'get',
                        url: route,
                        data: {
                            kecamatan_id: id,
                        },
                        success: function(data) {
                            $('#form-kelurahan').html(data);
                        },
                    });
                });
            });
        </script>

        <script>
            function showOptions() {
                let cadreLevel = document.getElementById('cadreLevel').value;
                let makestaYear = document.getElementById('makestaYear');
                let lakmudYear = document.getElementById('lakmudYear');
                let lakutYear = document.getElementById('lakutYear');
                let latinpelYear = document.getElementById('latinpelYear');

                if (cadreLevel === 'Belum Makesta') {
                    makestaYear.style.display = 'none';
                    lakmudYear.style.display = 'none';
                    lakutYear.style.display = 'none';
                    latinpelYear.style.display = 'none';
                } else if (cadreLevel === 'Makesta') {
                    makestaYear.style.display = 'block';
                    lakmudYear.style.display = 'none';
                    lakutYear.style.display = 'none';
                    latinpelYear.style.display = 'none';
                } else if (cadreLevel === 'Lakmud') {
                    makestaYear.style.display = 'block';
                    lakmudYear.style.display = 'block';
                    lakutYear.style.display = 'none';
                    latinpelYear.style.display = 'none';
                } else if (cadreLevel === 'Lakut') {
                    makestaYear.style.display = 'block';
                    lakmudYear.style.display = 'block';
                    lakutYear.style.display = 'block';
                    latinpelYear.style.display = 'none';
                } else if (cadreLevel === 'Latinpel') {
                    makestaYear.style.display = 'block';
                    lakmudYear.style.display = 'block';
                    lakutYear.style.display = 'block';
                    latinpelYear.style.display = 'block';
                } else {
                    makestaYear.style.display = 'none';
                    lakmudYear.style.display = 'none';
                    lakutYear.style.display = 'none';
                    latinpelYear.style.display = 'none';
                }
            }
        </script>
    </div>
</body>
</html>
