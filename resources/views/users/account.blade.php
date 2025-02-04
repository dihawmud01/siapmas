@section('title')
    {{ __('Profil') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container my-4" style="padding-top: 4rem">
        <main id="main" class="main">
            <div class="pagetitle mt-4">
                <h1>{{ __('Profil') }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ $user->role->role }}</li>
                        <li class="breadcrumb-item active">{{ __('Foto') }}</li>
                    </ol>
                </nav>
            </div>

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body profile-card d-flex flex-column align-items-center pt-4">
                                <img
                                    src="{{ asset('storage/images/' . $user->img) }}"
                                    alt="{{ __('Profil') }}"
                                    class="rounded-circle"
                                    style="height: 200px; width: 200px; object-fit: cover"
                                />
                                <h2></h2>
                                <h3>{{ $user->username }}</h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body pt-3">
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button
                                            class="nav-link active"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profileEdit"
                                        >
                                            {{ __('Edit Profil') }}
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#changePassword">
                                            {{ __('Ubah Kata Sandi') }}
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade profile-overview" id="profileOverview">
                                        <h5 class="card-title">Detail Profil</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('Nama Lengkap') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('Email') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('PAC') }}</div>
                                            <div class="col-lg-9 col-md-8">{{ $user->pac_id }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('Negara') }}</div>
                                            <div class="col-lg-9 col-md-8">Indonesia</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('Alamat') }}</div>
                                            <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">{{ __('Nomor WhatsApp') }}</div>
                                            <div class="col-lg-9 col-md-8">no wa</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade show active profile-edit pt-3" id="profileEdit">
                                        <form
                                            method="POST"
                                            action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label for="profile-img" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Foto Profil') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <img
                                                        src="{{ asset('storage/images/' . $user->img) }}"
                                                        alt="{{ __('Profil') }}"
                                                        style="height: 200px"
                                                    />
                                                    <div class="pt-2">
                                                        <p class="text-danger">
                                                            {{ __('Maksimal 4 MB') }}
                                                            <br />
                                                            {{ __('Format JPG/PNG/JPEG') }}
                                                        </p>
                                                        <div class="mb-3">
                                                            <div class="mb-3">
                                                                <label for="formFileSm" class="form-label"></label>
                                                                <input
                                                                    class="form-control form-control"
                                                                    id="formFileSm"
                                                                    type="file"
                                                                    name="img"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Nama Lengkap') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="name"
                                                        type="text"
                                                        class="form-control"
                                                        id="name"
                                                        value="{{ $user->name }}"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="bio" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Biografi') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="bio"
                                                        type="text"
                                                        class="form-control"
                                                        id="bio"
                                                        value="{{ $user->bio }}"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Username') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="fullName"
                                                        type="text"
                                                        class="form-control"
                                                        id="fullName"
                                                        value="{{ $user->username }}"
                                                        readonly
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="nim" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Nomor Induk Mahasiswa (NIM)') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="nim"
                                                        type="text"
                                                        class="form-control"
                                                        id="nim"
                                                        value="{{ $user->nim }}"
                                                        readonly
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="pac" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('PAC') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="pac"
                                                        type="text"
                                                        class="form-control"
                                                        id="pac"
                                                        value="{{ $user->pac->pac }}"
                                                        readonly
                                                    />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="level" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Jenjang Kaderisasi') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="job"
                                                        type="text"
                                                        class="form-control"
                                                        id="level"
                                                        value="{{ $user->cadre_level }}"
                                                        readonly
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="gender" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Jenis Kelamin') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select
                                                        class="form-select"
                                                        name="gender"
                                                        aria-label="Default select example"
                                                    >
                                                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                                                        @foreach ($genders as $value => $label)
                                                            <option
                                                                value="{{ $value }}"
                                                                {{ $user->gender == $value ? 'selected' : '' }}
                                                            >
                                                                {{ __($label) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="address" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Alamat Lengkap') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="address"
                                                        type="text"
                                                        class="form-control"
                                                        id="address"
                                                        value="{{ $user->address }}"
                                                        required
                                                    />
                                                    <p class="text-danger"></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="date" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Tanggal Lahir') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="date"
                                                        type="date"
                                                        class="form-control"
                                                        id="date"
                                                        value="{{ $user->date_of_birth }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="hobby" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Hobi') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select
                                                        class="form-select"
                                                        name="hobby"
                                                        aria-label="Default select example"
                                                    >
                                                        <option disabled selected>{{ __('-- Pilih --') }}</option>
                                                        @foreach ($hobbies as $value => $label)
                                                            <option
                                                                value="{{ $value }}"
                                                                {{ $user->hobby == $value ? 'selected' : '' }}
                                                            >
                                                                {{ __($label) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="highschool" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('SMA/SMK/MA/Sederajat') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="highschool"
                                                        type="text"
                                                        class="form-control"
                                                        id="highschool"
                                                        value="{{ $user->highschool }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="grad_year" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Tahun Lulus SMA/SMK/MA/Sederajat') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="grad_year"
                                                        type="text"
                                                        class="form-control"
                                                        id="gradYear"
                                                        value="{{ $user->grad_year }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="college_year" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Tahun Masuk Kuliah') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="college_year"
                                                        type="text"
                                                        class="form-control"
                                                        id="collegeYear"
                                                        value="{{ $user->college_year }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="wa" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Nomor WhatsApp') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="wa"
                                                        type="text"
                                                        class="form-control"
                                                        id="wa"
                                                        value="{{ $user->wa }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Email') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="email"
                                                        type="email"
                                                        class="form-control"
                                                        id="email"
                                                        value="{{ $user->email }}"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="x" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil X') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="x"
                                                        type="text"
                                                        class="form-control"
                                                        id="x"
                                                        value="{{ $user->x }}"
                                                        placeholder="Tautan profil X anda"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="fb" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil Facebook') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="fb"
                                                        type="text"
                                                        class="form-control"
                                                        id="fb"
                                                        value="{{ $user->fb }}"
                                                        placeholder="Tautan profil Facebook anda"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="ig" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Profil Instagram') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="ig"
                                                        type="text"
                                                        class="form-control"
                                                        id="ig"
                                                        value="{{ $user->ig }}"
                                                        placeholder="link profile instagram anda"
                                                        required
                                                    />
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <p class="text-danger">
                                                    {{ __('Pastikan semua data sudah terisi dengan benar') }}
                                                </p>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Update') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="profileSettings">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('Buat Postingan') }}</h3>
                                            </div>

                                            <form
                                                role="form"
                                                method="POST"
                                                action="{{ route('profile.post.store') }}"
                                                enctype="multipart/form-data"
                                            >
                                                @csrf
                                                <div class="card-body">
                                                    @include('admins.posts.form')
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Simpan') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="profileChangePassword">
                                        <form method="POST" action="{{ route('change-password') }}">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="current_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Kata Sandi Saat Ini') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="current_password"
                                                        type="password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        id="currentPassword"
                                                    />
                                                    @error('current_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="new_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Kata Sandi Baru') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="new_password"
                                                        type="password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        id="newPassword"
                                                    />
                                                    @error('new_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="reenter_password" class="col-md-4 col-lg-3 col-form-label">
                                                    {{ __('Masukkan Ulang Kata Sandi Baru') }}
                                                </label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="reenter_password"
                                                        type="password"
                                                        class="form-control @error('reenter_password') is-invalid @enderror"
                                                        id="reenterPassword"
                                                    />
                                                    @error('reenter_password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Ubah') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        $('textarea#summernote').summernote({
            placeholder: '{{ __('Sahabat bisa membuat tulisan disini') }}',
            tabsize: 2,
            height: 100,
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });
    </script>
@endsection
