@section('title')
    {{  }}
@endsection

@extends('admins.layout')

@section('content')
    <div class="card info-card sales-card">
        <div class="container">
            <h2 class="my-2 text-center">
                {{ __('Data Anggota') }}
                <br />
                {{ __('PAC') }}

                @foreach ($pacList as $pac)
                    @foreach ($pac->users->take(1) as $item)
                        {{ $item->pac->pac }}
                    @endforeach
                @endforeach
            </h2>

            @foreach ($pacList as $pac)
                <h5>{{ __('Total Anggota PAC') }} {{ $pac->pac }}: {{ $pac->users->count() }}</h5>
            @endforeach

            <div class="col-12 col-sm-8 col-md-6 my-3">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="{{ __('Search...') }}" />
                        <button class="btn btn-primary">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>

            {{-- <div class="text-end"> --}}
            {{-- <a href="{{ route('pac-pdf', ['slug' => $pac->slug]) }}" class="btn btn-warning m-3"> --}}
            {{-- <i class="bi bi-printer"></i> --}}
            {{-- {{ __('Unduh Data') }} --}}
            {{-- </a> --}}
            {{-- </div> --}}

            <div class="row">
                <table class="table" id="table">
                    <tr>
                        <td class="text-center">{{ __('No.') }}</td>
                        <td class="text-center">{{ __('Nama') }}</td>
                        <td class="text-center">{{ __('Kaderisasi') }}</td>
                        <td class="text-center">{{ __('Aksi') }}</td>
                    </tr>

                    @foreach ($pacList as $pac)
                        @foreach ($pac->users as $item)
                            <tr data-row>
                                <td class="text-center"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->cadre_level }}</td>
                                <td class="text-center">
                                    <form action="">
                                        <a
                                            href="{{ route('dashboard.members.show', $item) }}"
                                            class="btn btn-success btn-sm"
                                        >
                                            {{ __('Detail') }}
                                        </a>
                                        {{-- <a --}}
                                        {{-- href="{{ route('profile.user', ['slug' => $item->slug]) }}" --}}
                                        {{-- class="btn btn-secondary btn-sm" --}}
                                        {{-- > --}}
                                        {{-- {{ __('Profil') }} --}}
                                        {{-- </a> --}}
                                        <a
                                            href="{{ route('dashboard.members.edit', $item) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            {{ __('Edit') }}
                                        </a>
                                    </form>
                                </td>
                                <td class="text-start"></td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>

                {{ $pacList->links() }}
            </div>
        </div>
    </div>
@endsection
