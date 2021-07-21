@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <style>
        .btn-warning {
            background-color: #FFF890 !important;
            border: #FFF890 !important;
        }
    </style>
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Listado de Asignacion de Personal y Seguimiento del Taller</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_asig" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th>Expediente</th>
                            <th>Estatus</th>
                            <th>Fecha Llegada Taller</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>Personal</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($asignacion_personal as $personal)
                                <tr>
                                    <td>{{$personal->id}}</td>
                                    <td>{{$personal->estatus->status}}</td>
                                    <td>{{$personal->fecha_llegada_taller}}</td>
                                    <td>{{$personal->marcas->marca}}</td>
                                    <td>{{$personal->submarcas->submarca}}</td>
                                    <td>{{$personal->color}}</td>
                                    <td>{{$personal->modelo}}</td>
                                    <td>{{$personal->placas}}</td>
                                    <td>{{$personal->clientes->nombre}}</td>
                                    @if ($personal->aplica_lavado == 1)
                                        <td>Asignado</td>
                                    @else
                                    <td>No Asignado</td>
                                    @endif
                                    <td><a href="{{ route('i_asignacionPersonal', $personal->id) }}" class="btn btn-primary" title="Asignar"><i class="fa fa-edit"></i></a>
                                        @if ($personal->aplica_lavado == 1)
                                            <a href="{{ route('u_asignacionPersonal', $personal->id) }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></a>
                                        @else
                                            <a href="#" class="btn btn-warning" style="pointer-events: none; display: inline-block;" title="Editar"><i class="fa fa-edit"></i></a>
                                        @endif
                                        
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
    <script src="{{ asset('/js/administracion/asignacionPersonal/l_asignacionPersonal.js') }}"></script>
@endsection