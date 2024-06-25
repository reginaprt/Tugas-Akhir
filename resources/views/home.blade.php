@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{__('Dashboard')}}</div>
        <div class="card-body">
            @if($user->roles_id == 1)
                Anda login sebagai admin
            @else
            @endif
            <canvas id="barChart" width="400" height="400"></canvas>
        </div>
    </div>
@stop

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/chart-data')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('barChart').getContext('2d');
                var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'],
                        datasets: [{
                            label: 'Actual',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            data: data.actual,
                        }, {
                            label: 'Target',
                            type: 'line',
                            fill: false,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            data: data.target,
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
            .catch(error => console.error('Fetch error:', error));
    });
</script>
@stop
