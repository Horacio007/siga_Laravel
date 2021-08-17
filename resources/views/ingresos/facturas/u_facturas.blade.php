@extends('layouts.master')
@section('content')
@if (Auth::user()->name != 'horacio' && Auth::user()->name != 'ramon' && Auth::user()->name != 'lucero' && Auth::user()->name != 'alicia' && Auth::user()->name != 'david' && Auth::user()->name != 'antonio')
    <strong><h1>No tienes permisos.</h1></strong>
@else
    <div class="container-fluid">
        <form action="{{ route('u_facturas', $facturas->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Cobro</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Marca</label>
                    <input type="text" value="{{$vehiculos->marcas->marca}}" id="marca" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Linea</label>
                    <input type="text" value="{{$vehiculos->submarcas->submarca}}" id="linea" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Color</label>
                    <input type="text" value="{{$vehiculos->color}}" name="color" id="color" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Modelo</label>
                    <input type="text" value="{{$vehiculos->modelo}}" name="modelo" id="modelo" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Placas</label>
                    <input type="text" value="{{$vehiculos->placas}}" name="placas" id="placas" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Cliente</label>
                    <input type="text" value="{{$vehiculos->clientes->nombre}}" name="cliente" id="cliente" class="form-control" disabled readonly required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Folio</label>
                    <input type="number" value="{{$facturas->folio}}" name="folio" id="folio" class="form-control" placeholder="Ingresa el folio de la factura" required>
                </div>
                <div class="col-md-2">
                    <label for="">Estatus Aseguradora</label>
                    <select name="sestatus" id="sestatus" class="form-control" required>
                    <option value="0">Selecciona el estatus</option>
                        @foreach ($estausF as $estatus)
                            @if ($estatus->id == $facturas->estatus_aseguradora)
                                <option value="{{$estatus->id}}" selected>{{$estatus->estatus}}</option>   
                            @endif
                            <option value="{{$estatus->id}}">{{$estatus->estatus}}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="ltservicio">Tipo de Servicio</label><br>
                    <select name="tipo_servicio" id="i_ingresos" class="form-control">
                        <option value="0">Selecciona el tipo de servicio</option>
                        @foreach ($tipo_servicio as $servicio)
                            @if ($servicio->id == $facturas->tipo_servicio_id)
                                <option value="{{$servicio->id}}" selected>{{$servicio->tipo_servicio}}</option>
                            @endif
                            <option value="{{$servicio->id}}">{{$servicio->tipo_servicio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha de Facturacíon</label>
                    <input type="date" value="{{$facturas->fecha_facturacion}}" name="fechaf" id="fechaf" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha de Anticipo</label>
                    <input type="date" value="{{$facturas->fecha_anticipo}}" name="fanticipo" id="fanticipo" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Tipo de Pago de Anticipo</label>
                    <select name="tipo_anticipo" id="tipo_anticipo" class="form-control">
                        <option value="0">Selecciona el tipo de anticipo</option>
                        @foreach ($tipo_pago as $tp)
                            @if ($tp->id == $facturas->tipo_pago_anticipo_id)
                                <option value="{{$tp->id}}" selected>{{$tp->tipo_pago}}</option>
                            @endif
                            <option value="{{$tp->id}}">{{$tp->tipo_pago}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Anticipo</label>
                    <input type="text" value="{{$facturas->anticipo}}" name="ianticipo" id="ianticipo" class="form-control" placeholder="Ingresa la Cantidad del Anticipo...">
                </div>
                <div class="col-md-2">
                    <label for="">Fecha pago</label>
                    <input type="date" value="{{$facturas->fecha_bbva}}" name="fbbva" id="fbbva" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="">Tipo de Pago</label>
                    <select name="pago" id="cpago" class="form-control" required>
                        <option value="0">Seleccion Tipo de Pago:</option>
                        @foreach ($tipo_pago as $concepto)
                            @if ($concepto->id == $facturas->tipo_pago_id)
                                <option value="{{$concepto->id}}" selected>{{$concepto->tipo_pago}}</option>
                            @endif
                            <option value="{{$concepto->id}}">{{$concepto->tipo_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Total</label>
                    <input type="text" value="{{$facturas->cantidad}}" name="cantidad" id="cantidad" class="form-control" placeholder="Ingresa el costo total" required>
                </div>
                <div class="col-md-4">
                    <label for="">Comentarios</label>
                    <input type="text" value="{{$facturas->comentarios}}" name="comentarios" id="comentarios" class="form-control" placeholder="Agrega un comentario..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="iexpediente2" id="iexpediente2" hidden readonly required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/ingresos/facturas/u_facturas.js') }}"></script>
@endif
@endsection