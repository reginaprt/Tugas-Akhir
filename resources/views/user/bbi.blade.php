@extends('adminlte::page')

@section('title', 'Input Data Berat Badan Ideal')

@section('content_header')
<h1 class="m-0 text-dark">Input Data Balita</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">Lengkapi Data Balita</div>
        <div class="card-body">
            <form action="{{ route('user.bbi.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="id" value="{{$user->id}}" hidden>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required {{ $user->name ? 'readonly' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required {{ $user->email ? 'readonly' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required {{ $user->jenis_kelamin ? 'readonly' : '' }}>
                            <option>Pilih</option>
                            <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cm</span>
                            </div>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required value="{{$user->tinggi_badan}}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="berat_badan" class="col-sm-2 col-form-label">Berat Badan</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kg</span>
                            </div>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" required value="{{$user->berat_badan}}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="{{$user->tanggal_lahir}}" {{ $user->tanggal_lahir ? 'readonly' : '' }}>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-md-12">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <div class="card card-success">
        <div class="card-header">Hasil Perhitungan Berat Badan Ideal</div>
        <div class="card-body">
            <h2 class="text-center">
                @if($user->hasil == 'Under')
                    Kekurangan Berat Badan
                @elseif($user->hasil == 'Normal')
                    Berat Badan Normal
                @elseif($user->hasil == 'Over')
                    Kelebihan Berat Badan
                @else
                    Lengkapi Data Dulu
                @endif
            </h2>
        </div>
    </div>
@stop
