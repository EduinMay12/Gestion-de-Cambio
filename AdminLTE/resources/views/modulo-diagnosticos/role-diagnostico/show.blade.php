@extends('adminlte::page')

@section('title', 'Ver diagnóstico')

@section('content_header')

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <div class="card-title">Ver Diagnóstico</div>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">

                <label for="">Nombre:</label>
                <span>{{ $roldiagnostico->nombre }}</span><br>

                <label for="">Descripción:</label>
                <span>{{ $roldiagnostico->descripcion }}</span><br>

                <label for="">Estatus:</label>
                <span>{{ $roldiagnostico->estatus }}</span><br>



                <div class="mt-4">
                    <a href="{{ route('roldiagnosticos.index') }}" class="btn btn-danger">
                        Vover
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
