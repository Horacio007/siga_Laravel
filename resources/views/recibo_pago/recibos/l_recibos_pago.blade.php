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
                    <h3>Listado de Recibos de Pago</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <a href="{{url('/i_recibo_pagos')}}" class="btn btn-info">Registrar</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_areas" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Fecha</th>
                            <th>Expediente</th>
                            <th>Folio</th>
                            <th>Recibi</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Placas</th>
                            <th>Modelo</th>
                            <th>Aseguradora</th>
                            <th>Cantidad</th>
                            <th>Concepto</th>
                            <th>Forma de Pago</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_recibos as $recibos)
                            <tr>
                                <td>{{$recibos->id}}</td>
                                <td>{{$recibos->fecha}}</td>
                                <td>{{$recibos->expedientes->id}}</td>
                                <td>{{$recibos->folio}}</td>
                                <td>{{$recibos->cliente->nombre}}</td>
                                @php
                                    for ($i=0; $i < sizeof($marcas); $i++) { 
                                        if ($marcas[$i]->id == $recibos->expedientes->marca_id) {
                                            $n_marca = $marcas[$i]->marca;
                                        }
                                    }

                                    for ($i=0; $i < sizeof($submarcas); $i++) { 
                                        if ($submarcas[$i]->id == $recibos->expedientes->linea_id) {
                                            $n_submarca = $submarcas[$i]->submarca;
                                        }
                                    }

                                    for ($i=0; $i < sizeof($aseguradoras); $i++) { 
                                        if ($aseguradoras[$i]->id == $recibos->expedientes->cliente_id) {
                                            $n_aseguradora = $aseguradoras[$i]->nombre;
                                        }
                                    }
                                @endphp
                                <td>{{$n_marca}}</td>
                                <td>{{$n_submarca}}</td>
                                <td>{{$recibos->expedientes->color}}</td>
                                <td>{{$recibos->expedientes->modelo}}</td>
                                <td>{{$recibos->expedientes->placas}}</td>
                                <td>{{$n_aseguradora}}</td>
                                <td>{{$recibos->cantidad}}</td>
                                <td>{{$recibos->concepto}}</td>
                                <td>{{$recibos->tipo_pagos->tipo_pago}}</td>
                                <td><a href="{{ route('u_recibo_pagos', $recibos->id)}}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a> 
                                    <a href="{{ route('create_pdfRP', $recibos->id) }}" class="btn btn-info" target='_blank' title="PDF"><i class="fa fa-file-pdf"></i></a>
                                    <a href="" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$recibos->id}}" title="Eliminar"><i class="fa fa-trash"></i></a>
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
    <script src="{{ asset('/js/ingresos/recibo_pagos/l_recibos.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_recibo_pagos', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Recibo</label>
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