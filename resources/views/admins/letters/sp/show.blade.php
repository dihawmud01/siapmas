@section('title')
    {{ __('Review SP') }}
@endsection

@extends('admins.layout')

@section('content')
    @section('content')
        <x-breadcrumb
            :values="[__('Surat-menyurat'), __('Pengajuan Surat Pengesahan (SP)'), __('Detail Pengajuan')]"
        ></x-breadcrumb>

        <x-letter-card :submission="$submission">
            <div class="mt-2">
                <div class="row justify-content-between">
                    <div class="col-md-6 pe-5">
                        <div class="divider">
                            <div class="divider-text fs-6 text-secondary">{{ __('Detail Pengajuan') }}</div>
                        </div>
                        <dl class="row mt-3">
                            <dt class="col-sm-8 fs-5">{{ __('ID Pengajuan') }}</dt>
                            <dd class="col-sm-4 fs-5 text-end">{{ $submission->id }}</dd>

                            <dt class="col-sm-8 fs-5">{{ __('Pengirim (Asal PAC)') }}</dt>
                            <dd class="col-sm-4 fs-5 text-end">
                                @if ($submission->user->pac_id == 28 || $submission->user->pac == '29')
                                    {{ $submission->user->pac->pac }}
                                @else
                                    {{ __('PAC ') . $submission->user->pac->pac }}
                                @endif
                            </dd>

                            <dt class="col-sm-8 fs-5">{{ __('Tanggal Pelaksanaan Konferancab/Rapat Anggota') }}</dt>
                            <dd class="col-sm-4 fs-5 text-end">{{ $submission->formatted_event_date }}</dd>

                            <dt class="col-sm-8 fs-5">{{ __('Tempat Pelaksanaan Konferancab/Rapat Anggota') }}</dt>
                            <dd class="col-sm-4 fs-5 text-end">{{ $submission->event_location }}</dd>
                        </dl>
                    </div>

                    <div class="col-md-6 ps-5">
                        <div class="divider">
                            <div class="divider-text fs-6 text-secondary">{{ __('Lampiran-lampiran') }}</div>
                        </div>

                        <dl class="row mt-3">
                            @foreach ($attachments->documentation as $doc)
                                <dt class="col-sm-9 fs-5 mb-2">
                                    <a
                                        target="_blank"
                                        href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/documentation/' . $doc) }}"
                                        class="text-success text-decoration-none fw-normal"
                                    >
                                        @switch($doc)
                                            @case(str_contains($doc, 'docx'))
                                                <i class="bi bi-file-earmark-text-fill text-primary"></i>

                                                @break
                                            @case(str_contains($doc, 'jpg') || str_contains($doc, 'jpeg') || str_contains($doc, 'png'))
                                                <i class="bi bi-file-earmark-image-fill text-info"></i>

                                                @break
                                            @case(str_contains($doc, 'mp4'))
                                                <i class="bi bi-file-earmark-play-fill text-warning"></i>

                                                @break
                                            @default
                                        @endswitch
                                        {{ __('Dokumentasi Pelaksanaan Konferancab/Rapat Anggota ' . $loop->iteration . '.' . pathinfo($doc, PATHINFO_EXTENSION)) }}
                                    </a>
                                </dt>
                                <dd class="col-sm-3 fs-5 text-end">
                                    <a
                                        href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/documentation/' . $doc) }}"
                                        download
                                        class="btn btn-sm btn-success"
                                    >
                                        <i class="bi bi-download"></i>
                                    </a>
                                </dd>
                            @endforeach

                            <dt class="col-sm-9 fs-5 mb-2">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/request_letter/' . $attachments->request_letter) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                    {{ __('Surat Permohonan Pengesahan Kepada PC IPNU Kab. Banyumas.' . pathinfo($attachments->request_letter, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/request_letter/' . $attachments->request_letter) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-9 fs-5 mb-2">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/mwc_recommendation/' . $attachments->mwc_recommendation) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                    {{ __('Surat Rekomendasi MWC NU/PR NU Setempat.' . pathinfo($attachments->mwc_recommendation, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/mwc_recommendation/' . $attachments->mwc_recommendation) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-9 fs-5 mb-2">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/pac_recommendation/' . $attachments->pac_recommendation) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                    {{ __('Surat Rekomendasi PAC Setempat.' . pathinfo($attachments->pac_recommendation, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/pac_recommendation/' . $attachments->pac_recommendation) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-9 fs-5 mb-2">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/election_report/' . $attachments->election_report) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                    {{ __('Berita Acara Pemilihan Ketua Konferancab/Rapat Anggota.' . pathinfo($attachments->election_report, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/election_report/' . $attachments->election_report) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-9 fs-5">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/formation_report/' . $attachments->formation_report) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                    {{ __('Berita Acara Penyusunan Kepengurusan oleh Tim Formatur.' . pathinfo($attachments->formation_report, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/formation_report/' . $attachments->formation_report) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-9 fs-5">
                                <a
                                    target="_blank"
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/management_structure/' . $attachments->management_structure) }}"
                                    class="text-success text-decoration-none fw-normal"
                                >
                                    <i class="bi bi-file-earmark-text-fill text-primary"></i>
                                    {{ __('Susunan Pengurus Lengkap.' . pathinfo($attachments->management_structure, PATHINFO_EXTENSION)) }}
                                </a>
                            </dt>
                            <dd class="col-sm-3 fs-5 text-end">
                                <a
                                    href="{{ asset('storage/sp/' . strtolower($submission->user->pac->pac) . '/management_structure/' . $attachments->management_structure) }}"
                                    download
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="bi bi-download"></i>
                                </a>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-text fs-6 text-secondary">{{ __('Susunan Pengurus') }}</div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-md-6 pe-5">
                        <dl class="row mt-3">
                            <div class="col-md-6 pe-5">
                                <dt class="fs-5 mb-1">{{ __('Pelindung') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    @foreach ($submission->protectors as $protector)
                                        <div>
                                            {{ $loop->iteration . '. ' . $protector }}
                                        </div>
                                    @endforeach
                                </dd>

                                <dt class="fs-5 mb-1">{{ __('Pembina') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    @foreach ($submission->advisors as $advisor)
                                        <div>
                                            {{ $loop->iteration . '. ' . $advisor }}
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                            <div class="col-md-6 pe-5">
                                <dt class="fs-5 mb-1">{{ __('Pengurus Harian') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>
                                                    {{ __('Ketua') }}
                                                </strong>
                                            </div>

                                            @foreach ($submission->vice_chairmen as $vice_chairman)
                                                <div>
                                                    {{ __('Wakil Ketua ') . $loop->iteration }}
                                                </div>
                                            @endforeach

                                            <div class="mb-0 mt-2">
                                                <strong>
                                                    {{ __('Sekretaris') }}
                                                </strong>
                                            </div>

                                            @foreach ($submission->vice_secretaries as $vice_secretary)
                                                <div>
                                                    {{ __('Wakil Sekretaris ') . $loop->iteration }}
                                                </div>
                                            @endforeach

                                            <div class="mb-0 mt-2">
                                                <strong>
                                                    {{ __('Bendahara') }}
                                                </strong>
                                            </div>

                                            @foreach ($submission->vice_treasurers as $vice_treasurer)
                                                <div>
                                                    {{ __('Wakil Bendahara ') . $loop->iteration }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-0 text-end">{{ $submission->chairman }}</div>
                                            @foreach ($submission->vice_chairmen as $vice_chairman)
                                                <div>
                                                    <div class="mb-0 text-end">{{ $vice_chairman }}</div>
                                                </div>
                                            @endforeach

                                            <div class="mb-0 mt-2 text-end">{{ $submission->secretary }}</div>

                                            @foreach ($submission->vice_secretaries as $vice_secretary)
                                                <div class="text-end">
                                                    {{ $vice_secretary }}
                                                </div>
                                            @endforeach

                                            <div class="mb-0 mt-2 text-end">{{ $submission->treasurer }}</div>

                                            @foreach ($submission->vice_treasurers as $vice_treasurer)
                                                <div class="text-end">
                                                    {{ $vice_treasurer }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="col-md-6 ps-5">
                        <dl class="row mt-3">
                            <div class="col-md-6 pe-5">
                                <dt class="fs-5 mb-1">{{ __('Departemen Organisasi') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __('Koordinator') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->organization_department_coordinator }}
                                            </div>
                                            @foreach ($submission->organization_department_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>

                                <dt class="fs-5 mb-1 mt-5">{{ __('Departemen Dakwah') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __('Koordinator') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->dakwah_department_coordinator }}
                                            </div>
                                            @foreach ($submission->dakwah_department_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>

                                <dt class="fs-5 mb-1 mt-5">{{ __('Lembaga Ekonomi & Kewirausahaan') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __('Direktur') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->economy_institution_director }}
                                            </div>
                                            @foreach ($submission->economy_institution_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>

                                <dt class="fs-5 mb-1 mt-5">{{ __('Lembaga Corps Brigade Pembangunan') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __('Direktur') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->brigade_institution_director }}
                                            </div>
                                            @foreach ($submission->brigade_institution_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>
                            </div>
                            <div class="col-md-6 pe-5">
                                <dt class="fs-5 mb-1">{{ __('Departemen Kaderisasi') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __(' Koordinator') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->cadre_department_coordinator }}
                                            </div>
                                            @foreach ($submission->cadre_department_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>

                                <dt class="fs-5 mb-1 mt-5">{{ __('Departemen Seni, Olahraga, & Budaya') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __(' Koordinator') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->culture_department_coordinator }}
                                            </div>
                                            @foreach ($submission->culture_department_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>

                                <dt class="fs-5 mb-1 mt-5">{{ __('Lembaga Pers dan Penerbitan') }}</dt>
                                <hr class="m-0" />
                                <dd class="fs-5 mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <strong>{{ __('Direktur') }}</strong>
                                            </div>
                                            <div>{{ __(' Anggota') }}</div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="fs-5 mb-0 text-end">
                                                {{ $submission->press_institution_director }}
                                            </div>
                                            @foreach ($submission->press_institution_members as $member)
                                                <div class="text-end">
                                                    {{ $member }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </x-letter-card>
    @endsection
@endsection
