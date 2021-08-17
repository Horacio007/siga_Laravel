@extends('layouts.master')
@section('content')
@if (Auth::user()->name != 'horacio' && Auth::user()->name != 'ramon' && Auth::user()->name != 'lucero' && Auth::user()->name != 'alicia' && Auth::user()->name != 'david' && Auth::user()->name != 'antonio')
    <strong><h1>No tienes permisos.</h1></strong>
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Listado de Cobros</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <a href="{{url('/i_facturas')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_facturas" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th class="scope">Id</th>
                            <th>Expediente</th>
                            <th>Folio</th>
                            <th>Estatus Facturacion</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>Tipo Servicio</th>
                            <th>Fecha Facturacion</th>
                            <th>Fecha Anticipo</th>
                            <th>Tipo Pago Anticipo</th>
                            <th>Anticipo</th>
                            <th>Fecha Pago</th>
                            <th>Tipo Pago</th>
                            <th>Total</th>
                            <th>Comentarios</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($list_facturas as $facturas)
                                <tr>
                                    <td>{{$facturas->id}}</td>
                                    <td>{{$facturas->id_vehiculo}}</td>
                                    <td>{{$facturas->folio}}</td>
                                    <td>{{$facturas->estatusFac->estatus}}</td>
                                    @php
                                        for ($i=0; $i < sizeof($marcas); $i++) { 
                                            if ($marcas[$i]->id == $facturas->expedientes->marca_id) {
                                                $n_marca = $marcas[$i]->marca;
                                            }
                                        }

                                        for ($i=0; $i < sizeof($submarcas); $i++) { 
                                            if ($submarcas[$i]->id == $facturas->expedientes->linea_id) {
                                                $n_submarca = $submarcas[$i]->submarca;
                                            }
                                        }

                                        for ($i=0; $i < sizeof($aseguradoras); $i++) { 
                                            if ($aseguradoras[$i]->id == $facturas->expedientes->cliente_id) {
                                                $n_aseguradora = $aseguradoras[$i]->nombre;
                                            }
                                        }

                                        for ($i=0; $i < sizeof($tipo_pago); $i++) { 
                                            if ($tipo_pago[$i]->id == $facturas->tipo_pago_anticipo_id) {
                                                $n_tp = $tipo_pago[$i]->tipo_pago;
                                            }
                                        }

                                        for ($i=0; $i < sizeof($tipo_pago); $i++) { 
                                            if ($tipo_pago[$i]->id == $facturas->tipo_pago_id) {
                                                $n_tpt = $tipo_pago[$i]->tipo_pago;
                                            }
                                        }
                                    @endphp
                                    <td>{{$n_marca}}</td>
                                    <td>{{$n_submarca}}</td>
                                    <td>{{$facturas->expedientes->color}}</td>
                                    <td>{{$facturas->expedientes->modelo}}</td>
                                    <td>{{$facturas->expedientes->placas}}</td>
                                    <td>{{$n_aseguradora}}</td>
                                    <td>{{$facturas->tipo_servicios->tipo_servicio??""}}</td>
                                    <td>{{$facturas->fecha_facturacion}}</td>
                                    <td>{{$facturas->fecha_anticipo}}</td>
                                    <td>{{$n_tp??''}}</td>
                                    <td>{{$facturas->anticipo}}</td>
                                    <td>{{$facturas->fecha_bbva}}</td>
                                    <td>{{$n_tpt??''}}</td>
                                    <td>{{$facturas->cantidad}}</td>
                                    <td>{{$facturas->comentarios}}</td>
                                    <td>
                                        <a href="{{ route('u_facturas', $facturas->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$facturas->id}}" title="Eliminar"><i class="fa fa-trash"></i></a>
                                    </td>
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
    <script src="{{ asset('/js/ingresos/facturas/l_facturas.js') }}"></script>
    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_facturas', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Factura</label>
                            <input type="text" id="iarea" class="form-control" readonly>
                        </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" id="cerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="#" id="btn_delete" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>  
@endif
@endsection