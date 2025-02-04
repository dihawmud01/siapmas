<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ __('Database') }} | PAC</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        />
        <style>
            table tr td,
            table tr th {
                font-size: 9pt;
            }

            @media print {
                body {
                    width: 594mm;
                    height: 420mm;
                }
            }
        </style>
    </head>

    <body>
        <center>
            <h3>{{ __('Database PAC') }} {{ $pac->pac }}</h3>
        </center>

        <div class="container my-4">
            <div>
                <h5 class="text-primary">{{ __('Total Members') }}: {{ $userCounts }}</h5>
                <h6 class="text-primary">{{ __('Printed on') }}: {{ $now }}</h6>
            </div>

            <table class="table-bordered table-striped mt-3 table">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('No.') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('NIK/NIM') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Tempat, Tanggal Lahir') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Sekolah Menengah') }}</th>
                        <th>{{ __('Tahun Lulus') }}</th>
                        <th>{{ __('Tahun Masuk Perguruan Tinggi') }}</th>
                        <th>{{ __('Jurusan') }}</th>
                        <th>{{ __('Makesta') }}</th>
                        <th>{{ __('Tingkat Kader') }}</th>
                        <th>{{ __('Kontak') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pac->users as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->place_of_birth }}, {{ $item->date_of_birth }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->highschool }}</td>
                            <td>{{ $item->grad_year }}</td>
                            <td>{{ $item->college }}</td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->makesta_year }}</td>
                            <td>{{ $item->cadre_level }}</td>
                            <td>{{ $item->wa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            window.onload = () => {
                document.body.style.width = '594mm';
                document.body.style.height = '420mm';
                window.print();
            };
        </script>
    </body>
</html>
