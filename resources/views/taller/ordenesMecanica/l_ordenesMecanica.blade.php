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
                    <h3>Listado de Ordenes de Mecanica</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <a href="{{url('/i_ordenesm')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_ordenesm" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Expediente</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Modelo</th>
                            <th>Aseguradora</th>
                            <th>Fecha Elaboracion</th>
                            <th>Diagnostico</th>
                            <th>Elaboro</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_ordenes as $orden)
                            <tr>
                                <td>{{$orden->id}}</td>
                                <td>{{$orden->id_vehiculo}}</td>
                                <td>{{$orden->marca}}</td>
                                <td>{{$orden->submarca}}</td>
                                <td>{{$orden->modelo}}</td>
                                <td>{{$orden->nombre}}</td>
                                <td>{{$orden->fecha}}</td>
                                <td>{{$orden->diagnostico}}</td>
                                <td>{{$orden->nombre}}</td>
                                <td><a href="{{ route('create_pdfom', $orden->id) }}" class="btn btn-info" target='_blank' title="PDF"><i class="fa fa-file-pdf"></i></a>
                                <a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$orden->id}}" title="Eliminar"><i class="fa fa-trash"></i></a></td>
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
    <script src="{{ asset('/js/taller/ordenesMecanica/l_ordenesMecanica.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_ordenesm', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Orden de Mecanica</label>
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