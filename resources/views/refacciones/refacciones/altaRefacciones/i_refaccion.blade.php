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
                <h3>Alta de Refacciones</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">No. Expediente</label>
                <input type="text" name="iexpediente" id="iexpediente" class="form-control" required>
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
    <br>
    <form action="/i_refaccion" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Refacciones</h3>
            </div>
        </div>
        <div id="section_refacciones"></div>
        <br>
        <div class="row">
            <div class="d-flex">
                <h3>Refaccion</h3>
                <a class="text-success text-capitalize mx-2 justify-vertical" 
                    role="button" title="Agregar Refaccion" id="add_ref">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i>
                </a>   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="cont" class="form-control" id="cont" required hidden readonly>
                <input type='text' name='expediente' class='form-control' id='iexpediente2' required hidden readonly>
                <input type='text' name='aseguradora' class='form-control' id='aseguradora' required hidden readonly>
            </div>
            <div class="col-md-4">
                <button type='submit' class='btn btn-primary btn-lg btn-block' id='btn_registrar'>Registrar</button>
            </div>
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
                                        <th>Ubicacion</th>
                                        <th>Proceso</th>
                                        <th>Fecha de Llegada</th>
                                        <th>Marca</th>
                                        <th>Linea</th>
                                        <th>Color</th>
                                        <th>Modelo</th>
                                        <th>Placas</th>
                                        <th>Cliente</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @foreach ($vehiculos as $vehiculo)
                                        <tr>
                                            <td>{{$vehiculo->id}}</td>
                                            <td>{{$vehiculo->estatusV->status}}</td>
                                            <td>{{$vehiculo->estatusProceso->estatus}}</td>
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

<div class='refaccion_consecutivo'>
    <div id='refaccion_consecutivo' class='d-flex flex-column'>
        <div class='row'>
            <h3>Refaccion #consecutivo</h3>
            <a role='button'
                class='remove_refaccion text-danger text-capitalize mx-2 pt-3'
                style="margin-top: -18px;" 
                title='Eliminar Refaccion #consecutivo' item_id='consecutivo'>
                <i class='fa fa-minus-circle fa-2x pt-1'></i>
            </a>
        </div>
        <div class='row'>
            <div class='col-md-3'>
                <label for=''>Descripcion</label>
                <input type='text' name='descripcion_consecutivo' id='descripcion_consecutivo' class='form-control' required>
            </div>
            <div class='col-md-3'>
                <label for=''>Proveedor</label>
                <input type='text' name='proveedor_consecutivo' id='proveedor_consecutivo' class='form-control'>
            </div>
            <div class='col-md-3'>
                <label for=''>Fecha Promesa</label>
                <input type='date' name='fechapromesa_consecutivo' id='fechapromesa_consecutivo' class='form-control'>
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
<script src="{{ asset('/js/refacciones/refacciones/altaRefacciones/refacciones.js') }}"></script>
@endsection