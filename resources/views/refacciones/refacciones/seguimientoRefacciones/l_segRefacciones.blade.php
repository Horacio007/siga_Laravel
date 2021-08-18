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
                    <h3>Listado de Seguimiento de Refacciones</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_segrefacciones" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Expediente</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Modelo</th>
                            <th>Aseguradora</th>
                            <th>Proveedor</th>
                            <th>Descripcion</th>
                            <th>Fecha Promesa</th>
                            <th>Fecha de Llegada</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_refacciones as $refaccion)
                                @if ($refaccion->vehiculo->estatus_id != 7)
                                    @if ($refaccion->estatus_id != 3 OR $refaccion->estatus_id != 4 OR $refaccion->estatus_id != 2)
                                        <tr>
                                            <td>{{$refaccion->id}}</td>
                                            <td>{{$refaccion->vehiculo->id}}</td>
                                            @php
                                                for ($i=0; $i < sizeof($marcas); $i++) { 
                                                    if ($marcas[$i]->id == $refaccion->vehiculo->marca_id) {
                                                        $n_marca = $marcas[$i]->marca;
                                                    }
                                                }

                                                for ($i=0; $i < sizeof($submarcas); $i++) { 
                                                    if ($submarcas[$i]->id == $refaccion->vehiculo->linea_id) {
                                                        $n_submarca = $submarcas[$i]->submarca;
                                                    }
                                                }

                                                for ($i=0; $i < sizeof($aseguradoras); $i++) { 
                                                    if ($aseguradoras[$i]->id == $refaccion->vehiculo->cliente_id) {
                                                        $n_aseguradora = $aseguradoras[$i]->nombre;
                                                    }
                                                }

                                            @endphp
                                            <td>{{$n_marca}}</td>
                                            <td>{{$n_submarca}}</td>
                                            <td>{{$refaccion->vehiculo->modelo}}</td>
                                            <td>{{$n_aseguradora}}</td>
                                            <td>{{$refaccion->proveedor}}</td>
                                            <td>{{$refaccion->descripcion}}</td>
                                            <td>{{$refaccion->fecha_promesa}}</td>
                                            <td>{{$refaccion->fecha_llegada}}</td>
                                            <td><a href="{{ route('u_segrefaccion', $refaccion->id) }}" class="btn btn-info" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$refaccion->id}}" title="ELiminar"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    @endif
                                @endif
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
    <script src="{{ asset('/js/refacciones/refacciones/seguimientoRefacciones/l_segrefacciones.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_segrefaccion', 'delete_item')}}" method="post" id="modal_delete">
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