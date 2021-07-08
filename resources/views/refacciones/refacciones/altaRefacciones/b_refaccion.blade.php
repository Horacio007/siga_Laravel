@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('b_refaccion', $almacen->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Baja de Refacciones en Almacen</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="lnombre">Ubicacion:</label><br>
                <input type="number" name="ubicacion" class="form-control" value="{{$almacen->ubicacion}}" id="aubicacion" required>
            </div>
            <div class="col-md-4">
                <label for="ldescripcion">Fecha de Entrega:</label><br>
                <input type="date" name="fecha_entrega" class="form-control" id="afechaentrega" required>
            </div>
            <div class="col-md-4">
                <label for="lcosto">Estatus Actual:</label><br>
                <input type="text" class="form-control" id="aestatus" value="{{$estatusN->estatus}}" readonly required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="lcosto">Nuevo Estatus:</label><br>
                <select name="nestatus" class="form-control" placeholder="Selecciona el nuevo estatus" required>
                    <option value="0">Selecciona un nuevo estatus</option>
                    @foreach ($estatusV as $estatus)
                        <option value="{{$estatus->id}}">{{$estatus->estatus}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="lstock">Comentatarios:</label><br>
                <input type="text" name="comentarios" class="form-control" value="{{$almacen->comentarios}}" id="acomentarios" required><br>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btnmodificar">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection