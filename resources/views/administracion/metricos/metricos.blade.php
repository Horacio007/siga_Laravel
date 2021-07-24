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
                    <h3>Metricos</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <h3>Vehiculos Entregados y Recibidos por Mes</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Entregados por Mes</h3>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body" id="panel">
                                    <div class="table-responsive">
                                        <table id="list_ventregados" class="table table-striped table-bordered" border="0">
                                            <thead class="text-capitalize">
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < sizeof($tabla_VEntregados); $i++)
                                                <tr>
                                                    <td>{{$tabla_VEntregados[$i]['compania']}}</td>
                                                    <td>{{$tabla_VEntregados[$i]['total']}}</td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Recibidos por Mes</h3>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body" id="panel">
                                    <div class="table-responsive">
                                        <table id="list_vrecibidos" class="table table-striped table-bordered" border="0">
                                            <thead class="text-capitalize">
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < sizeof($tabla_VRecibidos); $i++)
                                                <tr>
                                                    <td>{{$tabla_VRecibidos[$i]['compania']}}</td>
                                                    <td>{{$tabla_VRecibidos[$i]['total']}}</td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Entregados por Mes</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="vem"></div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Recibidos por Mes</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="rem"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <h3>Vehiculos Entregados y Recibidos Segun la fecha elegida</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control" id="ifecha">
                </div>
                <div class="col-md-3">
                    <label for=""></label>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_buscar">Crear</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Entregados</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="vemselect"></div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Vehiculos Recibidos</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="remselect"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <h3>Vehiculos Entregados y Recibidos en las Ultimas 10 Semanas</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                        <h3>Vehiculos Entregados</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body" id="panel">
                                        <div class="table-responsive">
                                            <table id="list_ventregados10" class="table table-striped table-bordered" border="0">
                                                <thead class="text-capitalize">
                                                    <tr>
                                                        <th>Cliente</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < sizeof($tabla_VEntregados10sem[0]); $i++)
                                                        <tr>
                                                            <td>{{$tabla_VEntregados10sem[0][$i]}}</td>
                                                            <td>{{$tabla_VEntregados10sem[1][$i]}}</td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <h3>Vehiculos Recibidos</h3>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body" id="panel">
                                        <div class="table-responsive">
                                            <table id="list_vrecibidos10" class="table table-striped table-bordered" border="0">
                                                <thead class="text-capitalize">
                                                    <tr>
                                                        <th>Cliente</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < sizeof($tabla_VRecibidos10sem[0]); $i++)
                                                        <tr>
                                                            <td>{{$tabla_VRecibidos10sem[0][$i]}}</td>
                                                            <td>{{$tabla_VRecibidos10sem[1][$i]}}</td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md text-center">
                    <h3>Vehiculos Entregados en las Ultimas 10 Semanas</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="diesem"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md text-center">
                    <h3>Vehiculos Recibidos en las Ultimas 10 Semanas</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="diesreci"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <h3>Indice de Satisfacción del Cliente</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>ISC por semana</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="iscsem"></div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Total ISC por Semana</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="isctotal"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col text-center">
                    <h3>Auditorias de Limpieza</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>Promedio de cada Area del mes Anterior</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="promareanterior"></div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Promedio de cada Area del mes Actual</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="promareactual"></div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h3>Promedio de cada Area del mes Anterior por Empleado</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="promareanteriorempleado"></div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <h3>Promedio de cada Area del mes Actual por Empleado</h3>
                    <br>
                    <div class="row">
                        <div class="col" id="promareactualempleado"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('/libs/ploty/plotly-2.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libs/DataTables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/js/administracion/metricos/metricos.js') }}"></script>
@endsection