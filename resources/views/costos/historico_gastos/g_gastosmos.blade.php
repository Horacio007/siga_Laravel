@extends('layouts.master')
@section('content')
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
@endsection