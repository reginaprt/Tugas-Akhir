@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop   

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">{{__('Dashboard')}}</div>

                    <div class="card-body">
                        <p class="mb-0">You are logged in!</p>

                        @if($user->roles_id == 1)
                            Anda Masuk Sebagai Admin
                        @else 
                            Anda Masuk Sebagai User
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
