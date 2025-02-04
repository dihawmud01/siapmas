@section('title')
    {{ __('Blog') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row pt-4">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($recent_posts->take(3) as $post)
                        <div class="position-relative overflow-hidden" style="height: 682px">
                            @if ($post->img)
                                <img
                                    class="img-fluid h-100"
                                    src="{{ asset('storage/images/' . $post->img) }}"
                                    style="object-fit: cover"
                                    alt="{{ $post->title }}"
                                />
                            @endif

                            <div class="overlay">
                                <div class="mb-0 overflow-hidden">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-2"
                                        href="{{ route('categories', $post->category->slug) }}"
                                    >
                                        {{ $post->category->title }}
                                    </a>
                                    <h8 style="color: #fff">
                                        {{ $post->created_at->diffForHumans() }}
                                    </h8>
                                </div>
                                <a
                                    class="h3 font-weight-bold text-decoration-none m-0 text-white"
                                    href="{{ route('posts', ['slug' => $post->slug]) }}"
                                >
                                    {{ $post->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 px-0">
                <div class="row mx-0">
                    @foreach ($trending->take(4) as $post)
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 341px">
                                @if ($post->img)
                                    <img
                                        class="img-fluid w-100 h-100"
                                        src="{{ asset('storage/images/' . $post->img) }}"
                                        style="object-fit: cover"
                                        alt="{{ $post->title }}"
                                    />
                                @endif

                                <div class="overlay">
                                    <div class="mb-0">
                                        <a
                                            class="badge badge-warning text-uppercase font-weight-semi-bold mr-2 p-2"
                                            href="{{ route('categories', $post->category->slug) }}"
                                        >
                                            {{ $post->category->title }}
                                        </a>
                                        <h9 style="color: #fff">
                                            {{ $post->created_at->diffForHumans() }}
                                        </h9>
                                    </div>
                                    <a
                                        class="h6 font-weight-semi-bold m-0 text-white"
                                        href="{{ route('posts', ['slug' => $post->slug]) }}"
                                    >
                                        {{ Str::limit($post->title, 50) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark mb-3 py-3">
        <div class="container">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-danger text-light font-weight-medium py-2 text-center" style="width: 170px">
                            {{ __('Berita Terkini!!!') }}
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 200px); padding-right: 100px"
                        >
                            @foreach ($recent_posts->take(2) as $post)
                                <div class="text-truncate">
                                    <a
                                        class="font-weight-semi-bold text-white"
                                        href="{{ route('posts', ['slug' => $post->slug]) }}"
                                    >
                                        {{ Str::limit($post->title, 50) }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3 pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="font-weight-bold m-0">{{ __('Berita Unggulan') }}</h4>
            </div>
            <div class="container">
                <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                    @foreach ($old_posts->take(7) as $post)
                        <div class="position-relative overflow-hidden" style="height: 300px">
                            @if ($post->img)
                                <img
                                    class="img-fluid h-100"
                                    src="{{ asset('storage/images/' . $post->img) }}"
                                    style="object-fit: cover"
                                />
                            @endif

                            <div class="overlay">
                                <div class="mb-0">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-2"
                                        href="{{ route('categories', $post->category->slug) }}"
                                    >
                                        {{ $post->category->title }}
                                    </a>
                                </div>
                                <a
                                    class="h6 font-weight-semi-bold m-0 text-white"
                                    href="{{ route('posts', ['slug' => $post->slug]) }}"
                                >
                                    {{ Str::limit($post->title, 50) }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container-fluid my-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
                                    <h4 class="font-weight-bold m-0">{{ __('Berita Terbaru') }}</h4>
                                    <a class="text-secondary font-weight-medium text-decoration-none" href="">
                                        {{ __('View All') }}
                                    </a>
                                </div>
                            </div>

                            @foreach ($recent_posts as $post)
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center mb-3 bg-white" style="height: 110px">
                                        @if ($post->img)
                                            <img
                                                class="img-fluid"
                                                src="{{ asset('storage/images/' . $post->img) }}"
                                                alt="{{ $post->title }}"
                                                style="height: 100px; width: 150px; overflow: hidden; object-fit: cover"
                                            />
                                        @endif

                                        <div
                                            class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 border px-3"
                                        >
                                            <div class="mb-0">
                                                <a
                                                    class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-1"
                                                    href="{{ route('categories', $post->category->slug) }}"
                                                >
                                                    {{ $post->category->title }}
                                                </a>
                                            </div>
                                            <div class="mb-0">
                                                <a
                                                    class="h6 text-secondary font-weight-bold m-0"
                                                    href="{{ route('posts', ['slug' => $post->slug]) }}"
                                                >
                                                    {{ Str::limit($post->title, 30) }}
                                                </a>
                                            </div>
                                            <h8 class="text-secondary">
                                                <small>
                                                    {{ $post->created_at->diffForHumans() }}
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

        <div class="container-fluid my-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="font-weight-bold m-0">{{ __('Nu Online') }}</h4>
                            <a
                                class="text-secondary font-weight-medium text-decoration-none"
                                href="https://www.nu.or.id/indeks"
                            >
                                {{ __('View All') }}
                            </a>
                        </div>
                    </div>

                    @foreach ($data['users'] as $nuonline)
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center mb-3 bg-white" style="height: 110px">
                                @if (isset($nuonline['images']['thumbnail']))
                                    <img
                                        class="img-fluid"
                                        src="{{ $nuonline['images']['thumbnail'] }}"
                                        alt=""
                                        style="height: 100px; width: 150px; overflow: hidden; object-fit: cover"
                                    />
                                @endif

                                <div
                                    class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 border px-3"
                                >
                                    <div class="mb-0">
                                        <a
                                            class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-1"
                                            href="{{ route('nushow', ['slug' => $nuonline['slug']]) }}"
                                        >
                                            {{ $nuonline['categories']['name'] }}
                                        </a>
                                    </div>
                                    <div class="mb-0">
                                        <a
                                            class="h6 text-secondary font-weight-bold m-0"
                                            href="{{ route('nushow', ['slug' => $nuonline['slug']]) }}"
                                        >
                                            {{ Str::limit($nuonline['title'], 40) }}
                                        </a>
                                    </div>
                                    <p class="text-secondary"><small>{{ $nuonline['date']['published'] }}</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
