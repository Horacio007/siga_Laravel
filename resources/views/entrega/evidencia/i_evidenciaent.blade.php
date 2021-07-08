@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" enctype="multipart/form-data" method="post" id="formdata">
            <div class="row">
                <div class="col text-center">
                    <h3>Subir Evidencia de la Entrega del Vehiculo</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="lexpediente">No. Expediente</label>
                    <input type="text" name="expediente" id="iexpediente" class="form-control" required>
                </div>
                <div class="col-md-4"></div>
            </div> 
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="lexpediente">Archivos</label>
                    <input type="file" name ="izip[]" id="izip" class="form-control" multiple required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="wrapper" style="display: none">
                        <div class="progress progress_wrapper">
                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progress_bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_subir">Subir</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_vehiculo" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">Expediente</th>
                            <th>Estatus</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                            <th>No. Siniestro/Reporte</th>
                        </thead>
                        <tbody class="">
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{$vehiculo->id}}</td>
                                    <td>{{$vehiculo->estatus->status}}</td>
                                    <td>{{$vehiculo->marcas->marca}}</td>
                                    <td>{{$vehiculo->submarcas->submarca}}</td>
                                    <td>{{$vehiculo->color}}</td>
                                    <td>{{$vehiculo->modelo}}</td>
                                    <td>{{$vehiculo->placas}}</td>
                                    <td>{{$vehiculo->clientes->nombre}}</td>
                                    <td>{{$vehiculo->no_siniestro}}</td>
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
    <script src="{{ asset('/js/entrega/evidencia/i_evidenciaent.js') }}"></script>
@endsection