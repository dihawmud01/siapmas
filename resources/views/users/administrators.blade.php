@section('title')
    {{ __('Pengurus') }}
@endsection

@extends('users.layout')
@section('content')
    <div class="text-center">
        <h4 class="pt-5"></h4>
    </div>
    <div class="container my-4">
        <div class="row">
            <section id="portfolio">
                <div class="container" data-aos="fade-up">
                    <header class="section-header" style="padding: 5rem">
                        <h3 style="text-transform: none">
                            {{ __('PENGURUS') }}
                            <br />
                            {{ __('PC IPNU IPPNU BANYUMAS') }}
                            <br />
                            {{ __('Masa Khidmat 2024/2026') }}
                        </h3>
                        <h2>{{ __('P.A.S.T.I') }}</h2>
                    </header>
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($administrators as $administrator)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-wrap">
                                    <figure>
                                        <img
                                            src="{{ asset('storage/images/' . $administrator->img) }}"
                                            class="img-fluid"
                                            alt="{{ $administrator->name }}"
                                            style="
                                                width: 120%;
                                                height: 120%;
                                                object-fit: cover;
                                                box-shadow: 0 0 5px 0 rgba(0, 0, 5, 10);
                                            "
                                        />
                                        <a
                                            href="{{ asset('storage/images/' . $administrator->img) }}"
                                            data-lightbox="portfolio"
                                            data-title="{{ $administrator->name }}"
                                            class="link-preview"
                                        >
                                            <i class="bi bi-plus"></i>
                                        </a>
                                        <a
                                            href="{{ $administrator->ig }}"
                                            class="link-details"
                                            title="{{ __('Selengkapnya') }}"
                                        >
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                    </figure>
                                    <div class="portfolio-info">
                                        <h4>{{ $administrator->name }}</h4>
                                        <p>{{ $administrator->position }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
