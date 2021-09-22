@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Actualizar Recibos de Pago a Proveedores</h3>
            </div>
        </div>
        <br>
        <form action="{{ route('u_recibo_pagos_pro', $recibo_pago_proveedores->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="">Fecha</label>
                    <input type="date" value="{{$recibo_pago_proveedores->fecha}}" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="">Concepto</label>
                    <input type="text" value="{{$recibo_pago_proveedores->concepto}}" name="articulo" id="articulo" class="form-control" placeholder="Ingresa el articulo..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Cantidad</label>
                    <input type="text" value="{{$recibo_pago_proveedores->cantidad}}" name="cantidad" id="cantidad" class="form-control" placeholder="Ingresa la cantidad..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Forma de Pago</label>
                    <select name="forma_pago" id="sfpago" class="form-control" required>
                        <option value="0">Seleccion Froma de Pago:</option>
                        @foreach ($forma_pago as $fp)
                            @if ($recibo_pago_proveedores->forma_pagos->id == $fp->id)
                            <option value="{{$fp->id}}" selected>{{$fp->forma_pago}}</option>
                            @endif
                            <option value="{{$fp->id}}">{{$fp->forma_pago}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Factura</label>
                    <select name="sfactura" id="sfactura" class="form-control" required>
                        <option value="0">Aplica factura...</option>
                    @foreach ($sino as $sn)
                        @if ($recibo_pago_proveedores->requiere_factura->id == $sn->id)
                            <option value="{{$sn->id}}" selected>{{$sn->nombre}}</option>
                        @endif
                        <option value="{{$sn->id}}">{{$sn->nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Tipo de Gasto</label>
                    <select name="gasto" id="tgasto" class="form-control" required>
                        <option value="0">Seleccion Concepto de Pago:</option>
                        @foreach ($conceptos_pago as $concepto)
                            @if ($recibo_pago_proveedores->tipo_pagos->id == $concepto->id)
                                <option value="{{$concepto->id}}" selected>{{$concepto->concepto_pago}}</option>
                            @endif
                            <option value="{{$concepto->id}}">{{$concepto->concepto_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Proveedor</label>
                    <input type="text" value="{{$recibo_pago_proveedores->proveedor}}" name="proveedor" id="proveedor" class="form-control" placeholder="Ingrese Proveedor..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Expediente</label>
                    <input type="text" value="{{$recibo_pago_proveedores->id_vehiculo??'N/A'}}" name="expediente" id="expediente" class="form-control" placeholder="Ingrese el numero de expediente" required>
                    <div id="inf" class="text-center">
                        <label for="" id="info"></label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="folio" value="{{$prr}}" id="folio" hidden readonly>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
        </form>
    </div>
    <script src="{{ asset('js/costos/recibo_pago/u_recibos.js') }}"></script>
@endsection