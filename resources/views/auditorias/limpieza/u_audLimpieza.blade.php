@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('u_audlimpieza', $aud_limpieza->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Auditoria de Limpieza</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Fecha:</label>
                    <input type="date" value="{{$aud_limpieza->fecha}}" name="fecha" id="ifecha" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="">Oficinas:</label>
                    <input type="text" value="{{$aud_limpieza->oficinas}}" name="ofi" id="iofi" class="form-control" placeholder="Calificacción Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Almacen de Limpieza:</label>
                    <input type="text" value="{{$aud_limpieza->al_limpieza}}" name="alimpie" id="ialimpie" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Almacen de Refacciónes:</label>
                    <input type="text" value="{{$aud_limpieza->al_refacciones}}" name="alrefas" id="ialrefas" class="form-control" placeholder="Calificación Total..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Comedor:</label>
                    <input type="text" value="{{$aud_limpieza->comedor}}" name="comedor" id="icomedor" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Mecanica:</label>
                    <input type="text" value="{{$aud_limpieza->mecanica}}" name="meca" id="imeca" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Hojalatero 1: Marcial</label>
                    <input type="text" value="{{$aud_limpieza->hoja_1}}" name="hoja1" id="ihoja1" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Hojalateria 2 Luis Carlos:</label>
                    <input type="text" value="{{$aud_limpieza->hoja_2}}" name="hoja2" id="ihoja2" class="form-control" placeholder="Calificación Total..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Hojalateria 3 Daniel:</label>
                    <input type="text" value="{{$aud_limpieza->hoja_3}}" name="hoja3" id="ihoja3" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Hojalateria Total:</label>
                    <input type="text" value="{{$aud_limpieza->hojalateria}}" name="hoja" id="ihoja" class="form-control" placeholder="Calificación Total..." required readonly>
                </div>
                <div class="col-md-3">
                    <label for="">Preparacion y Pintura:</label>
                    <input type="text" value="{{$aud_limpieza->prep_pint}}" name="prep_pint" id="iprep_pint" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Almacen de Pinturas:</label>
                    <input type="text" value="{{$aud_limpieza->al_pinturas}}" name="alpin" id="ialpin" class="form-control" placeholder="Calificación Total..." required>
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Pulido, Detallado:</label>
                    <input type="text" value="{{$aud_limpieza->pul_det_lav}}" name="puldetlav" id="ipuldetlav" class="form-control" placeholder="Calificación Total..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Lavado:</label>
                    <input type="text" value="{{$aud_limpieza->lavado}}" name="lavado" id="ilavado" class="form-control" placeholder="Calificación Total..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/auditorias/limpieza/i_limpieza.js') }}"></script>
@endsection