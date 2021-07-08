@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_cambiarEstatus', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Estatus del Vehiculo Entrega</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="ldescripcion">Estatus Actual:</label><br>
                    <input type="text" class="form-control" name="e_viejo" value="{{$e_actual->status}}" id="iestatusA" readonly required>
                </div>
                <div class="col-md-3">
                    <label for="larea">Estatus Nuevo:</label>
                    <select name="e_nuevo" class="form-control">
                        <option value="0">Selecciona el Estatus</option>
                        @foreach ($list_estatus as $estatus)
                            <option value="{{$estatus->id}}">{{$estatus->status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Fecha de Salida</label><br>
                    <input type="date" class="form-control" name="fecha_salida_taller" id="dfecha_salida" required>
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                    <button type="submit" class="btn btn-success btn-lg btn-block" id="btnmodificar">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection