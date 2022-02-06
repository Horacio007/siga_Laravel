@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" id="formdataa">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar Recibos de Pago</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="lexpediente">No. Expediente</label>
                    <input type="text" class="form-control" id="iexpediente" required>
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="button" class="btn btn-info btn-lg btn-block" id="btn_buscar">Buscar</button>
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <div id="inf" class="text-center">
                        <label for="" id="info"></label>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <form action="/i_recibo_pagos" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="">Requiere Factura</label>
                    <select name="aplica_factura" class="form-control" required>
                        <option value="0">Selecciona si aplica factura</option>
                        @foreach ($si_no as $aplica_fac)
                            <option value="{{$aplica_fac->id}}">{{$aplica_fac->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control"required>
                </div>
                <div class="col-md-2">
                    <label for="">Forma de Pago</label>
                    <select name="tipo_pago" id="tipo_pago" class="form-control">
                        <option value="0">Selecciona el tipo de anticipo</option>
                        @foreach ($tipo_pago as $tp)
                            <option value="{{$tp->id}}">{{$tp->tipo_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Tipo de Servico</label>
                    <select name="tipo_servicio" id="i_ingresos" class="form-control">
                        <option value="0">Selecciona el tipo de servicio</option>
                        @foreach ($tipo_servicio as $servicio)
                            <option value="{{$servicio->id}}">{{$servicio->tipo_servicio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Concepto</label>
                    <input type="text" name="concepto" id="concepto" class="form-control">
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="iexpediente2" id="iexpediente2" hidden readonly required>
                    <input type="text" class="form-control" name="folio" id="folio" hidden readonly required>
                    <input type="text" class="form-control" name="cliente" id="cliente" hidden readonly required>
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
                            <th>Ubicacion</th>
                            <th>Proceso</th>
                            <th>Fecha Salida Taller</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{$vehiculo->id}}</td>
                                    <td>{{$vehiculo->estatusV->status}}</td>
                                    <td>{{$vehiculo->estatusProceso->estatus}}</td>
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
    <script src="{{ asset('/js/ingresos/recibo_pagos/i_recibos.js') }}"></script>
    <script src="{{ asset('libs/jsPDF/jspdf.debug.js') }}"></script> 
@endsection