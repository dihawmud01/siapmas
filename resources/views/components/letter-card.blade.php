<div class="card mb-4 p-4">
    <div class="card-header mb-2 bg-transparent pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="fw-bold mb-1 text-nowrap">{{ __('ID Pengajuan ') . $submission->id }}</h5>
                <small class="text-black">
                    <span class="text-secondary">{{ __('Diajukan oleh:') }}</span>
                    @if ($submission->user->pac_id == 28 || $submission->user->pac_id == 29)
                        {{ $submission->user->pac->pac }}
                    @else
                        {{ __('PAC ') . $submission->user->pac->pac }}
                    @endif
                </small>
            </div>

            <div class="card-title d-flex align-items-center flex-row">
                <div class="d-inline-block mx-2 mb-1 text-end text-black">
                    <small class="d-block text-secondary mb-1">{{ __('Tanggal Pengajuan') }}</small>
                    {{ $submission->formatted_submission_date }}
                </div>
                <div class="ms-3">
                    @if (in_array(auth()->user()->role_id, [3]))
                        <div class="d-flex align-items-center">
                            <button href="" class="btn btn-success btn-lg" disabled>
                                <i class="bi bi-download"></i>
                                {{ __('Generate SP') }}
                            </button>
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
                                                href="{{ route('dashboard.letters.validation-submission.show', $submission) }}"
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
                                href="{{ route('dashboard.letters.validation-submission.show', $submission) }}"
                                class="btn btn-success btn-lg"
                            >
                                <i class="bi bi-search"></i>
                                {{ __('Review') }}
                            </a>
                        @else
                            <form method="POST" action="">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success btn-lg" type="submit">
                                    <i class="bi bi-check"></i>
                                    {{ __('Setujui') }}
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <div class="dropdown d-inline-block">
                    <button
                        class="btn p-0"
                        type="button"
                        id="dropdown-{{ $submission->id }}"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>

                    <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="dropdown-{{ $submission->type }}-{{ $submission->id }}"
                    >
                        <a class="dropdown-item" href="">
                            {{ __('menu.general.view') }}
                        </a>

                        <a class="dropdown-item" href="">
                            {{ __('menu.general.edit') }}
                        </a>

                        <form action="" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <span class="dropdown-item btn-delete cursor-pointer">
                                {{ __('menu.general.delete') }}
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-5 mb-3">
                <strong>{{ __('Status: ') }}</strong>

                @if ($submission->status->value == 'pending')
                    <span class="badge bg-warning text-dark fs-6 ms-2 p-2">{{ $submission->status->label() }}</span>
                @elseif ($submission->status == 'approved')
                    <span class="badge bg-success">{{ $submission->status->label() }}</span>
                @elseif ($submission->status == 'rejected')
                    <span class="badge bg-danger">{{ $submission->status->label() }}</span>
                @endif
            </p>

            @if ($submission->status == 'pending')
                <div>
                    <form action="{{ route('letters.approve', $submission->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bx bx-check"></i>
                            Setujui
                        </button>
                    </form>

                    <form action="{{ route('letters.reject', $submission->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bx bx-x"></i>
                            Tolak
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <p class="fs-5">
            <strong>{{ __('Keterangan: ') }}</strong>
            {{ __('Belum dapat melakukan generate SP karena belum disetujui oleh PC') }}
        </p>

        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <small class="text-secondary">{{ __('Disetujui pada: -') }}</small>
        </div>

        {{ $slot }}
    </div>
</div>
