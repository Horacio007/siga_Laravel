@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_segrefaccion', $almacen->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Recepcion de Refacciones</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label for="">Fecha Llegada</label>
                <input type="date" name="fechallegada" id="fechallegada" value="{{$almacen->fecha_llegada}}" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Ubicacion</label>
                <input type="number" name="ubicacion" id="ubicacion" value="{{$almacen->ubicacion}}" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="">Comentarios</label>
                <input type="text" name="comentarios" id="comentarios" value="{{$almacen->comentarios}}" class="form-control">
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection