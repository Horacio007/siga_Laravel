@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="" id="formdataa">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar Facturas</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="lexpediente">No. Expediente</label>
                    <input type="text" class="form-control" id="iexpediente">
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="button" class="btn btn-info btn-lg btn-block" id="btn_buscar">Buscar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
        <br>
        <form action="/i_facturas" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="">Marca</label>
                    <input type="text" id="marca" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Linea</label>
                    <input type="text" id="linea" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Color</label>
                    <input type="text" name="color" id="color" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Placas</label>
                    <input type="text" name="placas" id="placas" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Cliente</label>
                    <input type="text" name="cliente" id="cliente" class="form-control" disabled readonly required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha de Facturacíon</label>
                    <input type="date" name="fechaf" id="fechaf" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Estatus Aseguradora</label>
                    <select name="sestatus" id="sestatus" class="form-control" required>
                       <option value="0">Selecciona el estatus</option>
                        @foreach ($estausF as $estatus)
                            <option value="{{$estatus->id}}">{{$estatus->estatus}}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha BBVA</label>
                    <input type="date" name="fbbva" id="fbbva" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="">Comentarios</label>
                    <input type="text" name="comentarios" id="comentarios" class="form-control" placeholder="Agrega un comentario..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="iexpediente2" id="iexpediente2" hidden readonly required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_facturas" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th class="scope">Expediente</th>
                            <th>Estatus</th>
                            <th>Fecha Salida Taller</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Placas</th>
                            <th>Cliente</th>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{$vehiculo->id}}</td>
                                    <td>{{$vehiculo->estatus->status}}</td>
                                    <td>{{$vehiculo->fecha_salida_taller}}</td>
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
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/js/ingresos/facturas/i_facturas.js') }}"></script>
@endsection