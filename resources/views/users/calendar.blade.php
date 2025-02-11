@section('title')
    {{ __('Agenda') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="my-5 pt-3 text-center" data-aos="fade-up">
        <h1 class="pt-5">{{ __('Kalender Kegiatan') }}</h1>
    </div>

    <div class="container my-1">
        <div class="row">
            <div class="content mb-4 py-1 pb-2" data-aos="fade-up">
                <div id="calendar"></div>
            </div>

            <div class="my-5 pt-3 text-center" data-aos="fade-up">
                <h1 class="pt-5">{{ __('Agenda Kegiatan') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div
                    class="card info-card sales-card rounded-2 border-0 p-5"
                    style="box-shadow: 0 0 30px rgba(1, 41, 112, 0.1)"
                >
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
                <h1 class="pt-5">{{ __('Hari Besar Nasional') }}</h1>
            </div>
            <div class="container mb-4 pb-4 pt-2" data-aos="fade-up">
                <div
                    class="card info-card sales-card rounded-2 border-0 p-5"
                    style="box-shadow: 0 0 30px rgba(1, 41, 112, 0.1)"
                >
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
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Agenda Kegiatan') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">{{ __('Nama Kegiatan') }}</label>
                                        <input type="text" class="form-control" name="title" id="title" readonly />
                                    </div>

                                    <div class="mb-3">
                                        <label for="organizer" class="form-label">
                                            {{ __('Penyelenggara Kegiatan') }}
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="organizer"
                                            id="organizer"
                                            readonly
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <label for="place" class="form-label">{{ __('Tempat') }}</label>
                                        <input type="text" class="form-control" name="place" id="place" readonly />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">{{ __('Kategori') }}</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="category"
                                            id="category"
                                            readonly
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_participants" class="form-label">
                                            {{ __('Jumlah Peserta') }}
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="total_participants"
                                            id="totalParticipants"
                                            readonly
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <label for="target" class="form-label">{{ __('Target Capaian') }}</label>
                                        <input type="text" class="form-control" name="target" id="target" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="evaluation" class="form-label">{{ __('Evaluasi Kegiatan') }}</label>
                                <input type="text" class="form-control" name="evaluation" id="evaluation" readonly />
                            </div>

                            <div class="mb-3 text-center">
                                <input type="text" name="status" class="btn" id="status" readonly />
                            </div>
                        </div>

                        <div class="card" style="width: 100%">
                            <img id="pamphlet" src="" alt="Gambar Pamflet" />
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Tutup') }}
                            </button>
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
                            countdownDiv.innerHTML = '<p>' + countdownText + '</p>';
                        } else {
                            countdownDiv.innerHTML = '<p>{{ __('Tanggal telah berlalu') }}</p>';
                        }

                        setTimeout(countdownTimer{{ $loop->iteration }}, 1000);
                    }

                    countdownTimer{{ $loop->iteration }}();
                </script>
            @endforeach
        </div>
    </div>
@endsection

<script src="{{ asset('assets/vendor/calendar/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/vendor/calendar/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/calendar/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/vendor/fullcalendar/packages/core/main.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/packages/interaction/main.js') }}"></script>
<script src="{{ asset('assets/vendor/fullcalendar/packages/daygrid/main.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid'],
            editable: true,
            eventLimit: true,
            events: {!! json_encode($events) !!},
            eventClick: function (info) {
                $('#staticBackdrop').modal('show');

                $('#staticBackdropLabel').text(info.event.title);
                $('#title').val(info.event.title);
                $('#organizer').val(info.event.extendedProps.organizer);
                $('#place').val(info.event.extendedProps.place);
                $('#start').val(info.event.start);
                $('#categories').val(info.event.extendedProps.description);
                $('#totalParticipants').val(info.event.extendedProps.totalParticipants);
                $('#target').val(info.event.extendedProps.target);
                $('#evaluation').val(info.event.extendedProps.evaluation);

                if (info.event.extendedProps.status === 0) {
                    $('#status').val('{{ __('Belum Terlaksana') }}').removeClass().addClass('btn btn-danger');
                } else if (info.event.extendedProps.status === 1) {
                    $('#status').val('{{ __('Terlaksana') }}').removeClass().addClass('btn btn-success');
                }

                // Show image
                $('#pamphlet').attr('src', '/storage/images/' + info.event.extendedProps.pamphlet);
            },
        });
        calendar.render();
    });
</script>

<script src="{{ asset('assets/vendor/calendar/js/main.js') }}"></script>
