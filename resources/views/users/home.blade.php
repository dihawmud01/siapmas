@section('title')
    {{ __('Home') }}
@endsection

@extends('users.layout')

@section('content')
    <section id="hero" class="mb-5">
        <div class="hero-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">
                    <div
                        class="carousel-item active"
                        style="background-image: url({{ asset('assets/images/logokomi.png') }})"
                    >
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown mb-2">
                                    {{ __('Selamat Datang') }}
                                    <br />
                                    {{ __('Di Website PC IPNU IPPNU BANYUMAS') }}
                                </h2>
                                <a
                                    href="{{ route('login') }}"
                                    class="btn-get-started scrollto animate__animated animate__fadeInUp rounded-4 fw-semibold p-4"
                                >
                                    {{ __('Mulai Sekarang') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @foreach ($home as $value)
                        <div
                            class="carousel-item"
                            style="background-image: url({{ asset('assets/images/' . $value->img) }})"
                        >
                            <div class="carousel-container">
                                <div class="position-absolute top-50 start-50 translate-middle container">
                                    <h2 class="animate__animated animate__fadeInDown mb-2">{{ $value['title'] }}</h2>
                                    <a
                                        href="{{ route('login') }}"
                                        class="btn-get-started scrollto animate__animated animate__fadeInUp rounded-4 fw-semibold p-4"
                                    >
                                        {{ __('Mulai Sekarang') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="my-5 px-5 pb-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3 class="fw-bold">{{ __('Tentang Kami') }}</h3>
            </header>

            <h6 class="p-4 text-center">
                {{ __('IPNU IPPNU Merupakan Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum quidem voluptas beatae iusto saepe eaque vel doloribus non aliquam, a esse molestiae illo ab exercitationem vero officiis quaerat veniam natus!') }}
            </h6>
        </div>
    </section>

    <section id="facts" class="my-5 p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3 class="fw-bold">{{ __('Data Kader PC IPNU IPPNU Banyumas') }}</h3>
            </header>

            <div class="row counters p-4 text-center">
                <div class="col text-center">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $cadreLevelCounts['Makesta'] }}"
                        data-purecounter-duration="6"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Makesta') }}</p>
                </div>

                <div class="col text-center">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $cadreLevelCounts['Lakmud'] }}"
                        data-purecounter-duration="5"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Lakmud') }}</p>
                </div>

                <div class="col text-center">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $cadreLevelCounts['Lakut'] }}"
                        data-purecounter-duration="4"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Lakut') }}</p>
                </div>

                <div class="col text-center">
                    <span
                        data-purecounter-start="0"
                        data-purecounter-end="{{ $cadreLevelCounts['Latinpel'] }}"
                        data-purecounter-duration="3"
                        class="purecounter"
                    ></span>
                    <p>{{ __('Kader Latinpel') }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card mt-5">
            <div class="card-body pt-5">
                <h4 class="card-title text-center">
                    {{ __('Data Rekan & Rekanita') }}
                    <span>{{ __('Dari Tahun Ke Tahun') }}</span>
                </h4>

                <div id="reportsChart"></div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const makestaCounts = @json($makestaCounts);
                        const lakmudCounts = @json($lakmudCounts);
                        const lakutCounts = @json($lakutCounts);
                        const latinpelCounts = @json($latinpelCounts);

                        const years = [
                            '2016',
                            '2017',
                            '2018',
                            '2019',
                            '2020',
                            '2021',
                            '2022',
                            '2023',
                            '2024',
                            '2025',
                            '2026',
                        ];
                        const makestaData = years.map((year) => makestaCounts[year] || 0);
                        const lakmudData = years.map((year) => lakmudCounts[year] || 0);
                        const lakutData = years.map((year) => lakutCounts[year] || 0);
                        const latinpelData = years.map((year) => latinpelCounts[year] || 0);

                        new ApexCharts(document.querySelector('#reportsChart'), {
                            series: [
                                {
                                    name: '{{ __('Makesta') }}',
                                    data: makestaData,
                                },
                                {
                                    name: '{{ __('Lakmud') }}',
                                    data: lakmudData,
                                },
                                {
                                    name: '{{ __('Lakut') }}',
                                    data: lakutData,
                                },
                                {
                                    name: '{{ __('Latinpel') }}',
                                    data: latinpelData,
                                },
                            ],
                            chart: {
                                height: 350,
                                type: 'area',
                                toolbar: {
                                    show: false,
                                },
                            },
                            markers: {
                                size: 4,
                            },
                            colors: ['#5CB338', '#ECE852', '#FFC145', '#FB4141'],
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100],
                                },
                            },
                            dataLabels: {
                                enabled: false,
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2,
                            },
                            xaxis: {
                                type: 'datetime',
                                categories: years,
                            },
                            tooltip: {
                                x: {
                                    format: 'yyyy',
                                },
                            },
                            legend: {
                                offsetY: 20,
                                height: 52,
                            },
                        }).render();
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card">
            <div class="card-body pt-5">
                <h4 class="card-title text-center">
                    {{ __('Kader Berdasarkan Jenis Kelamin') }}
                </h4>
                <div
                    id="trafficChart"
                    style="min-height: 400px"
                    class="echart d-flex justify-content-center align-items-center mb-5"
                ></div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        echarts.init(document.querySelector('#trafficChart')).setOption({
                            tooltip: {
                                trigger: 'item',
                            },
                            legend: {
                                bottom: '0',
                                left: 'center',
                                orient: 'horizontal',
                            },
                            series: [
                                {
                                    name: '{{ __('Jenis Kelamin') }}',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center',
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold',
                                        },
                                    },
                                    labelLine: {
                                        show: false,
                                    },
                                    data: [
                                        {
                                            value: {{ $genderCounts['P'] }},
                                            name: '{{ __('Kader Perempuan') }}',
                                        },
                                        {
                                            value: {{ $genderCounts['L'] }},
                                            name: '{{ __('Kader Laki-Laki') }}',
                                        },
                                    ],
                                },
                            ],
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card">
            <div class="card-body pt-5">
                <h4 class="card-title text-center">
                    {{ __('Kader Berdasarkan PAC/Komisariat') }}
                </h4>

                <div
                    id="pieChart"
                    style="min-height: 600px"
                    class="echart d-flex justify-content-center align-items-center mb-5"
                ></div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const pacCounts = @json($pacCounts);
                        const pac = [
                            'BATURRADEN',
                            'CILONGOK',
                            'KEDUNGBANTENG',
                            'KARANGLEWAS',
                            'PURWOJATI',
                            'PURWOKERTO BARAT',
                            'PURWOKERTO TIMUR',
                            'PURWOKERTO UTARA',
                            'PURWOKERTO SELATAN',
                            'SUMBANG',
                            'SOKARAJA',
                            'KEMBARAN',
                            'TAMBAK',
                            'SOMAGEDE',
                            'BANYUMAS',
                            'KEMRANJEN',
                            'GUMELAR',
                            'AJIBARANG',
                            'PEKUNCEN',
                            'WANGON',
                            'RAWALO',
                            'JATILAWANG',
                            'KEBASEN',
                            'PATIKRAJA',
                            'KALIBAGOR',
                            'LUMBIR',
                            'SUMPIUH',
                            'KOMISARIAT UNU PURWOKERTO',
                            'KOMISARIAT UIN SAIZU PURWOKERTO',
                        ];

                        const data = Object.keys(pacCounts).map((key) => {
                            const name = pac[parseInt(key) - 1];
                            return {
                                value: pacCounts[key],
                                name,
                            };
                        });

                        echarts.init(document.querySelector('#pieChart')).setOption({
                            title: {
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'item',
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: 0,
                            },
                            series: [
                                {
                                    name: '{{ __('PAC') }}',
                                    type: 'pie',
                                    radius: '50%',
                                    data: data,
                                    emphasis: {
                                        itemStyle: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)',
                                        },
                                    },
                                },
                            ],
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-12 mb-2" data-aos="fade-up"> --}}
    {{-- <div class="card"> --}}
    {{-- <div class="card-body pt-5"> --}}
    {{-- <h5 class="card-title"> --}}
    {{-- {{ __('Kader Berdasarkan') }} --}}
    {{-- <span>{{ __('Status Anggota') }}</span> --}}
    {{-- </h5> --}}
    {{-- <div id="membersChart"></div> --}}
    {{-- <script> --}}
    {{-- document.addEventListener('DOMContentLoaded', () => { --}}
    {{-- new ApexCharts(document.querySelector('#membersChart'), { --}}
    {{-- series: [ --}}
    {{-- { --}}
    {{-- name: '{{ __('Anggota Aktif') }}', --}}
    {{-- data: [{{ $activeMembers }}], --}}
    {{-- }, --}}
    {{-- { --}}
    {{-- name: '{{ __('Anggota Tidak Aktif') }}', --}}
    {{-- data: [{{ $inactiveMembers }}], --}}
    {{-- }, --}}
    {{-- ], --}}
    {{-- chart: { --}}
    {{-- height: 350, --}}
    {{-- type: 'bar', --}}
    {{-- stacked: true, --}}
    {{-- }, --}}
    {{-- plotOptions: { --}}
    {{-- bar: { --}}
    {{-- horizontal: true, --}}
    {{-- columnWidth: '50%', --}}
    {{-- }, --}}
    {{-- }, --}}
    {{-- colors: ['#4db8ff', '#f63d3d'], --}}
    {{-- dataLabels: { --}}
    {{-- enabled: false, --}}
    {{-- }, --}}
    {{-- xaxis: { --}}
    {{-- categories: ['{{ __('Anggota') }}'], --}}
    {{-- }, --}}
    {{-- yaxis: { --}}
    {{-- title: { --}}
    {{-- text: undefined, --}}
    {{-- }, --}}
    {{-- }, --}}
    {{-- tooltip: { --}}
    {{-- shared: true, --}}
    {{-- intersect: false, --}}
    {{-- }, --}}
    {{-- }).render(); --}}
    {{-- }); --}}
    {{-- </script> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <section id="news" class="section-bg p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header pt-5">
                <h3 class="fw-bold">{{ __('Berita Terkini') }}</h3>
            </header>
            <div class="row news-container mt-4 p-4" data-aos="fade-up" data-aos-delay="200">
                @foreach ($recentNews->take(3) as $news)
                    <div class="col-lg-4 col-md-6 news-item filter-app">
                        <div class="news-wrap">
                            <figure>
                                <a href="{{ route('news.show', ['slug' => $news->slug]) }}">
                                    <img
                                        src="{{ asset('storage/images/' . $news->img) }}"
                                        class="img-fluid rounded-1"
                                        alt="{{ $news->title }}"
                                        style="
                                            width: 120%;
                                            height: 400px;
                                            object-fit: cover;
                                            box-shadow: 0 0 30px rgba(1, 41, 112, 0.1);
                                        "
                                    />
                                </a>
                                <a
                                    href="{{ asset('storage/images/' . $news->img) }}"
                                    data-lightbox="news"
                                    data-title="{{ $news->title }}"
                                    class="link-preview"
                                >
                                    <i class="bi bi-plus text-dark"></i>
                                </a>
                                <a
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    class="link-details"
                                    title="More Details"
                                >
                                    <i class="bi bi-link text-dark"></i>
                                </a>
                            </figure>

                            <div class="news-info">
                                <a
                                    href="{{ route('news.show', ['slug' => $news->slug]) }}"
                                    class="text-decoration-none"
                                >
                                    <h4 class="text-dark">{{ Str::limit($news->title, '35') }}</h4>
                                </a>
                                <a
                                    href="{{ route('categories', ['slug' => $news->category->slug]) }}"
                                    class="text-decoration-none"
                                >
                                    <p class="text-success" style="text-transform: none; text-decoration: none">
                                        {{ $news->category->title }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="quote" class="section-bg p-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3 class="fw-bold" style="text-transform: inherit">{{ __('QUOTES OF THE DAY') }}</h3>
            </header>

            <div class="quote-details-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper py-4">
                    @foreach ($quotes as $quote)
                        <div class="swiper-slide d-flex align-items-center justify-content-center">
                            <div class="quote-item d-flex align-items-center flex-column text-center">
                                <img
                                    src="{{ asset('storage/images/' . $quote->img) }}"
                                    class="quote-img rounded-circle mb-3"
                                    alt=""
                                    style="width: 110px; height: 110px; object-fit: cover; border: 4px solid green"
                                />
                                <h3 class="fw-bold">{{ $quote->name }}</h3>
                                <h4>{{ $quote->who }}</h4>
                                <p>
                                    <img
                                        src="{{ asset('assets/images/quote-sign-left.png') }}"
                                        class="quote-sign-left me-2"
                                        alt=""
                                    />
                                    {{ $quote->quote }}
                                    <img
                                        src="{{ asset('assets/images/quote-sign-right.png') }}"
                                        class="quote-sign-right ms-2"
                                        alt=""
                                    />
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
