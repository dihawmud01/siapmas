@section('title')
    {{ __('Home') }}
@endsection

@extends('users.layout')

@section('content')
    <section id="hero">
        <div class="hero-container">
            <div
                id="heroCarousel"
                class="carousel slide carousel-fade"
                data-bs-ride="carousel"
                data-bs-interval="20000"
            >
                <ol id="hero-carousel-indicators" class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">
                    <div
                        class="carousel-item active"
                        style="background-image: url({{ asset('assets/images/logokomi.png') }})"
                    >
                        <div class="carousel-container">
                            <div class="container">
                                <h2 class="animate__animated animate__fadeInDown">
                                    {{ __('Selamat Datang') }}
                                    <br />
                                    {{ __('Di Website PC IPNU IPPNU BANYUMAS') }}
                                </h2>
                                <a
                                    href="{{ route('login') }}"
                                    class="btn-get-started scrollto animate__animated animate__fadeInUp"
                                >
                                    {{ __('Mulai') }}
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
                                    <h2 class="animate__animated animate__fadeInDown">{{ $value['title'] }}</h2>
                                    <a
                                        href="{{ $value->link }}"
                                        class="btn-get-started scrollto animate__animated animate__fadeInUp"
                                    >
                                        {{ __('Mulai') }}
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

    <section id="about">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>{{ __('Tentang Kami') }}</h3>
            </header>

            <h6 class="pl-2 pr-2 text-center">
                {{ __('IPNU IPPNU Merupakan Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum quidem voluptas beatae iusto saepe eaque vel doloribus non aliquam, a esse molestiae illo ab exercitationem vero officiis quaerat veniam natus!') }}
            </h6>
        </div>
    </section>

    <section id="facts">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>{{ __('Rekan Rekanita dalam Angka') }}</h3>
                <h2>{{ __('Data Kader PC IPNU IPPNU BMS') }}</h2>
            </header>

            <div class="row counters text-center">
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
            {{-- <div class="facts-img"> --}}
            {{-- <img src="{{ asset('assets/images/waduh.jpeg') }}" alt="" class="img-fluid" /> --}}
            {{-- </div> --}}
        </div>
    </section>

    <div class="col-12 p-4" data-aos="fade-up">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{ __('Data Rekan & Rekanita') }}
                    <span>{{ __('Dari Tahun Ke Tahun') }}</span>
                </h5>

                <div id="reportsChart"></div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const makestaCounts = @json($makestaCounts);

                        const years = ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'];
                        const data = years.map((year) => makestaCounts[year] || 0);

                        new ApexCharts(document.querySelector('#reportsChart'), {
                            series: [
                                {
                                    name: '{{ __('Makesta') }}',
                                    data: data,
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
                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
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
                                categories: ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'],
                            },
                            tooltip: {
                                x: {
                                    format: 'yyyy',
                                },
                            },
                        }).render();
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="p-4" data-aos="fade-up">
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">
                        {{ __('Kader Berdasarkan Jenis Kelamin') }}
                    </h5>
                    <div id="trafficChart" style="min-height: 400px" class="echart"></div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            echarts.init(document.querySelector('#trafficChart')).setOption({
                                tooltip: {
                                    trigger: 'item',
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center',
                                },
                                series: [
                                    {
                                        name: '{{ __('Akses Dari') }}',
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

        <div class="col-12 mb-2" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ __('Kader Berdasarkan PAC/Komisariat') }}
                    </h5>

                    <div id="pieChart" style="min-height: 600px" class="echart"></div>
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
                                    orient: 'vertical',
                                    left: 'left',
                                },
                                series: [
                                    {
                                        name: '{{ __('Akses Dari') }}',
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
        {{-- <div class="card-body"> --}}
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
    </div>

    <section id="testimonials" class="section-bg">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3 style="text-transform: inherit">Quote Of The Day</h3>
            </header>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($quotes as $quote)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img
                                    src="{{ asset('storage/images/' . $quote->img) }}"
                                    class="testimonial-img"
                                    alt=""
                                    style="width: 110px; height: 110px; object-fit: cover"
                                />
                                <h3>{{ $quote->name }}</h3>
                                <h4>{{ $quote->who }}</h4>
                                <p>
                                    <img
                                        src="{{ asset('assets_user/img/quote-sign-left.png') }}"
                                        class="quote-sign-left"
                                        alt=""
                                    />
                                    {{ $quote->quote }}
                                    <img
                                        src="{{ asset('assets_user/img/quote-sign-right.png') }}"
                                        class="quote-sign-right"
                                        alt=""
                                    />
                                </p>
                            </div>
                        </div>
                        <!-- End testimonial item -->
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
