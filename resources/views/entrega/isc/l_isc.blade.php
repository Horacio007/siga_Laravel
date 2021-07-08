@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" enctype="multipart/form-data" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Listado Indice de Satisfacción del Cliente</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <a href="{{url('/i_ics')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_isc" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">Expediente</th>
                            <th>Cliente</th>
                            <th>Atendio</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Pregunta 1</th>
                            <th>Pregunta 2</th>
                            <th>Pregunta 3</th>
                            <th>Pregunta 4</th>
                            <th>Pregunta 5</th>
                            <th>Pregunta 6</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($encuestas as $encuesta)
                                <tr>
                                    <td>{{$encuesta->id_vehiculo}}</td>
                                    <td>{{$encuesta->id_cliente}}</td>
                                    <td>{{$encuesta->atendio}}</td>
                                    <td>{{$encuesta->marca}}</td>
                                    <td>{{$encuesta->submarca}}</td>
                                    <td>{{$encuesta->color}}</td>
                                    <td>{{$encuesta->modelo}}</td>
                                    <td>{{$encuesta->placas}}</td>
                                    <td>{{$encuesta->aseguradora}}</td>
                                    <td>{{$encuesta->fecha}}</td>
                                    <td>{{$encuesta->p1}}</td>
                                    <td>{{$encuesta->p2}}</td>
                                    <td>{{$encuesta->p3}}</td>
                                    <td>{{$encuesta->p4}}</td>
                                    <td>{{$encuesta->p5}}</td>
                                    <td>{{$encuesta->p7}}</td>
                                    <td>{{$encuesta->total}}</td>
                                    <td><a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$encuesta->id}}" title="Eliminar"><i class="fa fa-trash"></i></a></td>
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
    <script src="{{ asset('/js/entrega/isc/l_isc.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_ics', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Encuesta</label>
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