<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ __('Generate QR Code') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body>
        <div class="container mt-4">
            <div class="card text-center align-middle">
                <img
                    src="{{ asset('storage/images/' . $users->img) }}"
                    alt="{{ __('User Image') }}"
                    style="width: 100%; height: 40rem; object-fit: cover"
                />
                <h1>
                    {{ __('Benar Bahwasannya sahabat') }} {{ $users->name }} {{ __('dengan NIM/NIK') }} :
                    {{ $users->nim }} {{ __('Adalah Kader PC IPNU IPPNU Banyumas') }}
                </h1>
            </div>
        </div>
    </body>
</html>
