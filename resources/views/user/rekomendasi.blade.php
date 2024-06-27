@extends('adminlte::page')

@section('title', 'Cek Rekomendasi Menu Makanan')

@section('content_header')
<h1 class="m-0 text-dark">Rekomendasi Makanan</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">Menu Rekomendasi Untuk Balita</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="id" value="{{$user->id}}" hidden>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required {{ $user->name ? 'readonly' : '' }}>
                </div>
            </div>
            <div class="form-group row">
                <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required readonly value="{{$user->tinggi_badan}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cm</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" required readonly value="{{$user->berat_badan}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Kg</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="document.getElementById('loading').style.display = 'block'; setTimeout(function() { document.getElementById('loading').style.display = 'none'; document.getElementById('hasil-berat-badan').style.display = 'block'; }, 2000);">Ayo Cek Berat Badan Ideal (BBI) Dulu !</button>
            <div id="loading" class="text-center" style="display: none; margin: 10px;">
                <div class="spinner-border text-primary" role="status" style="margin: 0 auto;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="card-body" id="hasil-berat-badan" style="display: none;">
                <p class="text-center">Hasil Perhitungan Berat Badan Ideal</p>
                <p class="text-center text-bold">
                    @if($user->hasil == 'Under')
                        <span style="color: orange;">Kekurangan Berat Badan</span>
                    @elseif($user->hasil == 'Normal')
                        <span style="color: green;">Berat Badan Normal</span>
                    @elseif($user->hasil == 'Over')
                        <span style="color: red;">Kelebihan Berat Badan</span>
                    @else
                        Lengkapi Data Dulu
                    @endif
                </p>

                <a href="{{ route ('user.rekomen.check')}}" type="button" class="btn btn-success w-100">Ayo Cek Menu Rekomendasi!</a>
            </div>
        </div>
    </div>

@stop
