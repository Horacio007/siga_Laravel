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
                    <h3>Monitor Tipo Aeropuerto</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md">
                    <table id="list_monitor" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                                <th>Expediente</th>
                                <th>Estatus</th>
                                <th>Marca</th>
                                <th>Linea</th>
                                <th>Color</th>
                                <th>Modelo</th>
                                <th>Placas</th>
                                <th>Cliente</th>
                                <th>Alta</th>
                                <th>Presupuesto</th>
                                <th>Valuacion</th>
                                <th>Proveedores Asignados</th>
                                <th>Refacciones Disponibles</th>
                                <th>Hojalateria</th>
                                <th>Pintura</th>
                                <th>Armado</th>
                                <th>Detallado</th>
                                <th>Mecanica</th>
                                <th>Lavado e Inspeccion</th>
                        </thead>
                        <tbody>
                            @foreach ($monitor as $mon)
                                <tr>
                                    <td>{{$mon->id}}</td>
                                    <td>{{$mon->estatus->status}}</td>
                                    <td>{{$mon->marcas->marca}}</td>
                                    <td>{{$mon->submarcas->submarca}}</td>
                                    <td>{{$mon->color}}</td>
                                    <td>{{$mon->modelo}}</td>
                                    <td>{{$mon->placas}}</td>
                                    <td>{{$mon->clientes->nombre}}</td>
                                    @php
                                        //fecha de llegada simepre es oki
                                        $f_llegada = 0;
                                        //sguie el presupuesto no matyort a dos dias desde que llego saco la dif
                                        $f_llegadaTaller =  date_create($mon->fecha_llegada);
                                        $f_presupuestoIni = date_create($mon->fecha_valuacion);
                                        //$dife = date_diff($f_presupuestoIni, $f_llegadaTaller);
                                        $diferencia_alta_presupuesto = date_diff($f_llegadaTaller, $f_presupuestoIni);
                                        $dife1 = $diferencia_alta_presupuesto->{'days'};
                                        //lo de arriba a funcionar siemppre y cuando no sean fechas en nulo
                                        if ($mon->fecha_valuacion == NULL || $mon->fecha_valuacion == '0000-00-00') {
                                            $f_v = date_create(date("Y-m-d"));
                                            $dife_valuacion = date_diff($f_llegadaTaller, $f_v);
                                            $dife1 = $dife_valuacion->{'days'};
                                        }
                                        
                                        //saco la diferencia de dias en lo que se tardo en autorizar la valuacion
                                        $f_autorizacion = date_create($mon->fecha_autorizacion);
                                        $difrencia_presupuesto_autorizacion = date_diff($f_presupuestoIni, $f_autorizacion);
                                        $dife2 = $difrencia_presupuesto_autorizacion->{'days'};
                                        // si el primer lo de fecha de autorizacion es nulo o lo otro poner en automatico el numero 0
                                        if ($mon->fecha_valuacion == NULL || $mon->fecha_valuacion == '0000-00-00') {
                                            $dife2 = 0;
                                        } else {
                                            $f_va = date_create(date("Y-m-d"));
                                            $dife_val_autorizada = date_diff($f_presupuestoIni, $f_va);
                                            $dife2 = $dife_val_autorizada->{'days'};
                                        }
                                        //saco la diferencia de la valuacion y de los de los proveedores asigfandos
                                        $f_pasigandos = date_create($mon->p_asignados);
                                        $diferencia_aprovada_pasignados = date_diff($f_autorizacion, $f_pasigandos);
                                        $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        //si la fecha de autorizacion es vacia o nula que sea 0 o se compare con el numero de dias reales
                                        if ($mon->fecha_autorizacion == NULL || $mon->fecha_autorizacion == '0000-00-00') {
                                            $dife3 = 0;
                                        } else {
                                            $f_pasi = date_create(date("Y-m-d"));
                                            $dife_p_asig = date_diff($f_autorizacion, $f_pasi);
                                            $dife3 = $diferencia_aprovada_pasignados->{'days'};
                                        }
                                        
                                        //saco la diferencia de las refaccinoes disponibles
                                        $f_rdisponibles = date_create($mon->r_disponibles);
                                        $diferencia_pasignados_rdisponibles = date_diff($f_pasigandos, $f_rdisponibles);
                                        $dife4 = $diferencia_pasignados_rdisponibles->{'days'};
                                        //si la fecha de de los p asiganods ya ssabes lo demas
                                        if ($mon->r_disponibles == NULL || $mon->r_disponibles == '0000-00-00') {
                                            $dife4 = 0;
                                        } else {
                                            $f_rdiso = date_create(date("Y-m-d"));
                                            $dife_rdis = date_diff($f_pasigandos, $f_rdiso);
                                            $dife4 = $dife_rdis->{'days'};
                                        }
                                        // qui agrego el estatus de las altas
                                        $estatusAlta = 'Autorizado';
                                        //aqui van los estatus de las valuaciones
                                        if ($mon->fecha_valuacion == NULL || $mon->fecha_valuacion == '0000-00-00') {
                                            $estatusFechavaluacion = 'Pendiente';
                                        } else {
                                            $estatusFechavaluacion = 'Autorizado';
                                        }
                                        //
                                        if ($mon->fecha_autorizacion == NULL || $mon->fecha_autorizacion == '0000-00-00') {
                                            $estatusFechaautorizacion = 'Pendiente';
                                        } else {
                                            $estatusFechaautorizacion = 'Autorizado';
                                        }
                                        //
                                        if ($mon->p_asignados == NULL || $mon->p_asignados == '0000-00-00') {
                                            $estatusFechapasignados = 'Pendiente';
                                        } else {
                                            $estatusFechapasignados = 'Autorizado';
                                        }
                                        //
                                        if ($mon->r_disponibles == NULL || $mon->r_disponibles == '0000-00-00') {
                                            $estatusFechardisponibles = 'Pendiente';
                                        } else {
                                            $estatusFechardisponibles = 'Autorizado';
                                        }

                                        //ahora saco lo del proceso del taller
                                        if ($mon->aplica_hojalateria == 1) {
                                            if ($mon->fecha_hojalateria == '0000-00-00' || $mon->fecha_hojalateria == null) {
                                                $aplihoja = 'Pendiente' . '/' . $mon->asignado_hojalateria;
                                            } else {
                                                $aplihoja = 'Terminado' . '/' . $mon->asignado_hojalateria;
                                            }
                                        } else {
                                            $aplihoja = 'N/A';
                                        }
                                        /* //aqui quite lo de prepara cion 
                                        if ($mon->getAplica_Preparacion() == 1) {
                                            if ($mon->getFecha_Preparacion() == '0000-00-00') {
                                                $apliprep = 2;
                                            } else {
                                                $apliprep = 1;
                                            }
                                        } else {
                                        $apliprep = 0;
                                        }
                                        */
                                        if ($mon->aplica_pintura == 1) {
                                            if ($mon->fecha_pintura == '0000-00-00' || $mon->aplica_pintura == null) {
                                                $aplipint = 'Pendiente';
                                            } else {
                                                $aplipint = 'Terminado';
                                            }
                                        } else {
                                            $aplipint = 'N/A';
                                        }

                                        if ($mon->aplica_armado == 1) {
                                            if ($mon->fecha_armado == '0000-00-00' || $mon->fecha_armado == null) {
                                                $apliarma = 'Pendiente';
                                            } else {
                                                $apliarma = 'Terminado';
                                            }
                                        } else {
                                            $apliarma = 'N/A';
                                        }

                                        if ($mon->aplica_detallado == 1) {
                                            if ($mon->fecha_detallado == '0000-00-00' || $mon->fecha_detallado == null) {
                                                $aplideta = 'Pendiente';
                                            } else {
                                                $aplideta = 'Terminado';
                                            }
                                        } else {
                                            $aplideta = 'N/A';
                                        }

                                        if ($mon->aplica_mecanica == 1) {
                                            if ($mon->fecha_mecanica == '0000-00-00' || $mon->fecha_mecanica == null) {
                                                $aplimeca = 'Pendiente';
                                            } else {
                                                $aplimeca = 'Terminado';
                                            }
                                        } else {
                                            $aplimeca = 'N/A';
                                        }

                                        if ($mon->aplica_lavado == 1) {
                                            if ($mon->fecha_lavado == '0000-00-00' || $mon->fecha_lavado == null) {
                                                $aplilava = 'Pendiente';
                                            } else {
                                                $aplilava = 'Terminado';
                                            }
                                        } else {
                                            $aplilava = 'N/A';
                                        }
                                    @endphp
                                     <td>{{$estatusAlta}}</td>
                                     <td>{{$estatusFechavaluacion}}</td>
                                     <td>{{$estatusFechaautorizacion}}</td>
                                     <td>{{$estatusFechapasignados}}</td>
                                     <td>{{$estatusFechardisponibles}}</td>
                                     <td>{{$aplihoja}}</td>
                                     <td>{{$aplipint}}</td>
                                     <td>{{$apliarma}}</td>
                                     <td>{{$aplideta}}</td>
                                     <td>{{$aplimeca}}</td>
                                     <td>{{$aplilava}}</td>
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
    <script src="{{ asset('/js/administracion/monitor/monitor.js') }}"></script>
@endsection