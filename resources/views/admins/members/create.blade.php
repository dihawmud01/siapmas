@section('title')
    {{ __('Surat Pengesahan (SP)') }}
@endsection

@extends('admins.layout')

@push('script')
    @vite('resources/js/plugins/alpine.js')
@endpush

@section('content')
    <x-breadcrumb :values="[__('Anggota'), __('Tambah Anggota')]"></x-breadcrumb>

    <div class="card">
        <div class="card-header bg-transparent text-center">
            <div class="d-flex align-items-center p-4">
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Tambah Anggota') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row mt-5 pt-4">
                <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <x-input-form name="name" label="{{ __('Nama Lengkap sesuai KTP') }}" />

                    <x-input-select name="gender" label="{{ __('Jenis Kelamin') }}" :options="$genders" />

                    <x-input-form name="place_of_birth" label="{{ __('Tempat Lahir') }}" />

                    <x-input-form name="date_of_birth" label="{{ __('Tanggal Lahir') }}" type="date" />

                    <x-input-textarea name="address" label="{{ __('Alamat Lengkap') }}" />

                    <x-input-form
                        name="boarding_school"
                        label="{{ __('Pesantren') }}"
                        placeholder="{{ __('Jika sempat tinggal di Pesantren') }}"
                    />

                    <x-input-form name="highschool" label="{{ __('SMA/SMK/MA/Sederajat') }}" />

                    <x-input-form name="grad_year" label="{{ __('Tahun Lulus SMA/SMK/MA/Sederajat') }}" type="number" />

                    <x-input-form name="college_year" label="{{ __('Tahun Masuk Kuliah') }}" type="number" />

                    <div x-data="{ cadreLevels: [], options: {{ json_encode($cadreLevels) }} }">
                        <div class="d-flex align-items-start mb-4">
                            <label class="form-label label me-3 text-start">{{ __('Jenjang Kaderisasi') }}</label>
                            <div class="d-flex flex-column w-100">
                                <template x-for="[key, label] in Object.entries(options)" :key="key">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="cadre_levels[]"
                                            :id="'cadre_levels_' + key"
                                            :value="key"
                                            class="form-check-input"
                                            x-model="cadreLevels"
                                        />
                                        <label
                                            :for="'cadre_levels_' + key"
                                            class="form-check-label"
                                            x-text="label"
                                        ></label>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <template x-if="cadreLevels.includes('makesta')">
                            <x-input-select name="makesta_year" label="{{ __('Tahun Makesta') }}" :options="$years" />
                        </template>

                        <template x-if="cadreLevels.includes('lakmud')">
                            <x-input-select name="lakmud_year" label="{{ __('Tahun Lakmud') }}" :options="$years" />
                        </template>

                        <template x-if="cadreLevels.includes('lakut')">
                            <x-input-select name="lakut_year" label="{{ __('Tahun Lakut') }}" :options="$years" />
                        </template>

                        <template x-if="cadreLevels.includes('latinpel')">
                            <x-input-select
                                name="latinpel_year"
                                label="{{ __('Tahun Latinpel') }}"
                                :options="$years"
                            />
                        </template>
                    </div>

                    <x-input-select
                        name="informal"
                        label="{{ __('Mengikuti Sekolah Informal') }}"
                        :options="$attendanceCount"
                    />

                    <x-input-form name="phone" label="{{ __('Nomor WhatsApp') }}" />

                    <div class="d-flex align-items-center justify-content-end">
                        <a href="{{ route('members.index') }}" class="text-secondary text-decoration-none me-3">
                            {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-success">
                            {{ __('Tambah') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
