@section('title')
    {{ __('Anggota') }}
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
                <div class="text-start">
                    <a href="{{ route('dashboard.members.index') }}" class="btn fs-4 border-0">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </div>
                <div class="d-flex flex-column w-100">
                    <h3 class="fw-bold">{{ __('Tambah Anggota') }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="row mt-5 pt-4">
                <form action="{{ route('dashboard.members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input-form name="name" label="{{ __('Nama Lengkap sesuai KTP') }}" />
                    <x-input-form
                        name="photo"
                        label="{{ __('Foto Profil') }}"
                        type="file"
                        accept="image/jpeg,image/png"
                        required="0"
                    />

                    <x-input-select name="gender" label="{{ __('Jenis Kelamin') }}" :options="$genders" />

                    <x-input-form name="place_of_birth" label="{{ __('Tempat Lahir') }}" />

                    <x-input-form name="date_of_birth" label="{{ __('Tanggal Lahir') }}" type="date" />

                    <x-input-textarea name="address" label="{{ __('Alamat Lengkap') }}" />

                    <div
                        x-data="{
                            formalCadreLevels: {{ json_encode(old('formal_cadre_levels', []) ?: []) }},
                        }"
                        x-init="
                            $watch('formalCadreLevels', (value) => {
                                if (value.includes('lakmud') && ! value.includes('makesta')) {
                                    value.push('makesta')
                                }
                            })
                        "
                    >
                        <div class="d-flex align-items-start mb-4">
                            <label class="form-label label me-3 text-start">
                                {{ __('Jenjang Kaderisasi Formal') }}
                            </label>
                            <div class="d-flex flex-column w-100">
                                @foreach ($formalCadreLevels as $level)
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="formal_cadre_levels_{{ $level }}"
                                            name="formal_cadre_levels[]"
                                            value="{{ $level }}"
                                            class="form-check-input"
                                            x-model="formalCadreLevels"
                                            @change="$dispatch('checkbox-changed', '{{ $level }}')"
                                            :disabled="('{{ $level }}' === 'makesta' && formalCadreLevels.includes('lakmud'))"
                                            {{ in_array($level, old('formal_cadre_levels[]', [])) ? 'checked' : '' }}
                                        />
                                        <label for="formal_cadre_levels_{{ $level }}" class="form-check-label">
                                            {{ ucfirst($level) }}
                                        </label>
                                    </div>
                                @endforeach

                                <template x-if="formalCadreLevels.includes('makesta')">
                                    <input type="hidden" name="formal_cadre_levels[]" value="makesta" />
                                </template>
                            </div>
                        </div>

                        <div x-show="formalCadreLevels.includes('makesta')">
                            <x-input-select
                                name="makesta_year"
                                label="{{ __('Tahun Makesta') }}"
                                :options="$years"
                                required="0"
                            />
                        </div>

                        <div x-show="formalCadreLevels.includes('lakmud')">
                            <x-input-select
                                name="lakmud_year"
                                label="{{ __('Tahun Lakmud') }}"
                                :options="$years"
                                required="0"
                            />
                        </div>

                        <div x-show="formalCadreLevels.includes('lakut')">
                            <x-input-select
                                name="lakut_year"
                                label="{{ __('Tahun Lakut') }}"
                                :options="$years"
                                required="0"
                            />
                        </div>
                    </div>

                    <div
                        x-data="{
                            nonFormalCadreLevels:
                                {{ json_encode(old('non_formal_cadre_levels', []) ?: []) }},
                        }"
                    >
                        <div class="d-flex align-items-start mb-4">
                            <label class="form-label label me-3 text-start">
                                {{ __('Jenjang Kaderisasi Non-Formal') }}
                            </label>
                            <div class="d-flex flex-column w-100">
                                @foreach ($nonFormalCadreLevels as $level)
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            id="non_formal_cadre_levels_{{ $level }}"
                                            name="non_formal_cadre_levels[]"
                                            value="{{ $level }}"
                                            class="form-check-input"
                                            x-model="nonFormalCadreLevels"
                                            {{ in_array($level, old('non_formal_cadre_levels[]', [])) ? 'checked' : '' }}
                                        />
                                        <label for="non_formal_cadre_levels_{{ $level }}" class="form-check-label">
                                            {{ ucfirst($level) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <x-input-form name="phone" label="{{ __('No. HP') }}" />

                    @if (auth()->user()->role_id == 2)
                        <x-input-select name="pac_id" label="{{ __('PAC') }}" :options="$pacList" />
                        <x-input-select
                            name="membership_status"
                            label="{{ __('Status Keanggotaan') }}"
                            :options="$membershipStatus"
                        />
                    @endif

                    <div class="d-flex align-items-center justify-content-end">
                        <a
                            href="{{ route('dashboard.members.index') }}"
                            class="text-secondary text-decoration-none me-3"
                        >
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
