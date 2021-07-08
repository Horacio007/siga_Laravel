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
                    <h3>Historico de Clientes</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <table id="list_clientes" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">Expediente</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Modelo</th>
                            <th>Aseguradora</th>
                            <th>No. Siniestro</th>
                            <th>Fecha Llegada</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Fecha Salida</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_clientes as $cliente)
                            <tr>
                                <td>{{$cliente->id}}</td>
                                <td>{{$cliente->marca}}</td>
                                <td>{{$cliente->submarca}}</td>
                                <td>{{$cliente->modelo}}</td>
                                <td>{{$cliente->aseguradora}}</td>
                                <td>{{$cliente->no_siniestro}}</td>
                                <td>{{$cliente->fecha_llegada}}</td>
                                <td>{{$cliente->nombre}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->correo}}</td>
                                <td>{{$cliente->fecha_salida_taller}}</td>
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
    <script src="{{ asset('/js/entrega/clientes/l_clientes.js') }}"></script>
@endsection