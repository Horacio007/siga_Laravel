@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('u_formapago', $forma_pago->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Forma de Pago</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" value="{{$forma_pago->forma_pago}}" placeholder="Nombre de la forma de pago..." required>
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