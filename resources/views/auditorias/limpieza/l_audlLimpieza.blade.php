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
                    <h3>Listado de Auditorias de Limpieza</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <a href="{{url('/i_audlimpieza')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_audlimpieza" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Oficinas</th>
                            <th>Almacen de Limpieza</th>
                            <th>Almacen de Refacciones</th>
                            <th>Comedor</th>
                            <th>Mecanica</th>
                            <th>Hojalatero 1</th>
                            <th>Hojalatero 2</th>
                            <th>Hojalatero 3</th>
                            <th>Hojalateria</th>
                            <th>Preparacion y Pintura</th>
                            <th>Almacen de Pinturas</th>
                            <th>Pulido, Detallado</th>
                            <th>Lavado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($auditorias as $aud)
                                <tr>
                                    <td>{{$aud->id}}</td>
                                    <td>{{$aud->fecha}}</td>
                                    <td>{{$aud->oficinas}}</td>
                                    <td>{{$aud->al_limpieza}}</td>
                                    <td>{{$aud->al_refacciones}}</td>
                                    <td>{{$aud->comedor}}</td>
                                    <td>{{$aud->mecanica}}</td>
                                    <td>{{$aud->hoja_1}}</td>
                                    <td>{{$aud->hoja_2}}</td>
                                    <td>{{$aud->hoja_3}}</td>
                                    <td>{{$aud->hojalateria}}</td>
                                    <td>{{$aud->prep_pint}}</td>
                                    <td>{{$aud->al_pinturas}}</td>
                                    <td>{{$aud->pul_det_lav}}</td>
                                    <td>{{$aud->lavado}}</td>
                                    <td><a href="{{ route('u_audlimpieza', $aud->id)}}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a> 
                                        <a href="#" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$aud->id}}" title="Eliminar"><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('/js/auditorias/limpieza/limpieza.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_audlimpieza', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Auditorias</label>
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