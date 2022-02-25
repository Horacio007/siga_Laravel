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
                    <h3>Listado de Refacciones</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <a href="{{url('/i_refaccion')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_refacciones" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Fecha de Llegada</th>
                            <th>Aseguradora</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Modelo</th>
                            <th>Expediente</th>
                            <th>Ubicacion</th>
                            <th>Fecha de Entrega</th>
                            <th>Estatus</th>
                            <th>Comentarios</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_refacciones as $refaccion)
                            <tr>
                                <td>{{$refaccion->id}}</td>
                                <td>{{$refaccion->fecha_llegada}}</td>
                                <td>{{$refaccion->vehiculo->clientes->nombre??$refaccion->aseguradora??''}}</td>
                                <td>{{$refaccion->descripcion}}</td>
                                <td>{{$refaccion->vehiculo->marcas->marca??$refaccion->marca??''}}</td>
                                <td>{{$refaccion->vehiculo->submarcas->submarca??$refaccion->linea??''}}</td>
                                <td>{{$refaccion->vehiculo->modelo??$refaccion->modelo??''}}</td>
                                <td>{{$refaccion->id_vehiculo}}</td>
                                <td>{{$refaccion->ubicacion}}</td>
                                <td>{{$refaccion->fecha_entrega}}</td>
                                <td>{{$refaccion->estatusA->estatus??''}}</td>
                                <td>{{$refaccion->comentarios}}</td>
                                <td><a href="{{ route('u_refaccion', $refaccion->id) }}" class="btn btn-info"><i class="fa fa-edit" title="Editar"></i></a>
                                    <a href="{{ route('b_refaccion', $refaccion->id) }}" class="btn btn-primary"><i class="fa fa-edit" title="Baja"></i></a>
                                <a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$refaccion->id}}" title="ELiminar"><i class="fa fa-trash"></i></a></td>
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
    <script src="{{ asset('/js/refacciones/refacciones/altaRefacciones/l_refacciones.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_refaccion', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Refaccion</label>
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