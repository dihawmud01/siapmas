@section('title')
    {{ __('News') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row pt-4">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">
                    @foreach ($recentNews->take(3) as $news)
                        <div class="position-relative overflow-hidden" style="height: 682px">
                            @if ($news->img)
                                <img
                                    class="img-fluid h-100"
                                    src="{{ asset('storage/images/' . $news->img) }}"
                                    style="object-fit: cover"
                                    alt="{{ $news->title }}"
                                />
                            @endif

                            <div class="overlay">
                                <div class="mb-2 overflow-hidden">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-2"
                                        href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    >
                                        {{ $news->category->title }}
                                    </a>
                                    <h8 style="color: #fff">
                                        {{ $news->created_at->diffForHumans() }}
                                    </h8>
                                </div>
                                <a
                                    class="h3 font-weight-bold text-decoration-none m-0 text-white"
                                    href="{{ route('articles.index', ['slug' => $news->slug]) }}"
                                >
                                    {{ $news->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 px-0">
                <div class="row mx-0">
                    @foreach ($trending->take(4) as $news)
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 341px">
                                @if ($news->img)
                                    <img
                                        class="img-fluid w-100 h-100"
                                        src="{{ asset('storage/images/' . $news->img) }}"
                                        style="object-fit: cover"
                                        alt="{{ $news->title }}"
                                    />
                                @endif

                                <div class="overlay">
                                    <div class="mb-2">
                                        <a
                                            class="badge badge-warning text-uppercase font-weight-semi-bold mb-2 mr-2 p-2"
                                            href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                        >
                                            {{ $news->category->title }}
                                        </a>
                                        <h9 style="color: #fff">
                                            {{ $news->created_at->diffForHumans() }}
                                        </h9>
                                    </div>
                                    <a
                                        class="h6 font-weight-semi-bold m-0 text-white"
                                        href="{{ route('articles.index', ['slug' => $news->slug]) }}"
                                    >
                                        {{ Str::limit($news->title, 50) }}
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
        <div class="container my-3">
            <div class="row align-items-center bg-dark">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div
                            class="bg-danger text-light font-weight-medium rounded py-2 text-center"
                            style="width: 170px"
                        >
                            {{ __('BERITA TERKINI!') }}
                        </div>
                        <div
                            class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 200px); padding-right: 100px"
                        >
                            @foreach ($recentNews->take(2) as $news)
                                <div class="text-truncate">
                                    <a
                                        class="font-weight-semi-bold text-white"
                                        href="{{ route('articles.index', ['slug' => $news->slug]) }}"
                                    >
                                        {{ Str::limit($news->title, 50) }}
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
            <div class="section-title rounded">
                <h4 class="font-weight-bold m-0">{{ __('Berita Unggulan') }}</h4>
            </div>
            <div class="container p-0">
                <div class="owl-carousel news-carousel carousel-item-4 position-relative">
                    @foreach ($oldNews->take(7) as $news)
                        <div class="position-relative overflow-hidden rounded" style="height: 300px">
                            @if ($news->img)
                                <img
                                    class="img-fluid h-100"
                                    src="{{ asset('storage/images/' . $news->img) }}"
                                    style="object-fit: cover"
                                    alt="{{ $news->category->title }}"
                                />
                            @endif

                            <div class="overlay">
                                <div class="mb-2">
                                    <a
                                        class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-2"
                                        href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    >
                                        {{ $news->category->title }}
                                    </a>
                                </div>
                                <a
                                    class="h6 font-weight-semi-bold m-0 text-white"
                                    href="{{ route('articles.index', ['slug' => $news->slug]) }}"
                                >
                                    {{ Str::limit($news->title, 50) }}
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
                                <div class="section-title rounded">
                                    <h4 class="font-weight-bold m-0">{{ __('Berita Terbaru') }}</h4>
                                    <a class="text-secondary font-weight-medium text-decoration-none" href="">
                                        {{ __('Lihat Semua') }}
                                    </a>
                                </div>
                            </div>

                            @foreach ($recentNews as $news)
                                <div class="col-lg-6">
                                    <div
                                        class="d-flex align-items-center rounded-3 mb-3 bg-white"
                                        style="height: 120px"
                                    >
                                        @if ($news->img)
                                            <img
                                                class="img-fluid rounded-start-1 h-100"
                                                src="{{ asset('storage/images/' . $news->img) }}"
                                                alt="{{ $news->title }}"
                                                style="width: 150px; overflow: hidden; object-fit: cover"
                                            />
                                        @endif

                                        <div
                                            class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 rounded-end-1 border px-3"
                                        >
                                            <div class="mb-0">
                                                <a
                                                    class="badge badge-primary text-uppercase font-weight-semi-bold mb-1 mr-2 p-2"
                                                    href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                                >
                                                    {{ $news->category->title }}
                                                </a>
                                            </div>
                                            <div class="mb-2">
                                                <a
                                                    class="h6 text-secondary font-weight-bold m-0"
                                                    href="{{ route('articles.index', ['slug' => $news->slug]) }}"
                                                >
                                                    {{ Str::limit($news->title, 30) }}
                                                </a>
                                            </div>
                                            <h8 class="text-secondary">
                                                <small>
                                                    {{ $news->created_at->diffForHumans() }}
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
                        <div class="section-title rounded">
                            <h4 class="font-weight-bold m-0">{{ __('Nu Online') }}</h4>
                            <a
                                class="text-secondary font-weight-medium text-decoration-none"
                                href="https://www.nu.or.id/indeks"
                            >
                                {{ __('Lihat Semua') }}
                            </a>
                        </div>
                    </div>

                    @foreach ($data['users'] as $nuOnline)
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center rounded-3 mb-3 bg-white" style="height: 140px">
                                @if (isset($nuOnline['images']['thumbnail']))
                                    <img
                                        class="img-fluid"
                                        src="{{ $nuOnline['images']['thumbnail'] }}"
                                        alt=""
                                        style="height: 100px; width: 150px; overflow: hidden; object-fit: cover"
                                    />
                                @endif

                                <div
                                    class="w-100 h-100 d-flex flex-column justify-content-center border-left-0 rounded border px-3"
                                >
                                    <div class="mb-2">
                                        <a
                                            class="badge badge-primary text-uppercase font-weight-semi-bold mr-2 p-2"
                                            href="{{ route('articles.nu', ['slug' => $nuOnline['slug']]) }}"
                                        >
                                            {{ $nuOnline['category']['name'] }}
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a
                                            class="h6 text-secondary font-weight-bold m-0"
                                            href="{{ route('articles.nu', ['slug' => $nuOnline['slug']]) }}"
                                        >
                                            {{ Str::limit($nuOnline['title'], 40) }}
                                        </a>
                                    </div>
                                    <p class="text-secondary"><small>{{ $nuOnline['date']['published'] }}</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
