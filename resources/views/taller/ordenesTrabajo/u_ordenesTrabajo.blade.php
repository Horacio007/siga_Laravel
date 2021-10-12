@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_ordenest', $orden_trabajo->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Reparaciones</h3>
            </div>
        </div>
        <div id="section_reparaciones">
            @php
                $rep = explode('/', $orden_trabajo->reparacion);
            @endphp
            @for ($i = 0; $i < sizeof($rep)-1; $i++)
                @php
                    $j = $i + 1;
                @endphp
                <div id='reparacion_{{$j}}' class='d-flex flex-column'>
                    <div class='row'>
                        <h3>Reparacion #{{$j}}</h3>
                        <a role='button'
                            class='remove_reparacion text-danger text-capitalize mx-2 pt-3'
                            style="margin-top: -18px;" 
                            title='Eliminar Reparacion #{{$j}}' item_id='{{$j}}'>
                            <i class='fa fa-minus-circle fa-2x pt-1'></i>
                        </a>
                    </div>
                    <div class='row'>
                        <div class='col-md-1'></div>
                        <div class='col-md-4'>
                            <label for='lreparacion'>Reparacion</label>
                            <input type="text" value="{{$rep[$i]}}" name='reparaciones_{{$j}}' id='reparaciones_{{$j}}' class='form-control'>
                        </div>
                        <div class='col-md-2 text-center'>
                            <div class='form-check'>
                                <br>
                                <input class='form-check-input' type="checkbox" value='' name='hojalateria_{{$j}}' id='hojalateria_{{$j}}' checked>
                                <label class='form-check-label' for='defaultCheck1'>Hojalateria</label>
                            </div>
                        </div>
                        <div class='col-md-2 text-center'>
                            <div class='form-check'>
                                <br>
                                <input class='form-check-input' type='checkbox' value='' name='pintura_{{$j}}' id='pintura_{{$j}}' checked>
                                <label class='form-check-label' for='defaultCheck1'>Pintura</label>
                            </div>
                        </div>
                        <div class='col-md-2 text-center'>
                            <div class='form-check'>
                                <br>
                                <input class='form-check-input' type='checkbox' value='' name='mecanica_{{$j}}' id='mecanica_{{$j}}' checked>
                                <label class='form-check-label' for='defaultCheck1'>Mecanica</label>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <br>
        <div class="row">
            <div class="d-flex">
                <h3>Reparacion</h3>
                <a class="add_reparacion text-success text-capitalize mx-2 justify-vertical" 
                    role="button" title="Agregar Pieza" id="add_rep">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i>
                </a>   
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">Observaciones</label>
                <textarea class="form-control" name="observaciones" id="tobservaciones" cols="10" rows="5" placeholder="Proporciona informacion adicional si es necesaria">{{$orden_trabajo->observaciones}}</textarea>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <input type="text" id="cont" value="{{sizeof($rep)}}" hidden readonly>
                <input type="text" id="cont2" value="{{sizeof($rep)}}" name="cont2" hidden readonly>
                <input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_crear">Actualizar</button></div>
            <div class="col-md-4"></div>
        </div>
    </form>
</div>
<!-- -->
<div class='reparacion_consecutivo'>
    <div id='reparacion_consecutivo' class='d-flex flex-column'>
        <div class='row'>
            <h3>Reparacion #consecutivo</h3>
            <a role='button'
                class='remove_reparacion text-danger text-capitalize mx-2 pt-3'
                style="margin-top: -18px;" 
                title='Eliminar Reparacion #consecutivo' item_id='consecutivo'>
                <i class='fa fa-minus-circle fa-2x pt-1'></i>
            </a>
        </div>
        <div class='row'>
            <div class='col-md-1'></div>
            <div class='col-md-4'>
                <label for='lreparacion'>Reparacion</label>
                <input type="text" name='reparaciones_consecutivo' id='reparaciones_consecutivo' class='form-control'>
            </div>
            <div class='col-md-2 text-center'>
                <div class='form-check'>
                    <br>
                    <input class='form-check-input' type="checkbox" value='' name='hojalateria_consecutivo' id='hojalateria_consecutivo' checked>
                    <label class='form-check-label' for='defaultCheck1'>Hojalateria</label>
                </div>
            </div>
            <div class='col-md-2 text-center'>
                <div class='form-check'>
                    <br>
                    <input class='form-check-input' type='checkbox' value='' name='pintura_consecutivo' id='pintura_consecutivo' checked>
                    <label class='form-check-label' for='defaultCheck1'>Pintura</label>
                </div>
            </div>
            <div class='col-md-2 text-center'>
                <div class='form-check'>
                    <br>
                    <input class='form-check-input' type='checkbox' value='' name='mecanica_consecutivo' id='mecanica_consecutivo' checked>
                    <label class='form-check-label' for='defaultCheck1'>Mecanica</label>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/js/taller/ordenesTrabajo/u_ordenesTrabajo.js') }}"></script>
@endsection