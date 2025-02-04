@section('title')
    {{ __('Kategori') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="container-fluid my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="text-uppercase font-weight-bold m-0">
                                    {{ __('Posting berdasarkan kategory') }} "{{ $category->title }}"
                                </h4>
                            </div>
                        </div>

                        @foreach ($posts as $post)
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center mb-3 bg-white" style="height: 110px">
                                    @if ($post->img)
                                        <img
                                            class="img-fluid"
                                            src="{{ asset('storage/images/' . $post->img) }}"
                                            alt=""
                                            style="height: 100px; width: 150px; overflow: hidden; object-fit: cover"
                                        />
                                    @endif

                                    <div
                                        class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 border px-3"
                                    >
                                        <div class="mb-2">
                                            <a
                                                class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-1"
                                                href="{{ route('categories', $post->category->slug) }}"
                                            >
                                                {{ $post->category->title }}
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            <a
                                                class="h6 text-secondary text-uppercase font-weight-bold m-0"
                                                href="{{ route('posts', ['slug' => $post->slug]) }}"
                                            >
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                        <h8 class="text-secondary">
                                            <small>
                                                {{ $post->created_at }}
                                            </small>
                                        </h8>
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
