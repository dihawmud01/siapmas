@push('script')
    @vite(['resources/js/plugins/echarts.js'])
@endpush

<div class="card">
    <div class="card-body p-5">
        <h5 class="card-title fw-bold fs-4 mb-4">
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

<div class="card">
    <div class="card-body p-5">
        <h5 class="card-title fw-bold fs-4 mb-4">
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
