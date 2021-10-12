@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
<div class="container-fluid">
    <form action="" method="post" id="formdataa">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Alta de Ordenes Mecanica</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">No. Expediente</label>
                <input type="text" name="expediente" id="iexpediente" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_buscar">Buscar</button>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <div id="inf" class="text-center">
                    <label for="" id="info"></label>
                </div>
            </div>
        </div>
    </form>
    <form action="" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Reparaciones</h3>
            </div>
        </div>
        <br>
        <div id="section_diagnostico"></div>
        <br>
        <div class="row">
            <div class="d-flex">
                <h3>Diagnostico</h3>
                <a class="text-success text-capitalize mx-2 justify-vertical" 
                    role="button" title="Agregar Diagnostico" id="add_rep">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i>
                </a>   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="cont" class="form-control" id="cont" required hidden readonly>
                <input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_crear">Crear</button></div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body" id="panel">
                        <div class="table-responsive">
                            <table id="list_vehiculo" class="table table-striped table-bordered" border="0">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th>Expediente</th>
                                        <th>Estatus</th>
                                        <th>Fecha de Llegada</th>
                                        <th>Marca</th>
                                        <th>Linea</th>
                                        <th>Color</th>
                                        <th>Modelo</th>
                                        <th>Placas</th>
                                        <th>Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehiculos as $vehiculo)
                                        <tr>
                                            <td>{{$vehiculo->id}}</td>
                                            <td>{{$vehiculo->estatus->status}}</td>
                                            <td>{{$vehiculo->fecha_llegada}}</td>
                                            <td>{{$vehiculo->marcas->marca}}</td>
                                            <td>{{$vehiculo->submarcas->submarca}}</td>
                                            <td>{{$vehiculo->color}}</td>
                                            <td>{{$vehiculo->modelo}}</td>
                                            <td>{{$vehiculo->placas}}</td>
                                            <td>{{$vehiculo->clientes->nombre}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- -->
<div class='diagnostico_consecutivo'>
    <div id='diagnostico_consecutivo' class='d-flex flex-column'>
        <div class='row'>
            <h3>Diagnostico #consecutivo</h3>
            <a role='button'
                class='remove_diagnostico text-danger text-capitalize mx-2 pt-3'
                style="margin-top: -18px;" 
                title='Eliminar Diagnostico #consecutivo' item_id='consecutivo'>
                <i class='fa fa-minus-circle fa-2x pt-1'></i>
            </a>
        </div>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-8'>
                <label for='lreparacion'>Diagnostico</label>
                <input type='text' name='diagnostico_consecutivo' id='idiagnostico_consecutivo' class='form-control'>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/js/taller/ordenesMecanica/ordenesMecanica.js') }}"></script>
<script src="{{ asset('/libs/jsPDF/jspdf.debug.js') }}"></script>
@endsection