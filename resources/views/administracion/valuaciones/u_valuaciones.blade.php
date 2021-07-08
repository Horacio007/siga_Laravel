@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_valuaciones', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Valuacion</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="lestatus">Estatus:</label><br>
                    <select name="estatus" class="form-control" value="{{$vehiculo->estatus_id}}" required>
                        <option value="{{$vehiculo->estatus_id}}" selected>{{$e_actual->status}}</option>
                        @foreach ($list_estatus as $estatus)
                            <option value="{{$estatus->id}}">{{$estatus->status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Llegada al Taller:</label><br>
                    <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" value="{{$vehiculo->fecha_llegada}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Dias Promesa de Reparacion:</label><br>
                    <input type="text" class="form-control" name="dias_rep" id="dias_rep" value="{{$vehiculo->fecha_promesa}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Envio:</label><br>
                    <input type="date" class="form-control" name="fecha_envio" id="fecha_envio" value="{{$vehiculo->fecha_valuacion}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lcantidad">Cantidad:</label><br>
                    <input type="text" class="form-control" name="cantidadini" id="cantidadini" value="{{$vehiculo->cantidad_inicial}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lpzscambio">Piezas a cambio:</label><br>
                    <input type="text" class="form-control" name="pzscambioini" id="pzscambioini" value="{{$vehiculo->piezas_cambiadas_inicial}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="lpzsrepara">Piezas a reparacion:</label><br>
                    <input type="text" class="form-control" name="pzsreparaini" id="pzsreparaini" value="{{$vehiculo->piezas_reparacion_inicial}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Autorizacion:</label><br>
                    <input type="date" class="form-control" name="fecha_autorizacion" id="fecha_autorizacion" value="{{$vehiculo->fecha_autorizacion}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lcantidad">Cantidad:</label><br>
                    <input type="text" class="form-control" name="cantidadfin" id="cantidadfin" value="{{$vehiculo->cantidad_final}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lpzscambio">Piezas a cambio:</label><br>
                    <input type="text" class="form-control" name="pzscambiofin" id="pzscambiofin" value="{{$vehiculo->piezas_cambiadas_final}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lpzsreparafin">Piezas a reparacion:</label><br>
                    <input type="text" class="form-control" name="pzsreparafin" id="pzsreparafin" value="{{$vehiculo->piezas_reparacion_final}}" required>
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Piezas Vendidas:</label><br>
                    <input type="text" class="form-control" name="pzsvendidas" id="pzsvendidas" value="{{$vehiculo->piezas_vendidas}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="lcantidad">Importe Piezas Vendidas:</label><br>
                    <input type="text" class="form-control" name="importepzsvendidas" id="importepzsvendidas" value="{{$vehiculo->importe_piezas_vendidas}}" required>
                </div>
                <div class="col-md-3">

                    <input type="hidden" class="form-control" name="porcentapro" id="porcentapro" value="{{$vehiculo->porcentaje_aprobacion}}">
                </div>
            </div>
            <br>
        </form>
    </div>
@endsection