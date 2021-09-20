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
                    <h3>Proceso Aministrativo</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_proceso" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                                <th>Expediente</th>
                                <th>Estatus</th>
                                <th>Marca</th>
                                <th>Linea</th>
                                <th>Color</th>
                                <th>Modelo</th>
                                <th>Cliente</th>
                                <th>Fecha Promesa</th>
                                <th>Hojalateria</th>
                                <th>Pintura</th>
                                <th>Armado</th>
                                <th>Detallado</th>
                                <th>Mecanica</th>
                                <th>Lavado e Inspeccion</th>
                                <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($proceso_taller as $proceso)
                                <tr>
                                    <td>{{$proceso->id}}</td>
                                    <td>{{$proceso->estatus->status}}</td>
                                    <td>{{$proceso->marcas->marca}}</td>
                                    <td>{{$proceso->submarcas->submarca}}</td>
                                    <td>{{$proceso->color}}</td>
                                    <td>{{$proceso->modelo}}</td>
                                    <td>{{$proceso->clientes->nombre}}</td>
                                    <td>{{$proceso->fecha_entrega_interna}}</td>
                                    @php
                                        if ($proceso->aplica_hojalateria == 1) {
                                            if ($proceso->fecha_hojalateria == '0000-00-00' || $proceso->fecha_hojalateria == null) {
                                                $aplihoja = 2 . '/' . $proceso->asignado_hojalateria;
                                            } else {
                                                $aplihoja = 1 . '/' . $proceso->asignado_hojalateria;
                                            }
                                        } else {
                                            $aplihoja = 0;
                                        }
                                        /* //aqui quite lo de prepara cion 
                                        if ($proceso->getAplica_Preparacion() == 1) {
                                            if ($proceso->getFecha_Preparacion() == '0000-00-00') {
                                                $apliprep = 2;
                                            } else {
                                                $apliprep = 1;
                                            }
                                        } else {
                                        $apliprep = 0;
                                        }
                                        */
                                        if ($proceso->aplica_pintura == 1) {
                                            if ($proceso->fecha_pintura == '0000-00-00' || $proceso->aplica_pintura == null || $proceso->fecha_pintura == null) {
                                                $aplipint = 2;
                                            } else {
                                                $aplipint = 1;
                                            }
                                        } else {
                                        $aplipint = 0;
                                        }

                                        if ($proceso->aplica_armado == 1) {
                                            if ($proceso->fecha_armado == '0000-00-00' || $proceso->fecha_armado == null) {
                                                $apliarma = 2;
                                            } else {
                                                $apliarma = 1;
                                            }
                                        } else {
                                        $apliarma = 0;
                                        }

                                        if ($proceso->aplica_detallado == 1) {
                                            if ($proceso->fecha_detallado == '0000-00-00' || $proceso->fecha_detallado == null) {
                                                $aplideta = 2;
                                            } else {
                                                $aplideta = 1;
                                            }
                                        } else {
                                        $aplideta = 0;
                                        }

                                        if ($proceso->aplica_mecanica == 1) {
                                            if ($proceso->fecha_mecanica == '0000-00-00' || $proceso->fecha_mecanica == null) {
                                                $aplimeca = 2;
                                            } else {
                                                $aplimeca = 1;
                                            }
                                        } else {
                                        $aplimeca = 0;
                                        }

                                        if ($proceso->aplica_lavado == 1) {
                                            if ($proceso->fecha_lavado == '0000-00-00' || $proceso->fecha_lavado == null) {
                                                $aplilava = 2;
                                            } else {
                                                $aplilava = 1;
                                            }
                                        } else {
                                        $aplilava = 0;
                                        }
                                    @endphp
                                    <td>{{$aplihoja}}</td>
                                    <td>{{$aplipint}}</td>
                                    <td>{{$apliarma}}</td>
                                    <td>{{$aplideta}}</td>
                                    <td>{{$aplimeca}}</td>
                                    <td>{{$aplilava}}</td>
                                    <td>
                                        <a href="{{ route('u_asignacionPersonalPT', $proceso->id) }}" class="btn btn-primary" title="Actualizar"><i class="fa fa-edit"></i></a>
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
    <script src="{{ asset('/js/administracion/procesoTaller/l_procesoTaller.js') }}"></script>
@endsection