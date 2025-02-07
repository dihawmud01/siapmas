@extends('users.layout')

@section('title')
    {{ __('Kategori') }}
@endsection

@section('content')
    <div class="container-fluid my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title mb-4 rounded">
                        <h4 class="text-uppercase font-weight-bold m-0">
                            {{ __('Berita berdasarkan kategori') }}: "{{ $category->title }}"
                        </h4>
                    </div>

                    <div class="row g-3">
                        @foreach ($news as $post)
                            <div class="col-md-6">
                                <div class="card h-100 radius border">
                                    <div class="d-flex">
                                        @if ($post->img)
                                            <img
                                                src="{{ asset('storage/images/' . $post->img) }}"
                                                alt="{{ $post->title }}"
                                                class="img-fluid rounded-start h-100"
                                                style="width: 150px; object-fit: cover"
                                            />
                                        @endif

                                        <div class="d-flex flex-column justify-content-between w-100 p-3">
                                            <a
                                                href="{{ route('categories', $post->category->slug) }}"
                                                class="badge badge-primary text-uppercase font-weight-semi-bold rounded-1 mb-1 p-2 text-white"
                                                style="width: fit-content"
                                            >
                                                {{ $post->category->title }}
                                            </a>

                                            <a
                                                href="{{ route('news', ['slug' => $post->slug]) }}"
                                                class="h6 text-dark fw-bold w-100 mb-1"
                                            >
                                                {{ __(Str::limit($post->title, 60)) }}
                                            </a>

                                            <small class="text-muted">
                                                {{ $post->formatted_date }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @include('users.partials._sidebar')
            </div>
        </div>
    </div>
@endsection
