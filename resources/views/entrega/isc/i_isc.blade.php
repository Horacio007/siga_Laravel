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
                <h3>Alta de Indice de Satisfacción del Cliente</h3>
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
    <form action="/i_isc" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="">Cliente</label>
                <input type="text" id="icliente" class="form-control" readonly required>
            </div>
            <div class="col-md-4">
                <label for="">Atendio</label>
                <input type="text" id="iatendio" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="">Fecha</label>
                <input type="date" name="ifecha" id="ifecha" class="form-control" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">1.- ¿Como considera el nivel de nuestras instalaciones?</label>
                <select name="pr1" id="pr1" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Buena</option>
                    <option value="2">Regular</option>
                    <option value="3">Mala</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">2.- ¿La atencion recibida por nuestro personal es adecuada?</label>
                <select name="pr2" id="pr2" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Buena</option>
                    <option value="2">Regular</option>
                    <option value="3">Mala</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">3.- ¿Se dio solucion inmediata a alguna anomalia o queja?</label>
                <select name="pr3" id="pr3" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">4.- ¿Como considera la calidad del trabajo de la reparacion de su vehiculo?</label>
                <select name="pr4" id="pr4" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Excelente</option>
                    <option value="2">Buena</option>
                    <option value="3">Mala</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">5.- ¿Se le comunico oportunamente el estatus de la reparacion?</label>
                <select name="pr5" id="pr5" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">6.- ¿En base al servicio total recibido, recomendaria nuestro taller?</label>
                <select name="pr7" id="pr7" class="form-control" required>
                    <option value="0">Selecciona una respuesta</option>
                    <option value="1">Si</option>
                    <option value="2">Tal Vez</option>
                    <option value="3">No</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btn_registrar">Registrar</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col text-center">
                <h3>Listado de Vehiculos Entregados</h3>
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
<script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/libs/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/js/entrega/isc/isc.js') }}"></script>
@endsection