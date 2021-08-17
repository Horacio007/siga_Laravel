@extends('layouts.master')
@section('content')
@if (Auth::user()->name != 'horacio' && Auth::user()->name != 'ramon' && Auth::user()->name != 'lucero' && Auth::user()->name != 'alicia' && Auth::user()->name != 'david' && Auth::user()->name != 'antonio')
    <strong><h1>No tienes permisos.</h1></strong>
@else
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Tipo de Gasto por mes</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col" id="tgmes"></div>
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/costos/historico_gastos/h_gastos.js') }}"></script>
    <script src="{{ asset('/libs/ploty/plotly-2.2.0.min.js') }}"></script>
@endif
@endsection