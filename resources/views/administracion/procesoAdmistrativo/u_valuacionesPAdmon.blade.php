@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_valuacionesPA', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Valuacion</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="lestatus">Ubicacion:</label><br>
                    <select name="estatus" class="form-control" required>
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
                    <label for="lestatus">Proceso:</label><br>
                    <select name="estatusProceso" class="form-control text-capitalize">
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
                    <label for="lreporte">No. Reporte/Siniestro:</label><br>
                    <input type="text" class="form-control" id="no_reporte" name="no_reporte" value="{{$vehiculo->no_siniestro}}">
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Llegada al Taller a Reparacion:</label><br>
                    <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" value="{{$vehiculo->fecha_llegada}}">
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Dias Promesa de Reparacion:</label><br>
                    <input type="text" class="form-control" name="dias_rep" id="dias_rep" value="{{$vehiculo->fecha_promesa}}">
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Envio:</label><br>
                    <input type="date" class="form-control" name="fecha_envio" id="fecha_envio" value="{{$vehiculo->fecha_valuacion}}">
                </div>             
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="lcantidad">Cantidad:</label><br>
                    <input type="text" class="form-control" name="cantidadini" id="cantidadini" value="{{$vehiculo->cantidad_inicial}}">
                </div>  
                <div class="col-md-2">
                    <label for="lpzscambio">Piezas a cambio:</label><br>
                    <input type="text" class="form-control" name="pzscambioini" id="pzscambioini" value="{{$vehiculo->piezas_cambiadas_inicial}}">
                </div>
                <div class="col-md-2">
                    <label for="lpzsrepara">Piezas a reparacion:</label><br>
                    <input type="text" class="form-control" name="pzsreparaini" id="pzsreparaini" value="{{$vehiculo->piezas_reparacion_inicial}}">
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Fecha Autorizacion:</label><br>
                    <input type="date" class="form-control" name="fecha_autorizacion" id="fecha_autorizacion" value="{{$vehiculo->fecha_autorizacion}}">
                </div>
                <div class="col-md-2">
                    <label for="lcantidad">Cantidad:</label><br>
                    <input type="text" class="form-control" name="cantidadfin" id="cantidadfin" value="{{$vehiculo->cantidad_final}}">
                </div>
                <div class="col-md-2">
                    <label for="lpzscambio">Piezas a cambio:</label><br>
                    <input type="text" class="form-control" name="pzscambiofin" id="pzscambiofin" value="{{$vehiculo->piezas_cambiadas_final}}">
                </div>     
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="lpzsreparafin">Piezas a reparacion:</label><br>
                    <input type="text" class="form-control" name="pzsreparafin" id="pzsreparafin" value="{{$vehiculo->piezas_reparacion_final}}">
                </div>
                <div class="col-md-2">
                    <label for="lfenvio">Piezas Vendidas:</label><br>
                    <input type="text" class="form-control" name="pzsvendidas" id="pzsvendidas" value="{{$vehiculo->piezas_vendidas}}">
                </div>
                <div class="col-md-2">
                    <label for="lcantidad">Importe Piezas Vendidas:</label><br>
                    <input type="text" class="form-control" name="importepzsvendidas" id="importepzsvendidas" value="{{$vehiculo->importe_piezas_vendidas}}">
                </div>
                <div class="col-md-2">
                    <label for="lcantidad">Deducible</label><br>
                    <input type="text" class="form-control" name="deducible" id="deducible" value="{{$vehiculo->proceso}}">
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <input type="submit" value="Actualizar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-1">
                    <input type="hidden" class="form-control" name="porcentapro" id="porcentapro" value="{{$vehiculo->porcentaje_aprobacion}}">
                </div>
                <div class="col-md-1">
                    <input type="hidden" class="form-control" name="diferencia" id="diferencia" value="{{$difee}}">
                </div>
            </div>
            <br>
        </form>
    </div>
@endsection