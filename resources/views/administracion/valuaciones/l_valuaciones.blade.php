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
                    <h3>Listado Valuaciones</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_valuaciones" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                                <th>Expediente</th>
                                <th>Estatus</th>
                                <th>Dias Reparacion</th>
                                <th>Nivel de Daño</th>
                                <th>Forma Arribo</th>
                                <th>Fecha de Llegada</th>
                                <th>Fecha de Llegada a Taller</th>
                                <th>Marca</th>
                                <th>Linea</th>
                                <th>Color</th>
                                <th>Modelo</th>
                                <th>Placas</th>
                                <th>Cliente</th>
                                <th>No. Siniestro/Reporte</th>
                                <th>Fecha de Envio</th>
                                <th>Diferencia</th>
                                <th>Cantidad</th>
                                <th>Piezas Cambiadas</th>
                                <th>Piezas Reparacion</th>
                                <th>Autorizacion</th>
                                <th>Cantidad</th>
                                <th>Piezas Cambiadas</th>
                                <th>Piezas Reparacion</th>
                                <th>Piezas Vendidas</th>
                                <th>Importe de Piezas</th>
                                <th>Porcentaje Reparacion</th>
                                <th>Porcentaje Aprobacion</th>
                                <th>Deducible</th>
                                <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($valuaciones as $val)
                                <tr>
                                    <td>{{$val->id}}</td>
                                    @php
                                        if ($val->fecha_autorizacion == "" || $val->fecha_autorizacion == " " || $val->fecha_autorizacion == NULL || $val->fecha_autorizacion == null) {
                                            //$fecha_ll = new DateTime($value->getFechaLlegada());
                                            $fecha_ll = date_create($val->fecha_llegada);
                                            $fecha_a = date_create(date("Y-m-d"));
                                            //$now = new DateTime('now');
                                            $dife = date_diff($fecha_ll, $fecha_a);
                                            //$dife = json_encode($dife);
                                            //$dife = json_decode($dife);
                                            //$dife = $fecha_ll->diff($now)->format('%d');
                                            $difee = $dife->{'days'};
                                        } else {
                                            $difee = $val->diferencia_tres_dias;
                                        }

                                        //le agrego lo del porcentaje de reparacion
                                        if ($val->porcentaje_aprobacion == 0.00) {
                                            $porcetaje = 0.00;
                                        } else {
                                            $porcetaje = round(($val->cantidad_final*100)/$val->cantidad_inicial, 2);
                                        }
                                        
                                        //comienzo a sacar el nuevo estatus
                                        $f_llegada_t = date_create($val->fecha_llegada);
                                        $fecha_aa = date_create(date("Y-m-d"));
                                        $diferencia_tr = date_diff($f_llegada_t, $fecha_aa);
                                        $dif_trans = $diferencia_tr->{'days'};
                                        //saco la diferencia de los dias en el taller
                                        $f_llegada_taller = date_create($val->fecha_llegada_taller);
                                        $fecha_aaa = date_create(date("Y-m-d"));
                                        $diferencia_taller = date_diff($f_llegada_taller, $fecha_aaa);
                                        $dif_taller = $diferencia_taller->{'days'};

                                        switch ($val->estatus_id) {
                                            case 5:
                                                $estatus = "Taller/".$dif_taller;
                                                break;

                                            case 6:
                                                $estatus = "Transito/".$dif_trans;
                                                break;

                                            case 9:
                                                $estatus = "Orden De Admicion/".$dif_trans;
                                                break;
                                            
                                            default:
                                                $estatus = "Sin estatus";
                                                break;
                                        }

                                        $suma = intval($val->piezas_cambiadas_final + $val->piezas_reparacion_final);
                                        if (intval($val->piezas_reparacion_final) > 0) {
                                            $res = round(((intval($val->piezas_reparacion_final*100)/$suma)),2);
                                        } else {
                                            $res = 0;
                                        }
                                    @endphp
                                    <td>{{$estatus}}</td>
                                    <td>{{$val->fecha_promesa}}</td>
                                    <td>{{$val->nivelDano->nivel}}</td>
                                    <td>{{$val->formaArribo->forma_arribo}}</td>
                                    <td>{{$val->fecha_llegada}}</td>
                                    <td>{{$val->fecha_llegada_taller}}</td>
                                    <td>{{$val->marcas->marca}}</td>
                                    <td>{{$val->submarcas->submarca}}</td>
                                    <td>{{$val->color}}</td>
                                    <td>{{$val->modelo}}</td>
                                    <td>{{$val->placas}}</td>
                                    <td>{{$val->clientes->nombre??''}}</td>
                                    <td>{{$val->no_siniestro}}</td>
                                    <td>{{$val->fecha_valuacion}}</td>
                                    <td>{{$difee}}</td>
                                    <td>{{$val->cantidad_inicial}}</td>
                                    <td>{{$val->piezas_cambiadas_inicial}}</td>
                                    <td>{{$val->piezas_reparacion_inicial}}</td>
                                    <td>{{$val->fecha_autorizacion}}</td>
                                    <td>{{$val->cantidad_final}}</td>
                                    <td>{{$val->piezas_cambiadas_final}}</td>
                                    <td>{{$val->piezas_reparacion_final}}</td>
                                    <td>{{$val->piezas_vendidas}}</td>
                                    <td>{{$val->importe_piezas_vendidas}}</td>
                                    <td>{{$res}}</td>
                                    <td>{{$porcetaje}}</td>
                                    <td>{{$val->proceso}}</td>
                                    <td><a href="{{ route('u_valuaciones', $val->id) }}" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a></td>
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
    <script src="{{ asset('/js/administracion/valuaciones/l_valuaciones.js') }}"></script>
@endsection