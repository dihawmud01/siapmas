<div class="card mb-4 p-4">
    <div class="card-header mb-2 bg-transparent pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="fw-bold mb-1 text-nowrap">{{ __('ID Pengajuan ') . $letter->id }}</h5>
                <small class="text-black">
                    <span class="text-secondary">{{ __('Diajukan oleh:') }}</span>
                    @if ($letter->user->pac_id == 28 || $letter->user->pac_id == 29)
                        {{ $letter->user->pac->pac }}
                    @else
                        {{ __('PAC ') . $letter->user->pac->pac }}
                    @endif
                </small>
            </div>

            <div class="card-title d-flex align-items-center flex-row">
                <div class="d-inline-block mx-2 mb-1 text-end text-black">
                    <small class="d-block text-secondary mb-1">{{ __('Tanggal Pengajuan') }}</small>
                    {{ $letter->formatted_letter_submission_date }}
                </div>
                <div class="ms-3">
                    @if (in_array(auth()->user()->role_id, [3]))
                        <div class="d-flex align-items-center">
                            <a
                                href="{{ $letter->status->value == 'approved' ? route('dashboard.letters.validation-submission.generate', $letter) : '' }}"
                                class="{{ $letter->status->value == 'approved' ? '' : 'disabled-link' }}"
                                target="_blank"
                            >
                                <button
                                    class="btn btn-success btn-lg"
                                    {{ $letter->status->value == 'approved' ? '' : 'disabled' }}
                                >
                                    <i class="bi bi-download"></i>
                                    {{ __('Generate SP') }}
                                </button>
                            </a>
                            @if (request()->routeIs('dashboard.letters.validation-submission.index'))
                                <div class="dropdown-center">
                                    <button
                                        class="btn btn-secondary btn-lg dropdown-toggle border-0 bg-transparent pe-0"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <i class="bi bi-three-dots-vertical text-secondary"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ route('dashboard.letters.validation-submission.show', $letter) }}"
                                            >
                                                <i class="bi bi-eye-fill"></i>
                                                {{ __('Lihat Detail') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @else
                        @if (request()->routeIs('dashboard.letters.validation-submission.index'))
                            <a
                                href="{{ route('dashboard.letters.validation-submission.show', $letter) }}"
                                class="btn btn-success btn-lg"
                            >
                                <i class="bi bi-search"></i>
                                {{ __('Review') }}
                            </a>
                        @else
                            <form
                                method="POST"
                                action="{{ route('dashboard.letters.validation-submission.update', $letter) }}"
                                id="approvalForm"
                            >
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="letter_number" id="letterNumber" />

                                <button
                                    class="btn btn-success btn-lg"
                                    type="button"
                                    id="approveBtn"
                                    {{ $letter->status->value == 'approved' ? 'disabled' : '' }}
                                >
                                    <i class="bi bi-check"></i>
                                    {{ __('Setujui') }}
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-5 mb-3">
                <strong>{{ __('Status: ') }}</strong>

                @if ($letter->status->value == 'pending')
                    <span class="badge bg-warning text-dark fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @elseif ($letter->status->value == 'approved')
                    <span class="badge bg-success text-light fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @elseif ($letter->status->value == 'rejected')
                    <span class="badge bg-danger text-light fs-6 fw-normal ms-2 p-2">
                        {{ $letter->status->label() }}
                    </span>
                @endif
            </p>
        </div>

        @if (in_array(auth()->user()->role_id, [3]))
            <p class="fs-5">
                <strong>{{ __('Keterangan: ') }}</strong>
                @if ($letter->status->value == 'pending')
                    {{ __('Belum dapat melakukan generate SP karena belum disetujui oleh PC') }}
                @elseif ($letter->status->value == 'approved')
                    {{ __('Pengajuan SP sudah disetujui oleh PC. SP sudah dapat digenerate') }}
                @elseif ($letter->status->value == 'rejected')
                    {{ __('Mohon maaf pengajuan SP anda ditolak oleh PC') }}
                @endif
            </p>
        @endif

        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <small class="text-secondary">
                {{ __('Disetujui pada: ') }}
                {{ $letter->status->value == 'pending' || $letter->status->value == 'rejected' ? '-' : $letter->formatted_approved_date }}
            </small>
        </div>

        {{ $slot }}
    </div>
</div>
