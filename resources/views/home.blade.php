@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    @if($user->roles_id == 1)
        <div class="card">
            <div class="card-header">{{__('Dashboard')}}</div>
            <div class="card-body">
                Anda login sebagai admin
            </div>
        </div>
    @elseif($user->roles_id == 2)
        <div class="card card-primary">
            <div class="card-header ">Diagram Berat Badan Ideal (BBI)</div>
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
    @endif
@stop

@section('js')
    @if($user->roles_id == 2)
        <script>
            // Mengambil data dari blade template
            var data = @json($data);
            var rangeMin = @json($rangeMin);
            var rangeMinToleran = @json($rangeMinToleran);
            var rangeMax = @json($rangeMax);
            var rangeMaxToleran = @json($rangeMaxToleran);
            var categories = @json($categories);

            var options = {
                chart: {
                    type: 'area',
                    height: 350
                },
                series: [{
                    name: 'BMI',
                    data: data
                }],
                xaxis: {
                    categories: categories,
                    title: {
                        text: 'Frekuensi'
                    }
                },
                yaxis: {
                    min: rangeMinToleran,
                    max: rangeMaxToleran,
                    title: {
                        text: 'Nilai Berat Badan Ideal (BBI)'
                    }
                },
                annotations: {
                    yaxis: [
                        {
                            y: rangeMin,
                            borderColor: '#FF4560',
                            label: {
                                borderColor: '#FF4560',
                                style: {
                                    color: '#fff',
                                    background: '#FF4560'
                                },
                                text: 'Under Weight',
                                offsetX: -50,
                                offsetY: 45,
                                textAnchor: 'middle'
                            }
                        },
                        {
                            y: rangeMin,
                            y2: rangeMax,
                            borderColor: '#008000',
                            fillColor: '#008000',
                            opacity: 0.2,
                            label: {
                                borderColor: '#008000',
                                style: {
                                    color: '#fff',
                                    background: '#008000'
                                },
                                text: 'Normal',
                                offsetY: 60,
                                offsetX: -20,
                            }
                        },
                        {
                            y: rangeMax,
                            borderColor: '#FEB019',
                            stroke: {
                                width: 40
                            },
                            label: {
                                borderColor: '#FEB019',
                                style: {
                                    color: '#fff',
                                    background: '#FEB019'
                                },
                                text: 'Over Weight',
                                offsetX: -15,
                                offsetY: -37,
                            }
                        }
                    ]
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>
    @endif
@stop
