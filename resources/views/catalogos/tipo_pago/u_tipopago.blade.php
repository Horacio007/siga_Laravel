@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_tipopago', $tipo_pago->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Tipo de Pago</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Nombre del tipo pago..." value="{{$tipo_pago->tipo_pago}}" required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </form>
    </div>
@endsection