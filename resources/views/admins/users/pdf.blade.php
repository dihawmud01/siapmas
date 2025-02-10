<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ __('KTA | PC IPNU IPPNU Banyumas') }}</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="{{ asset('css/kta.css') }}" />
    </head>

    <body>
        <div class="container">
            <div class="header">
                <div class="tgl">
                    <p>
                        {{ __('Dicetak:') }}
                        <br />
                        {{ $now }}
                    </p>
                </div>
                <div class="title">
                    <h2>{{ __('PELAJAR NU BANYUMAS') }}</h2>
                    <h4>{{ __('Kartu Tanda Anggota') }}</h4>
                </div>
                <div class="logo">
                    <img src="{{ asset('images/logokomi.png') }}" alt="logo" />
                </div>
            </div>

            <div>
                <hr />
            </div>

            <div class="profile">
                <div class="gambar">
                    <img src="{{ asset('storage/images/' . $users->img) }}" alt="" />
                </div>

                <div class="bio">
                    <table>
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Nama') }}</th>
                                <td>{{ $users->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('NIM') }}</th>
                                <td>{{ $users->nim }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Tempat, Tanggal Lahir') }}</th>
                                <td>{{ $users->place_of_birth }}, {{ $users->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('PAC') }}</th>
                                <td>{{ $users->pac->pac }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Kaderisasi') }}</th>
                                <td>{{ $users->cadre_level }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="qr">
                    {!! QrCode::size(100)->generate("https://pmiiuninus.com/qrcode/varifikasi/kta/{$users->id}/anjay/mabar/ckuahsksdfsihew/S3NAT-4NJ1NG-63lut-73ng/51-3nd1") !!}
                </div>
            </div>

            <div>
                <hr />
            </div>
            <div class="footer">
                <p>
                    {{ __('Kartu ini adalah tanda bahwa kader tersebut adalah benar kader PC IPNU IPPNU Banyumas') }}
                </p>
            </div>
        </div>

        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>
