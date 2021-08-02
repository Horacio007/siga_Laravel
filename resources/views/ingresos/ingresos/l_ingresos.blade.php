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
                    <h3>Listado de Ingresos</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <a href="{{url('/i_ingresos')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_ingresos" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th class="scope">Id</th>
                            <th>Expediente</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>Tipo Servicio</th>
                            <th>Fecha de Anticipo</th>
                            <th>Anticipo</th>
                            <th>Tipo de Pago Anticipo</th>
                            <th>Fecha Finiquito</th>
                            <th>Finiquito</th>
                            <th>Tipo de Pago Finiquito</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($list_ingresos as $ingreso)
                                <tr>
                                    <td>{{$ingreso->id}}</td>
                                    @if ($ingreso->id_vehiculo == 789)
                                        <td>789</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @else
                                        <td>{{$ingreso->id_vehiculo}}</td>
                                        <td>{{$ingreso->marca}}</td>
                                        <td>{{$ingreso->submarca}}</td>
                                        <td>{{$ingreso->color}}</td>
                                        <td>{{$ingreso->modelo}}</td>
                                        <td>{{$ingreso->placas}}</td>
                                        <td>{{$ingreso->aseguradora}}</td>
                                    @endif
                                    <td>{{$ingreso->tipo_servicio}}</td>
                                    <td>{{$ingreso->fecha_anticipo}}</td>
                                    <td>{{$ingreso->anticipo}}</td>
                                    @switch($ingreso->tipo_pago_anticipo)
                                        @case(1)
                                            <td>Cheque</td>
                                            @break
                                        @case(2)
                                            <td>Efectivo</td>
                                            @break
                                        @case(3)
                                            <td>Transferencia</td>
                                            @break
                                        @case(4)
                                            <td>Mercado Pago</td>
                                            @break
                                        @default
                                            <td>No hay tipo de pago registrado</td>
                                    @endswitch
                                    <td>{{$ingreso->fecha_finiquito}}</td>
                                    <td>{{$ingreso->finiquito}}</td>
                                    @switch($ingreso->tipo_pago_finiquito)
                                        @case(1)
                                            <td>Cheque</td>
                                            @break
                                        @case(2)
                                            <td>Efectivo</td>
                                            @break
                                        @case(3)
                                            <td>Transferencia</td>
                                            @break
                                        @case(4)
                                            <td>Mercado Pago</td>
                                            @break
                                        @default
                                            <td>No hay tipo de pago registrado</td>
                                    @endswitch
                                    <td>{{$ingreso->total}}</td>
                                    <td>
                                        <a href="{{ route('u_ingresos', $ingreso->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$ingreso->id}}" title="Eliminar"><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('/js/ingresos/ingresos/l_ingresos.js') }}"></script>
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
@endsection