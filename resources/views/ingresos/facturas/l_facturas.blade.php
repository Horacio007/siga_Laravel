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
                    <h3>Listado de Facturas</h3>
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
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>Cantidad</th>
                            <th>Fecha Facturacion</th>
                            <th>Estatus</th>
                            <th>Fecha BBVA</th>
                            <th>Comentarios</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($list_facturas as $facturas)
                                <tr>
                                    <td>{{$facturas->id}}</td>
                                    <td>{{$facturas->id_vehiculo}}</td>
                                    <td>{{$facturas->marca}}</td>
                                    <td>{{$facturas->submarca}}</td>
                                    <td>{{$facturas->color}}</td>
                                    <td>{{$facturas->modelo}}</td>
                                    <td>{{$facturas->placas}}</td>
                                    <td>{{$facturas->aseguradora}}</td>
                                    <td>{{$facturas->cantidad}}</td>
                                    <td>{{$facturas->fecha_facturacion}}</td>
                                    <td>{{$facturas->estatus}}</td>
                                    <td>{{$facturas->fecha_bbva}}</td>
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
@endsection