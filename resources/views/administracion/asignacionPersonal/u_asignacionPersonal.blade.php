@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="/css/administracion/asignacionPersonal/asignacion_personal.css">
    <div class="container-fluid">
        <form action="{{route('u_asignacionPersonal', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Estatus del Seguimiento de Taller</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for=""></label>
                    <div id="inf" class="text-center">
                        <label for="" id="info"></label>
                    </div>
                </div>
                <div class="col-md-2" id="tablaHoja">
                    @if ($vehiculo->aplica_hojalateria == 1)
                        <center><strong>Hojalateria</strong></center>
                        <label for="" id="laplicahoja">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadohoja">Asignado -> {{ $hojalateria->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechahoja" id="fechahoja" class="form-control" value="{{ $vehiculo->fecha_hojalateria }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentarios_hojalateria }}" name="comentariosHoja" id="comentariosHoja" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Hojalateria</strong></center>
                        <label for="" id="laplicahoja">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadohoja">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechahoja" id="fechahoja" class="form-control" value="{{ $vehiculo->fecha_hojalateria }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentariosHoja" id="comentariosHoja" placeholder="Comentarios...">
                        <br>
                    @endif
                    
                </div>
                <div class="col-md-2" id="tablapintura">
                    @if ($vehiculo->aplica_pintura == 1)
                        <center><strong>Pintura</strong></center>
                        <label for="" id="laplicapin">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadopin">Asignado -> {{ $pintura->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechapin" id="fechapin" class="form-control" value="{{ $vehiculo->fecha_pintura }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentario_pintura }}" name="comentariospin" id="comentariospin" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Pintura</strong></center>
                        <label for="" id="laplicapin">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadopin">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechapin" id="fechapin" class="form-control" value="{{ $vehiculo->fecha_pintura }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentariospin" id="comentariospin" placeholder="Comentarios...">
                        <br>
                    @endif
                </div>
                <div class="col-md-2" id="tablaarmado">
                    @if ($vehiculo->aplica_armado == 1)
                        <center><strong>Armado</strong></center>
                        <label for="" id="laplicaarm">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadoarm">Asignado -> {{ $armado->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechaarm" id="fechaarm" class="form-control" value="{{ $vehiculo->fecha_armado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentario_armado }}" name="comentariosarm" id="comentariosarm" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Armado</strong></center>
                        <label for="" id="laplicaarm">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadoarm">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechaarm" id="fechaarm" class="form-control" value="{{ $vehiculo->fecha_armado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentariosarm" id="comentariosarm" placeholder="Comentarios...">
                        <br>
                    @endif
                </div>
                <div class="col-md-2" id="tabladetallado">
                    @if ($vehiculo->aplica_detallado == 1)
                        <center><strong>Detallado</strong></center>
                        <label for="" id="laplicadeta">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadodeta">Asignado -> {{ $detallado->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechadeta" id="fechadeta" class="form-control" value="{{ $vehiculo->fecha_detallado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentario_detallado }}" name="comentariosdeta" id="comentariosdeta" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Detallado</strong></center>
                        <label for="" id="laplicadeta">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadodeta">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechadeta" id="fechadeta" class="form-control" value="{{ $vehiculo->fecha_detallado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentariosdeta" id="comentariosdeta" placeholder="Comentarios...">
                        <br>
                    @endif
                    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2" id="tablamecanica">
                    @if ($vehiculo->aplica_mecanica == 1)
                        <center><strong>Mecanica</strong></center>
                        <label for="" id="laplicameca">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadomeca">Asignado -> {{ $mecanica->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechameca" id="fechameca" class="form-control" value="{{ $vehiculo->fecha_mecanica }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentario_mecanica }}" name="comentariosmeca" id="comentariosmeca" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Mecanica</strong></center>
                        <label for="" id="laplicameca">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadomeca">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechameca" id="fechameca" class="form-control" value="{{ $vehiculo->fecha_mecanica }}>                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentariosmeca" id="comentariosmeca" placeholder="Comentarios...">
                        <br>
                    @endif
                </div>
                <div class="col-md-2" id="tablalavado">
                    @if ($vehiculo->aplica_lavado == 1)
                        <center><strong>Lavado e Inspeccion</strong></center>
                        <label for="" id="laplicalava">Aplica -> Si</label>
                        <br>
                        <label for="" id="lasignadolava">Asignado -> {{ $lavado->nombre??'' }}</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechalava" id="fechalava" class="form-control" value="{{ $vehiculo->fecha_lavado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="{{ $vehiculo->comentario_lavado }}" name="comentarioslava" id="comentarioslava" placeholder="Comentarios...">
                        <br>
                    @else
                        <center><strong>Lavado e Inspeccion</strong></center>
                        <label for="" id="laplicalava">Aplica -> No</label>
                        <br>
                        <label for="" id="lasignadolava">Asignado -> No Aplica</label>
                        <br>
                        <label for="">Fecha Ingreso</label>
                        <input type="date" name="fechalava" id="fechalava" class="form-control" value="{{ $vehiculo->fecha_lavado }}">                
                        <label for="">Comentarios</label>
                        <input type="text" class="form-control" value="No Aplica" name="comentarioslava" id="comentarioslava" placeholder="Comentarios...">
                        <br>
                    @endif
                </div>
                <div class="col-md-2" id="tablaentrega">
                    <center><strong>Entrega al Cliente</strong></center>
                    <label for="">Fecha Entrega</label>
                    <input type="date" name="fechainter" id="fechainter" class="form-control" value=" {{ $vehiculo->fecha_entrega_interna }}">                
                    <label for="">Entrego</label>
                    <input type="text" class="form-control" name="entrego" id="entrego" placeholder="Entrego..." value="{{ $vehiculo->entrego }}">
                    <label for="">Recibio</label>
                    <input type="text" class="form-control" name="recibio" id="recibio" placeholder="Recibio..." value="{{ $vehiculo->recibio }}">
                    <br>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Actualizar" class="btn btn-success btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
@endsection