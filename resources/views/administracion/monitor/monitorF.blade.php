@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Monitor Facturas</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_monitor" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                                <th>Expediente</th>
                                <th>Estatus</th>
                                <th>Fecha de Entrega</th>
                                <th>Marca</th>
                                <th>Linea</th>
                                <th>Color</th>
                                <th>Modelo</th>
                                <th>Placas</th>
                                <th>Cliente</th>
                                <th>Estatus Inicial F</th>
                                <th>Estatus Final F</th>
                                <th>Fecha BBVA</th>
                        </thead>
                        <tbody>
                            @foreach ($monitor as $mon)
                                <tr>
                                    <td>{{$mon->id}}</td>
                                    <td>{{$mon->estatus->status}}</td>
                                    <td>{{$mon->fecha_salida_taller}}</td>
                                    <td>{{$mon->marcas->marca}}</td>
                                    <td>{{$mon->submarcas->submarca}}</td>
                                    <td>{{$mon->color}}</td>
                                    <td>{{$mon->modelo}}</td>
                                    <td>{{$mon->placas}}</td>
                                    <td>{{$mon->clientes->nombre}}</td>
                                    @if ($mon->clientes->id == 3)
                                        @if ($mon->facturas->recibo_pagos??'')
                                            @switch($mon->facturas->estatus_aseguradora??'')
                                                @case(1)
                                                    <td>Facturado</td>
                                                    @break
                                                @case(2)
                                                    <td>Pagado</td>
                                                    @break
                                                @case(3)
                                                    <td>Pendiente</td>
                                                    @break
                                                @case(null)
                                                    <td>Pendiente</td>
                                                    @break
                                                @default
                                                    <td>Algo salio mal</td>
                                            @endswitch
                                        @else
                                            <td>N/A</td>
                                        @endif
                                    @else
                                        @if ($mon->facturas->fecha_facturacion??'')
                                            <td>Facturado</td>
                                        @else
                                            <td>Pendiente Facturacion</td>
                                        @endif
                                    @endif
                                    @switch($mon->facturas->estatus_aseguradora??'')
                                        @case(1)
                                            <td>Facturado</td>
                                            @break
                                        @case(2)
                                            <td>Pagado</td>
                                            @break
                                        @case(3)
                                            <td>Pendiente</td>
                                            @break
                                        @case(null)
                                            <td>Pendiente</td>
                                            @break
                                        @default
                                            <td>Algo salio mal</td>
                                    @endswitch
                                    @if ($mon->clientes->id == 3)
                                        @if ($mon->facturas->recibo_pagos??'')
                                            <td>Pagado</td>
                                        @else
                                            <td>Pendiente</td>
                                        @endif
                                    @else
                                        @if ($mon->facturas->fecha_bbva_pagada??'')
                                            <td>Pagado</td>
                                        @else
                                            <td>Pendiente</td>
                                        @endif
                                    @endif
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
    <script src="{{ asset('/js/administracion/monitor/monitorF.js') }}"></script>
@endsection