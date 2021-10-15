@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('/libs/fullcalendar/main.min.css') }}">
<div class="container-fluid">
    <hr>
    <div id="agenda">

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script  type="text/javascript" src="{{ asset('/libs/fullcalendar/main.min.js') }}"></script>
<script  type="text/javascript" src="{{ asset('/libs/fullcalendar/locales-all.min.js') }}"></script>
<script  type="text/javascript" src="{{ asset('/js/recepcion/agenda/agenda.js') }}"></script>

<div class="modal fade" id="evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agendar</h5>
            </div>
                <div class="modal-body">
                    <form action="" method="post" id="modal_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md">
                                    <input type="text" name="id" id="id" hidden readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Titulo</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Motivo</label>
                                    <select class="form-control" name="motivo" id="motivo" required>
                                        <option value="0">Elige el motivo...</option>
                                        <option value="1">Valuacion</option>
                                        <option value="2">Reparacion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Fecha Inicio</label>
                                    <input type="date" class="form-control" name="start" id="start" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Hora Inicio</label>
                                    <input type="time"class="form-control" name="start2" id="start2" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Fecha Final</label>
                                    <input type="date" class="form-control" name="end" id="end" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Hora Final</label>
                                    <input type="time" class="form-control" name="end2" id="end2" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_save" class="btn btn-success">Guardar</button>
                <button type="button" id="btn_update" class="btn btn-warning">Actualizar</button>
                <button type="button" id="btn_delete" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection