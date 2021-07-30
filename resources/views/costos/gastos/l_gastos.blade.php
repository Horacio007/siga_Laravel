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
                    <h3>Listado de Gastos</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-1">
                    <a href="{{url('/i_gastos')}}" class="btn btn-info">Registrar</a>
                </div>
                <div class="col-md-1">
                    <a href="{{url('/h_gastos')}}" class="btn btn-success">Grafico</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_gastos" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Fecha</th>
                            <th>Articulo</th>
                            <th>Cantidad</th>
                            <th>Forma Pago</th>
                            <th>Factura</th>
                            <th>Tipo Gasto</th>
                            <th>Proveedor</th>
                            <th>Expediente</th>
                            <td>Acciones</td>
                        </thead>
                        <tbody class="">
                            @foreach ($list_gastos as $gasto)
                            <tr>
                                <td>{{$gasto->id}}</td>
                                <td>{{$gasto->fecha}}</td>
                                <td>{{$gasto->articulos}}</td>
                                <td>{{$gasto->gastos}}</td>
                                <td>{{$gasto->forma_pagos->forma_pago}}</td>
                                <td>{{$gasto->facturas->nombre}}</td>
                                <td>{{$gasto->concepto_pagos->concepto_pago}}</td>
                                <td>{{$gasto->proveedor}}</td>
                                @if ($gasto->expedientes->id > 0)
                                    <td>{{$gasto->expedientes->id}}</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                
                                <td><a href="{{ route('u_gastos', $gasto->id)}}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a> 
                                <a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$gasto->id}}" title="Eliminar"><i class="fa fa-trash"></i></a></td>
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
    <script src="{{ asset('/js/costos/gastos/l_gastos.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_gastos', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Gasto</label>
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