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
                    <h3>Proceso Aministrativo</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_proceso" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                                <th>Expediente</th>
                                <th>Ubicacion</th>
                                <th>Proceso</th>
                                <th>Marca</th>
                                <th>Linea</th>
                                <th>Color</th>
                                <th>Modelo</th>
                                <th>Cliente</th>
                                <th>Alta</th>
                                <th>Presupuesto</th>
                                <th>Estatus</th>
                                <th>Valuacion</th>
                                <th>Estatus</th>
                                <th>Proveedores Asignados</th>
                                <th>Estatus</th>
                                <th>Refacciones Disponibles</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                        </thead>
                        <tbody class="text-capitalize">
                            @foreach ($proceso_administrativo as $proceso)
                                <tr>
                                    <td>{{$proceso->id}}</td>
                                    <td>{{$proceso->estatusV->status}}</td>
                                    <td>{{$proceso->estatusProceso->estatus}}</td>
                                    <td>{{$proceso->marcas->marca}}</td>
                                    <td>{{$proceso->submarcas->submarca}}</td>
                                    <td>{{$proceso->color}}</td>
                                    <td>{{$proceso->modelo}}</td>
                                    <td>{{$proceso->clientes->nombre}}</td>
                                    @php
                                        //fecha de llegada simepre es oki
                                        $f_llegada = 0;
                                        //sguie el presupuesto no matyort a dos dias desde que llego saco la dif
                                        $f_llegadaTaller =  date_create($proceso->fecha_llegada);
                                        $f_presupuestoIni = date_create($proceso->fecha_valuacion);
                                        //$dife = date_diff($f_presupuestoIni, $f_llegadaTaller);
                                        $diferencia_alta_presupuesto = date_diff($f_llegadaTaller, $f_presupuestoIni);
                                        $dife1 = $diferencia_alta_presupuesto->{'days'};
                                        //lo de arriba a funcionar siemppre y cuando no sean fechas en nulo
                                        if ($proceso->fecha_valuacion == NULL || $proceso->fecha_valuacion == '0000-00-00') {
                                            $f_v = date_create(date("Y-m-d"));
                                            $dife_valuacion = date_diff($f_llegadaTaller, $f_v);
                                            $dife1 = $dife_valuacion->{'days'};
                                        }
                                        
                                        //saco la diferencia de dias en lo que se tardo en autorizar la valuacion
                                        $f_autorizacion = date_create($proceso->fecha_autorizacion);
                                        $difrencia_presupuesto_autorizacion = date_diff($f_presupuestoIni, $f_autorizacion);
                                        $dife2 = $difrencia_presupuesto_autorizacion->{'days'};
                                        // si el primer lo de fecha de autorizacion es nulo o lo otro poner en automatico el numero 0
                                        if ($proceso->fecha_valuacion == NULL || $proceso->fecha_valuacion == '0000-00-00') {
                                            $dife2 = 0;
                                        } else {
                                            $f_va = date_create(date("Y-m-d"));
                                            $dife_val_autorizada = date_diff($f_presupuestoIni, $f_va);
                                            $dife2 = $dife_val_autorizada->{'days'};
                                        }
                                        //saco la diferencia de la valuacion y de los de los proveedores asigfandos
                                        $f_pasigandos = date_create($proceso->p_asignados);
                                        $diferencia_aprovada_pasignados = date_diff($f_autorizacion, $f_pasigandos);
                                        $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        //si la fecha de autorizacion es vacia o nula que sea 0 o se compare con el numero de dias reales
                                        if ($proceso->fecha_autorizacion == NULL || $proceso->fecha_autorizacion == '0000-00-00') {
                                            $dife3 = 0;
                                        } else {
                                            $f_pasi = date_create(date("Y-m-d"));
                                            $dife_p_asig = date_diff($f_autorizacion, $f_pasi);
                                            $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        }
                                        
                                        //saco la diferencia de las refaccinoes disponibles
                                        $f_rdisponibles = date_create($proceso->r_disponibles);
                                        $diferencia_pasignados_rdisponibles = date_diff($f_pasigandos, $f_rdisponibles);
                                        $dife4 = $diferencia_pasignados_rdisponibles->{'days'};
                                        //si la fecha de de los p asiganods ya ssabes lo demas
                                        if ($proceso->r_disponibles == NULL || $proceso->r_disponibles == '0000-00-00') {
                                            $dife4 = 0;
                                        } else {
                                            $f_rdiso = date_create(date("Y-m-d"));
                                            $dife_rdis = date_diff($f_pasigandos, $f_rdiso);
                                            $dife4 = $dife_rdis->{'days'};
                                        }
                                        
                                        //aqui van los estatus de las valuaciones
                                        if ($proceso->fecha_valuacion == NULL || $proceso->fecha_valuacion == '0000-00-00') {
                                            $estatusFechavaluacion = 'Pendiente';
                                        } else {
                                            $estatusFechavaluacion = 'Autorizado';
                                        }
                                        //
                                        if ($proceso->fecha_autorizacion == NULL || $proceso->fecha_autorizacion == '0000-00-00') {
                                            $estatusFechaautorizacion = 'Pendiente';
                                        } else {
                                            $estatusFechaautorizacion = 'Autorizado';
                                        }
                                        //
                                        if ($proceso->p_asignados == NULL || $proceso->p_asignados == '0000-00-00') {
                                            $estatusFechapasignados = 'Pendiente';
                                        } else {
                                            $estatusFechapasignados = 'Autorizado';
                                        }
                                        //
                                        if ($proceso->r_disponibles == NULL || $proceso->r_disponibles == '0000-00-00') {
                                            $estatusFechardisponibles = 'Pendiente';
                                        } else {
                                            $estatusFechardisponibles = 'Autorizado';
                                        }
                                    @endphp
                                    <td>{{$f_llegada}}</td>
                                    <td>{{$dife1}}</td>
                                    <td>{{$estatusFechavaluacion}}</td>
                                    <td>{{$dife2}}</td>
                                    <td>{{$estatusFechaautorizacion}}</td>
                                    <td>{{$dife3}}</td>
                                    <td>{{$estatusFechapasignados}}</td>
                                    <td>{{$dife4}}</td>
                                    <td>{{$estatusFechardisponibles}}</td>
                                    <td><a href="{{ route('u_valuacionesPA', $proceso->id) }}" class="btn btn-primary" title="Valuaciones"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('u_BrefaccionesPA', $proceso->id) }}" class="btn btn-success" title="Refacciones"><i class="fa fa-edit"></i></a>
                                    </td>
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
    <script src="{{ asset('/js/administracion/procesoAdmistrativo/l_procesoAdministrativo.js') }}"></script>
@endsection