@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
                <h3>Registrar Recibos de Pago a Proveedores</h3>
            </div>
        </div>
        <br>
        <form action="/i_recibo_pagos_pro" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="">Concepto</label>
                    <input type="text" name="articulo" id="articulo" class="form-control" placeholder="Ingresa el articulo..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Ingresa la cantidad..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Forma de Pago</label>
                    <select name="forma_pago" id="sfpago" class="form-control" required>
                        <option value="0">Seleccion Froma de Pago:</option>
                        @foreach ($forma_pago as $fp)
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
                        <option value="{{$sn->id}}">{{$sn->nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Tipo de Gasto</label>
                    <select name="gasto" id="tgasto" class="form-control" required>
                        <option value="0">Seleccion Concepto de Pago:</option>
                        @foreach ($conceptos_pago as $concepto)
                            <option value="{{$concepto->id}}">{{$concepto->concepto_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Proveedor</label>
                    <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Ingrese Proveedor..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Expediente</label>
                    <input type="text" name="expediente" id="expediente" class="form-control" placeholder="Ingrese el numero de expediente" required>
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_vehiculos" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th class="scope">Expediente</th>
                            <th>Estatus</th>
                            <th>Fecha Salida Taller</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{$vehiculo->id}}</td>
                                    <td>{{$vehiculo->estatus->status}}</td>
                                    <td>{{$vehiculo->fecha_salida_taller}}</td>
                                    <td>{{$vehiculo->marcas->marca}}</td>
                                    <td>{{$vehiculo->submarcas->submarca}}</td>
                                    <td>{{$vehiculo->color}}</td>
                                    <td>{{$vehiculo->modelo}}</td>
                                    <td>{{$vehiculo->placas}}</td>
                                    <td>{{$vehiculo->clientes->nombre}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/costos/recibo_pago/i_recibos.js') }}"></script>
    <script src="{{ asset('libs/jsPDF/jspdf.debug.js') }}"></script> 
@endsection