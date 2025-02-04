@section('title')
    {{ __('Profil') }}
@endsection

@extends('users.layout')

@section('content')
    <div class="container my-4" style="padding-top: 5rem">
        <header class="pt-3 pb-5 bg-white">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/images/'. $profile->img) }}" alt="{{ __('Gambar Profil') }}"
                         class="rounded-circle mr-4 profile-image-desktop"
                         style="width: 125px; height: 125px; object-fit: cover;">
                    <div class="d-flex flex-column">
                        <h3 class="h4 font-weight-bold">
                            {{ $profile->username }}
                            @if($profile->check == '1')
                                <i class="fas fa-check-circle text-primary"></i>
                            @endif
                        </h3><br>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <a href="{{ route('account') }}" class="btn btn-dark sm"
                               style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ __('Edit Profil') }}</a>
                            @auth
                                @if (in_array(auth()->user()->role_id, [1, 2, 3]))
                                    <a href="{{ route('uploads') }}" class="btn btn-dark sm m-2"
                                       style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ __('Uploads') }}</a>
                                @endif
                            @endauth
                            <a href="{{ route('download.kta', ['id' => $profile->id]) }}" class="btn btn-dark sm"
                               style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">{{ __('KTA') }}</a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="mr-4"><strong>{{ $postCounts }}</strong> {{ __('Postingan') }}</span>
                            <span><strong>{{ $libraryCounts }}</strong> {{ __('Perpustakaan') }}</span>
                        </div>
                        <p class="mt-2">{{ $profile->bio }}</p>
                    </div>
                </div>
            </div>
        </header>
        <br>

        <script>
            $('textarea#summernote').summernote({
                placeholder: '{{ __("Sahabat bisa membuat tulisan disini") }}',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                ],
            });
        </script>
@endsection
