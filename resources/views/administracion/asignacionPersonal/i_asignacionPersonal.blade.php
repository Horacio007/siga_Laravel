@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="/css/administracion/asignacionPersonal/asignacion_personal.css">
    <div class="container-fluid">
        <form action="{{route('i_asignacionPersonal', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Asignar Personal</h3>
                </div>
            </div>
            <br>
            <div class='row'>
                <div class="col-md-2">
                    <table class="table" id="tablaHoja">
                        <thead>
                            <tr>
                                <th scope="row"><center>Hojalateria</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaHoja" value="aplicaHoja" id="aplicaHoja" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechahoja" id="fechahoja" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalH" id="personalH">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 1)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosHoja" id="comentariosHoja" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <table class="table" id="tablapintura">
                        <thead>
                            <tr>
                                <th scope="row"><center>Pintura</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaPin" value="aplicaPin" id="aplicaPin" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechaPin" id="fechaPin" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalPin" id="personalPin">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 3)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosPin" id="comentariosPin" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <table class="table" id="tablaarmado">
                        <thead>
                            <tr>
                                <th scope="row"><center>Armado</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaArm" value="aplicaArm" id="aplicaArm" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechaArm" id="fechaArm" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalArm" id="personalArm">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 4)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosArm" id="comentariosArm" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <table class="table" id="tabladetallado">
                        <thead>
                            <tr>
                                <th scope="row"><center>Detallado</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaDet" value="aplicaDet" id="aplicaDet" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechaDet" id="fechaDet" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalDet" id="personalDet">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 5)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosDet" id="comentariosDet" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <table class="table" id="tablamecanica">
                        <thead>
                            <tr>
                                <th scope="row"><center>Mecanica</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaMeca" value="aplicaMeca" id="aplicaMeca" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechaMeca" id="fechaMeca" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalMec" id="personalMec">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 6)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosMeca" id="comentariosMeca" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <table class="table" id="tablalavado">
                        <thead>
                            <tr>
                                <th scope="row"><center>Lavado e Inspeccion</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="aplicaLava" value="aplicaLava" id="aplicaLava" checked>
                                        <label class="form-check-label" for="defaultCheck1">Aplica</label>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Fecha Ingreso</label>
                                    <input type="date" name="fechaLava" id="fechaLava" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Asignado</label>
                                    <select class="form-control" name="personalLava" id="personalLava">
                                        <option value="0">Seleccione Personal del Vehículo</option>
                                    @foreach ($list_personal as $personal)
                                        @if ($personal->id_area == 7)
                                            <option value="{{$personal->id}}">{{$personal->nombre}}</option>
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="">Comentarios</label>
                                    <input type="text" class="form-control" name="comentariosLava" id="comentariosLava" placeholder="Comentarios...">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
@endsection