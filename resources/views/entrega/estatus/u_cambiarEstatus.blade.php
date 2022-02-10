@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_cambiarEstatus', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Proceso del Vehiculo Entrega</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <label for="ldescripcion">Proceso / Ubicación Actual:</label><br>
                    <input type="text" class="form-control text-capitalize" name="e_viejo" value="{{$vehiculo->estatusV->status.' -> '.ucfirst($vehiculo->estatusProceso->estatus)}}" id="iestatusA" readonly required>
                </div>
                <div class="col-md-2">
                    <label for="larea">Ubicación Nueva:</label>
                    <select name="e_nuevo" id="sestatus" class="form-control">
                        <option value="0">Selecciona el Proceso</option>
                        @foreach ($list_estatus as $estatus)
                            @if ($vehiculo->estatus_id == $estatus->id)
                                <option value="{{$estatus->id}}" selected>{{$estatus->status}}</option>
                            @else
                                <option value="{{$estatus->id}}">{{$estatus->status}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="larea">Proceso Nuevo:</label>
                    <select name="e_nuevoProceso" id="sproceso" class="form-control text-capitalize">
                        <option value="0">Selecciona el Proceso</option>
                        @foreach ($list_estatusProceso as $estatusP)
                            @if ($vehiculo->estatusProceso_id == $estatusP->id)
                                <option value="{{$estatusP->id}}" selected>{{$estatusP->estatus}}</option>
                            @else
                                <option value="{{$estatusP->id}}">{{$estatusP->estatus}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha de Salida</label><br>
                    <input type="date" class="form-control" name="fecha_salida_taller" id="dfecha_salida" required>
                </div>
                <div class="col-md-2">
                    <label for=""></label>
                    <button type="submit" class="btn btn-success btn-lg btn-block" id="btnmodificar">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('/js/entrega/estatus/u_cambiarEstatus.js') }}"></script>
@endsection