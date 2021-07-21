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
                                <th>Estatus</th>
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
                        <tbody>
                            @foreach ($proceso_administrativo as $proceso)
                                <tr>
                                    <td>{{$proceso->id}}</td>
                                    @php
                                        //fecha de llegada simepre es oki
                                        $f_llegada = 0;
                                        //sguie el presupuesto no matyort a dos dias desde que llego saco la dif
                                        $f_llegadaTaller =  date_create($value->getFechaLlegada());
                                        $f_presupuestoIni = date_create($value->getFechaValuacion());
                                        //$dife = date_diff($f_presupuestoIni, $f_llegadaTaller);
                                        $diferencia_alta_presupuesto = date_diff($f_llegadaTaller, $f_presupuestoIni);
                                        $dife1 = $diferencia_alta_presupuesto->{'days'};
                                        //lo de arriba a funcionar siemppre y cuando no sean fechas en nulo
                                        if ($value->getFechaValuacion() == NULL || $value->getFechaValuacion() == '0000-00-00') {
                                            $f_v = date_create(date("Y-m-d"));
                                            $dife_valuacion = date_diff($f_llegadaTaller, $f_v);
                                            $dife1 = $dife_valuacion->{'days'};
                                        }
                                        
                                        //saco la diferencia de dias en lo que se tardo en autorizar la valuacion
                                        $f_autorizacion = date_create($value->getFechaAutorizacion());
                                        $difrencia_presupuesto_autorizacion = date_diff($f_presupuestoIni, $f_autorizacion);
                                        $dife2 = $difrencia_presupuesto_autorizacion->{'days'};
                                        // si el primer lo de fecha de autorizacion es nulo o lo otro poner en automatico el numero 0
                                        if ($value->getFechaValuacion() == NULL || $value->getFechaValuacion() == '0000-00-00') {
                                            $dife2 = 0;
                                        } else {
                                            $f_va = date_create(date("Y-m-d"));
                                            $dife_val_autorizada = date_diff($f_presupuestoIni, $f_va);
                                            $dife2 = $dife_val_autorizada->{'days'};
                                        }
                                        //saco la diferencia de la valuacion y de los de los proveedores asigfandos
                                        $f_pasigandos = date_create($value->getPasignados());
                                        $diferencia_aprovada_pasignados = date_diff($f_autorizacion, $f_pasigandos);
                                        $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        //si la fecha de autorizacion es vacia o nula que sea 0 o se compare con el numero de dias reales
                                        if ($value->getFechaAutorizacion() == NULL || $value->getFechaAutorizacion() == '0000-00-00') {
                                            $dife3 = 0;
                                        } else {
                                            $f_pasi = date_create(date("Y-m-d"));
                                            $dife_p_asig = date_diff($f_autorizacion, $f_pasi);
                                            $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        }
                                        
                                        //saco la diferencia de las refaccinoes disponibles
                                        $f_rdisponibles = date_create($value->getRdisponibles());
                                        $diferencia_pasignados_rdisponibles = date_diff($f_pasigandos, $f_rdisponibles);
                                        $dife4 = $diferencia_pasignados_rdisponibles->{'days'};
                                        //si la fecha de de los p asiganods ya ssabes lo demas
                                        if ($value->getPasignados() == NULL || $value->getPasignados() == '0000-00-00') {
                                            $dife4 = 0;
                                        } else {
                                            $f_rdiso = date_create(date("Y-m-d"));
                                            $dife_rdis = date_diff($f_pasigandos, $f_rdiso);
                                            $dife4 = $dife_rdis->{'days'};
                                        }
                                        
                                        //aqui van los estatus de las valuaciones
                                        if ($value->getFechaValuacion() == NULL || $value->getFechaValuacion() == '0000-00-00') {
                                            $estatusFechavaluacion = 'Pendiente';
                                        } else {
                                            $estatusFechavaluacion = 'Autorizado';
                                        }
                                        //
                                        if ($value->getFechaAutorizacion() == NULL || $value->getFechaAutorizacion() == '0000-00-00') {
                                            $estatusFechaautorizacion = 'Pendiente';
                                        } else {
                                            $estatusFechaautorizacion = 'Autorizado';
                                        }
                                        //
                                        if ($value->getPasignados() == NULL || $value->getPasignados() == '0000-00-00') {
                                            $estatusFechapasignados = 'Pendiente';
                                        } else {
                                            $estatusFechapasignados = 'Autorizado';
                                        }
                                        //
                                        if ($value->getRdisponibles() == NULL || $value->getRdisponibles() == '0000-00-00') {
                                            $estatusFechardisponibles = 'Pendiente';
                                        } else {
                                            $estatusFechardisponibles = 'Autorizado';
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
                                    <td>{{$val->clientes->nombre}}</td>
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