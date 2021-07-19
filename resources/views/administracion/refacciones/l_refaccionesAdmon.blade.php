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
                    <h3>Listado de Estatus de Refacciones</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_refacciones" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th>Expediente</th>
                            <th>Estatus</th>
                            <th>Dias Reparacion</th>
                            <th>Marca</th>
                            <th>Linea</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Cliente</th>
                            <th>Refacciones</th>
                            <th>Fecha Autorizacion</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($refacciones as $ref)
                                <tr>
                                    <td>{{$ref->id}}</td>
                                    @php
                                        //comienzo a sacar el nuevo estatus
                                        $f_llegada_t = date_create($ref->fecha_llegada);
                                        $fecha_aa = date_create(date("Y-m-d"));
                                        $diferencia_tr = date_diff($f_llegada_t, $fecha_aa);
                                        $dif_trans = $diferencia_tr->{'days'};
                                        //saco la diferencia de los dias en el taller
                                        $f_llegada_taller = date_create($ref->fecha_llegada_taller);
                                        $fecha_aaa = date_create(date("Y-m-d"));
                                        $diferencia_taller = date_diff($f_llegada_taller, $fecha_aaa);
                                        $dif_taller = $diferencia_taller->{'days'};

                                        switch ($ref->estatus_id) {
                                            case 5:
                                                $estatus = "Taller/".$dif_taller;
                                                break;

                                            case 6:
                                                $estatus = "Transito/".$dif_trans;
                                                break;

                                            case 7:
                                                $estatus = "PT";
                                                break;
                                            
                                            default:
                                                $estatus = "Sin estatus";
                                                break;
                                        }
                                    @endphp
                                    <td>{{$estatus}}</td>
                                    <td>{{$ref->fecha_promesa}}</td>
                                    <td>{{$ref->marcas->marca}}</td>
                                    <td>{{$ref->submarcas->submarca}}</td>
                                    <td>{{$ref->color}}</td>
                                    <td>{{$ref->modelo}}</td>
                                    <td>{{$ref->clientes->nombre}}</td>
                                    <td>{{$ref->estatusRefacciones->estatus}}</td>
                                    <td>{{$ref->fecha_llegada_taller}}</td>
                                    <td><a href="{{ route('u_Brefacciones', $ref->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
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
    <script src="{{ asset('/js/administracion/refacciones/l_refaccionesAdmon.js') }}"></script>
@endsection