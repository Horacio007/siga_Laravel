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
                    <h3>Formatos</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table id="list_archivos" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($list_archivos as $archivo)
                            <tr>
                                <td>{{$j}}</td>
                                <td>{{explode('/', $archivo)[2]}}</td>
                                @php
                                    $r = array('name' => explode('/', $archivo)[2]);
                                @endphp
                                <td><a href="{{route('verformatos', $r)}}" class="btn btn-primary" title="Ver" target="_blank"><i class="fa fa-eye"></i></a></td>
                                @php
                                    $j++;
                                @endphp
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
    <script src="{{ asset('/js/formatos/formatos/formatos.js') }}"></script>
@endsection