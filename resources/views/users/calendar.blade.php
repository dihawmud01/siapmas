@section('title')
    {{ __('Agenda') }}
@endsection

@extends('users.layout')

@push('style')
    @vite('resources/css/calendar.css')
@endpush

@push('script')
    @vite('resources/js/fullcalendar.js')
@endpush

@section('content')
    <div class="my-5 pt-3 text-center" data-aos="fade-up">
        <h1 class="fw-semibold pt-5">{{ __('Kalender Kegiatan') }}</h1>
    </div>

    <div class="container my-1">
        <div class="row">
            <div class="content mb-4 py-1 pb-2" data-aos="fade-up">
                <div id="calendar"></div>
            </div>

            <div class="my-5 pt-3 text-center" data-aos="fade-up">
                <h1 class="fw-semibold pt-5">{{ __('Agenda Kegiatan') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div class="card info-card sales-card rounded-2 border-0 p-5">
                    <table class="table-hover mb-0 table">
                        <tr class="fs-5">
                            <th class="p-4 text-center">{{ __('No.') }}</th>
                            <th class="p-4 text-start">{{ __('Nama Kegiatan') }}</th>
                            <th class="p-4 text-start">{{ __('Penyelenggara') }}</th>
                            <th class="p-4 text-start">{{ __('Waktu') }}</th>
                        </tr>
                        @foreach ($events->take(20) as $event)
                            <tr>
                                <td class="p-4 text-center">{{ $loop->iteration }}</td>
                                <td class="p-4">{{ $event->title }}</td>
                                <td class="p-4">{{ $event->organizer }}</td>
                                <td class="p-4">{{ $event->formatted_date }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="my-5 pt-3 text-center" data-aos="fade-up">
                <h1 class="fw-semibold pt-5">{{ __('Hari Besar Nasional') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div class="card info-card sales-card rounded-2 border-0 p-5">
                    <table class="table-hover mb-0 table">
                        <tr class="fs-5">
                            <th class="p-4 text-center">{{ __('No.') }}</th>
                            <th class="p-4 text-start">{{ __('Hari Besar') }}</th>
                            <th class="p-4 text-start">{{ __('Tanggal') }}</th>
                            <th class="p-4 text-start">{{ __('Waktu') }}</th>
                        </tr>
                        @foreach ($hbn as $day => $idx)
                            <tr>
                                <td class="p-4 text-center">{{ $loop->iteration }}</td>
                                <td class="p-4">{{ $idx->title }}</td>
                                <td class="p-4">{{ $idx->formatted_date }}</td>
                                <td class="p-4">
                                    <div id="countdown-{{ $loop->iteration }}"></div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div
                class="modal fade"
                id="staticBackdrop"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="staticBackdropLabel">{{ __('Agenda Kegiatan') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">
                            <div class="row text-start">
                                <div class="col-md-4 mb-3">
                                    <img id="pamphlet" src="" alt="{{ __('Pamflet') }}" class="img-fluid rounded" />
                                    <div class="mt-3 text-center">
                                        <p id="status"></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">{{ __('Nama Kegiatan') }}</h5>
                                            <p id="title"></p>
                                            <h5 class="fw-bold">{{ __('Penyelenggara Kegiatan') }}</h5>
                                            <p id="organizer"></p>
                                            <h5 class="fw-bold">{{ __('Hari/tanggal') }}</h5>
                                            <p id="date"></p>
                                            <h5 class="fw-bold">{{ __('Pukul') }}</h5>
                                            <p id="time"></p>
                                            <h5 class="fw-bold">{{ __('Tempat') }}</h5>
                                            <p id="place"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">{{ __('Kategori') }}</h5>
                                            <p id="category"></p>
                                            <h5 class="fw-bold">{{ __('Jumlah Peserta') }}</h5>
                                            <p id="totalParticipants"></p>
                                            <h5 class="fw-bold">{{ __('Target Capaian') }}</h5>
                                            <p id="target"></p>
                                            <h5 class="fw-bold">{{ __('Evaluasi Kegiatan') }}</h5>
                                            <p id="evaluation" class="mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($hbn as $day)
                <script>
                    let targetDate{{ $loop->iteration }} = new Date('{{ date('Y-m-d', strtotime($day->date)) }}');

                    function countdownTimer{{ $loop->iteration }}() {
                        let now = new Date();
                        let distance = targetDate{{ $loop->iteration }} - now;

                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));

                        let countdownDiv = document.getElementById('countdown-{{ $loop->iteration }}');
                        countdownDiv.innerHTML = '';

                        if (days > 0) {
                            let countdownText = '{{ __('Tinggal') }} ' + days + ' {{ __('hari lagi') }}';
                            countdownDiv.innerHTML = '<p class="fw-normal">' + countdownText + '</p>';
                        } else {
                            countdownDiv.innerHTML = '<p class="text-secondary">{{ __('Tanggal telah berlalu') }}</p>';
                        }

                        setTimeout(countdownTimer{{ $loop->iteration }}, 1000);
                    }

                    countdownTimer{{ $loop->iteration }}();
                </script>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [window.FullCalendar.interactionPlugin, window.FullCalendar.dayGridPlugin],
                editable: true,
                initialView: 'dayGridMonth',
                displayEventTime: false,
                contentHeight: 'auto',
                headerToolbar: {
                    right: 'today prev,next',
                },
                customButtons: {
                    prev: {
                        text: '',
                        click: function () {
                            calendar.prev();
                        },
                    },
                    next: {
                        text: '',
                        click: function () {
                            calendar.next();
                        },
                    },
                },
                datesSet: function () {
                    document.querySelector('.fc-prev-button').innerHTML = '<i class="bi bi-chevron-left"></i>';
                    document.querySelector('.fc-next-button').innerHTML = '<i class="bi bi-chevron-right"></i>';
                },
                dayMaxEventRows: true,
                dayMaxEvents: true,
                events: {!! json_encode($events) !!},
                eventClick: function (info) {
                    let modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                    modal.show();

                    document.getElementById('title').innerText = info.event.title;
                    document.getElementById('organizer').innerText = info.event.extendedProps.organizer;
                    document.getElementById('place').innerText = info.event.extendedProps.place;
                    document.getElementById('date').innerText = info.event.extendedProps.formatted_date;
                    document.getElementById('time').innerText = `${info.event.extendedProps.time} WIB`;
                    document.getElementById('category').innerText = info.event.extendedProps.category;
                    document.getElementById('totalParticipants').innerText =
                        info.event.extendedProps.total_participants;
                    document.getElementById('target').innerText = info.event.extendedProps.target;
                    document.getElementById('evaluation').innerText = info.event.extendedProps.evaluation;

                    let statusEl = document.getElementById('status');
                    if (info.event.extendedProps.status === 0) {
                        statusEl.innerText = '{{ __('Belum Terlaksana') }}';
                        statusEl.className = 'fw-bold badge bg-danger p-2 text-light';
                    } else if (info.event.extendedProps.status === 1) {
                        statusEl.innerText = '{{ __('Terlaksana') }}';
                        statusEl.className = 'fw-bold badge bg-success p-2 text-light w-100';
                    }

                    pamphletEl = document.getElementById('pamphlet');
                    if (info.event.extendedProps.pamphlet) {
                        pamphletEl.src = '/storage/images/' + info.event.extendedProps.pamphlet;
                    } else {
                        pamphletEl.src = '';
                    }
                },
            });
            calendar.render();
        });
    </script>
@endsection
