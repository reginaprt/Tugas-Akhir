@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    @if($user->roles_id == 1)
            <div class="info-box mb-3 bg-secondary col-md-5">
                <span class="info-box-icon">
                    <ion-icon name="person-outline"></ion-icon>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Welcome</span>
                    <span class="info-box-number">Admin</span>
                </div>
            </div>
            <div class="info-box mb-3 bg-success col-md-5">
                <span class="info-box-icon">
                    <ion-icon name="fast-food-outline"></ion-icon>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Menu</span>
                    <span class="info-box-number">{{$jumlahMenu}}</span>
                </div>
            </div>
    @elseif($user->roles_id == 2)
        <div class="card card-primary">
            <div class="card-header ">Diagram Berat Badan Ideal (BBI)</div>
            <div class="card-body">
            @if($usia == NULL)
                Data Belum Tersedia
            @else
                <div id="chart"></div>
            @endif
            </div>
        </div>
    @endif
@stop

@section('js')
    @if($user->roles_id == 2)
        <script>
            var data = @json($data);
            var rangeMin = @json($rangeMin);
            var rangeMax = @json($rangeMax);
            var categories = @json($categories);

            var options = {
                chart: {
                    type: 'area',
                    height: 600
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
                    min: 0,
                    max: 37,
                    title: {
                        text: 'Nilai Berat Badan (Kg)'
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
                                offsetY: 20,
                                textAnchor: 'middle'
                            }
                        },
                        {
                            y: rangeMin,
                            y2: rangeMax,
                            borderColor: '#008000',
                            fillColor: '#008000',
                            opacity: 0.2,
                        },
                        {
                            y: rangeMax,
                            borderColor: '#FEB019',
                            label: {
                                borderColor: '#FEB019',
                                style: {
                                    color: '#fff',
                                    background: '#FEB019'
                                },
                                text: 'Over Weight',
                                offsetX: -15,
                            }
                        }
                    ]
                },
                title: {
                    text: 'Grafik BMI Berdasarkan Frekuensi dan Nilai Berat Badan Ideal'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        </script>
    @endif
@stop
