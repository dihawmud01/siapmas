@section('title')
    {{ __('User') }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <div class="text-center pt-5 mt-5">
                <h4>{{ __('Edit Kader') }}</h4>
            </div>
            <div class="row pt-4 mt-5">
                <div class="col-md-6">
                    <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                            <select name="gender" id="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                <option disabled selected>{{ __('-- Pilih --') }}</option>
                                @foreach ($genders as $key => $label)
                                    <option value="{{ $key }}" {{ $user->gender == $key ? 'selected' : '' }}>
                                        {{ __($label) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('Alamat') }}</label>
                            <textarea class="form-control" id="address" rows="4">{{ $user->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">{{ __('NIM') }}</label>
                            <input type="text" class="form-control" id="nim" value="{{ $user->nim }}">
                        </div>

                        <div class="mb-3">
                            <label for="place_of_birth" class="form-label">{{ __('Tempat Lahir') }}</label>
                            <input type="text" name="place_of_birth" class="form-control" id="placeOfBirth"
                                   value="{{ $user->place_of_birth }}">
                        </div>

                        <div class="mb-3">
                            <label for="pac" class="form-label">{{ __('PAC') }}</label>
                            <div class="col-md-12">
                                <select id="pacId" name="pac_id" class="form-select" onchange="showOptions()">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>

                                    @foreach($pacList as $idx => $label)
                                        <option
                                            value="{{ $idx }}" {{ $user->pac_id == $idx ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cadre_level" class="form-label">{{ __('Jenjang Kaderisasi Saat Ini') }}</label>
                            <div class="col-md-12">
                                <select id="cadreLevel" name="cadre_level" class="form-select"
                                        onchange="showOptions()">
                                    <option disabled selected>{{ __(' -- Pilih --')}}</option>

                                    @foreach($cadreLevels as $level)
                                        <option
                                            value="{{ $level }}" {{ $user->cadre_level == $level ? 'selected' : ''}}>{{ __($level) }}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <select id="makestaYear" name="makesta_year" class="form-select" style="display:none;">
                                    <option disabled selected>{{ __(' -- Tahun Makesta --')}}</option>

                                    @foreach($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ $user->makesta_year == $value ? 'selected' : ''}}>{{ __($label) }}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <select id="lakmudYear" name="lakmud_year" class="form-select" style="display:none;">
                                    <option disabled selected>{{__('-- Tahun Lakmud --')}}</option>

                                    @foreach($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ $user->lakmud_year == $value ? 'selected' : ''}}>{{__($label)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <select id="lakutYear" name="lakut_year" class="form-select" style="display:none;">
                                    <option disabled selected>{{__('-- Tahun Lakut --')}}</option>

                                    @foreach($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ $user->lakut_year == $value ? 'selected' : ''}}>{{__($label)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <select id="latinpel_year" name="latinpel_year" class="form-select"
                                        style="display:none;">
                                    <option disabled selected>{{__('-- Tahun Latinpel --')}}</option>

                                    @foreach($years as $value => $label)
                                        <option
                                            value="{{ $value }}" {{ $user->latinpel_year == $value ? 'selected' : ''}}>{{__($label)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="informal" class="form-label">{{ __('Mengikuti Sekolah Informal') }}</label>
                            <div class="col-md-12">
                                <select name="informal" class="form-select" required aria-label="informal">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>

                                    @foreach($attendanceCount as $idx => $label)
                                        <option
                                            value="{{ $idx }}" {{ $user->informal == $idx ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nonformal" class="form-label">{{ __('Mengikuti Sekolah Non-Formal') }}</label>
                            <div class="col-md-12">
                                <select name="nonformal" class="form-select" required aria-label="nonformal">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>

                                    @foreach($attendanceCount as $idx => $label)
                                        <option
                                            value="{{ $idx }}" {{ $user->non_formal == $idx ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="wa" class="form-label">{{ __('Nomor WhatsApp') }}</label>
                            <input type="text" name="wa" class="form-control" id="wa" value="{{ $user->wa }}">
                        </div>

                        {{-- Role Start --}}
                        <div class="my-3 pt-4">
                            <label for="role_id" class="form-label">{{ __('Status Keanggotaan') }}</label><br>
                            <p>{{ __('Jika Anggota tersebut memang benar tercatat di database PAC, maka pilih &quot;Kader PC IPNU
                                IPPNU Banyumas&quot;,') }}<br>
                                {{ __('Namun, jika anggota tersebut tidak tercatat di database PAC maka pilih "Bukan Kader PC
                                IPNU IPPNU Banyumas') }}
                                "</p>
                            <div class="col-md-12">
                                <select id="roleId" name="role_id" class="form-select">
                                    <option disabled selected>{{ __('-- Pilih --') }}</option>

                                    @if (in_array(auth()->user()->role_id, [1]))
                                        <option
                                            value="1" {{ $user->role_id == '1' ? 'selected' : '' }}>{{ __('Admin PAC/Komisariat') }}
                                        </option>
                                    @endif

                                    @foreach($roles as $idx => $label)
                                        <option
                                            value="{{$idx + 2}}" {{ $user->role_id == $idx ? 'selected' : '' }}>{{ __($label)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="my-3 pt-4">
                            <div>
                                <a href="{{ route('users.index') }}">
                                    <button class="btn btn-warning" type="submit">{{ __('Kembali') }}</button>
                                </a>
                                <button class="btn btn-primary" type="submit">{{ __('Simpan') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="text-center">
                        <img src="{{ asset('storage/images/' . $user->img ) }}" class="rounded" alt="..."
                             style="width: 80%; border-radius:20px;box-shadow: 4px 5px 8px rgba(0, 0, 0, 0.3)">
                    </div>
                </div>
            </div>

        </div>


        <script>
            function showOptions() {
                let pacId = document.getElementById('pacId').value;
                let prodi_teknik = document.getElementById('prodi-teknik');
                let prodi_hukum = document.getElementById('prodi-hukum');
                let prodi_ulul_albab = document.getElementById('prodi-ulul-albab');

                if (pacId === '1') {
                    prodi_teknik.style.display = 'block';
                    prodi_hukum.style.display = 'none';
                    prodi_ulul_albab.style.display = 'none';
                } else if (pacId === '2') {
                    prodi_teknik.style.display = 'none';
                    prodi_hukum.style.display = 'block';
                    prodi_ulul_albab.style.display = 'none';
                } else if (pacId === '3') {
                    prodi_teknik.style.display = 'none';
                    prodi_hukum.style.display = 'none';
                    prodi_ulul_albab.style.display = 'block';
                } else {
                    prodi_teknik.style.display = 'none';
                    prodi_hukum.style.display = 'none';
                    prodi_ulul_albab.style.display = 'none';
                }
            }

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
                    let route = "{{ $route_get_kota }}";

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
                    let route = "{{ $route_get_kecamatan }}";

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
                    let route = "{{ $route_get_kelurahan }}";

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
@endsection
