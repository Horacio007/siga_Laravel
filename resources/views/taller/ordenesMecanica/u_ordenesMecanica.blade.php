@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_ordenesm', $orden_mecanica->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Reparaciones</h3>
            </div>
        </div>
        <br>
        <div id="section_diagnostico">
            @php
                $diag = explode('/', $orden_mecanica->diagnostico);
            @endphp
            @for ($i = 0; $i < sizeof($diag)-1; $i++)
                @php
                    $j = $i + 1;
                @endphp
                <div id='diagnostico_{{$j}}' class='d-flex flex-column'>
                    <div class='row'>
                        <h3>Diagnostico #{{$j}}</h3>
                        <a role='button'
                            class='remove_diagnostico text-danger text-capitalize mx-2 pt-3'
                            style="margin-top: -18px;" 
                            title='Eliminar Diagnostico #{{$j}}' item_id='{{$j}}'>
                            <i class='fa fa-minus-circle fa-2x pt-1'></i>
                        </a>
                    </div>
                    <div class='row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-8'>
                            <label for='lreparacion'>Diagnostico</label>
                            <input type='text' value="{{$diag[$i]}}" name='diagnostico_{{$j}}' id='idiagnostico_{{$j}}' class='form-control'>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <br>
        <div class="row">
            <div class="d-flex">
                <h3>Diagnostico</h3>
                <a class="add_reparacion text-success text-capitalize mx-2 justify-vertical" 
                    role="button" title="Agregar Diagnostico" id="add_rep">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i>
                </a>   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="cont" value="{{sizeof($diag)}}" hidden readonly>
                <input type="text" id="cont2" value="{{sizeof($diag)}}" name="cont2" hidden readonly>
                <input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_crear">Actualizar</button></div>
            <div class="col-md-4"></div>
        </div>
        <br>
    </form>
</div>
<!-- -->
<div class='diagnostico_consecutivo'>
    <div id='diagnostico_consecutivo' class='d-flex flex-column'>
        <div class='row'>
            <h3>Diagnostico #consecutivo</h3>
            <a role='button'
                class='remove_diagnostico text-danger text-capitalize mx-2 pt-3'
                style="margin-top: -18px;" 
                title='Eliminar Diagnostico #consecutivo' item_id='consecutivo'>
                <i class='fa fa-minus-circle fa-2x pt-1'></i>
            </a>
        </div>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-8'>
                <label for='lreparacion'>Diagnostico</label>
                <input type='text' name='diagnostico_consecutivo' id='idiagnostico_consecutivo' class='form-control'>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/taller/ordenesMecanica/u_ordenesMecanica.js') }}"></script>
@endsection