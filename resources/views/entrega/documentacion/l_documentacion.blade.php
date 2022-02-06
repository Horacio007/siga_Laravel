@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" enctype="multipart/form-data" method="post" id="formdata">
            <div class="row">
                <div class="col text-center">
                    <h3>Documentación</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_vehiculo" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">Expediente</th>
                            <th>Ubicacion</th>
                            <th>Proceso</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>No. Siniestro/Reporte</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{$vehiculo->id}}</td>
                                    <td>{{$vehiculo->estatusV->status}}</td>
                                    <td>{{$vehiculo->estatusProceso->estatus}}</td>
                                    <td>{{$vehiculo->marcas->marca}}</td>
                                    <td>{{$vehiculo->submarcas->submarca}}</td>
                                    <td>{{$vehiculo->color}}</td>
                                    <td>{{$vehiculo->modelo}}</td>
                                    <td>{{$vehiculo->placas}}</td>
                                    <td>{{$vehiculo->clientes->nombre}}</td>
                                    <td>{{$vehiculo->no_siniestro}}</td>
                                    <td><a href="{{ route('create_pdfentrega', $vehiculo->id_aux) }}" class="btn btn-info" target='_blank' title="PDF"><i class="fa fa-file-pdf"></i></a></td>
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
    <script src="{{ asset('/js/entrega/documentacion/l_documentacion.js') }}"></script>
@endsection