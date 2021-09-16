@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_presupuesto', $presupuestos->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Actualizar Presupuesto Inicial</h3>
            </div>
        </div>
        <br>
        <div id="section_piezas">
            @php
            $op = explode('/', $presupuestos->op);
            $nivel = explode('/', $presupuestos->nivel);
            $concepto = explode('/', $presupuestos->concepto);
            $momh = explode('/', $presupuestos->momh);
            $momp = explode('/', $presupuestos->momp);
            $momm = explode('/', $presupuestos->momm);
            $tot = explode('/', $presupuestos->tot);
            $refacciones = explode('/', $presupuestos->refacciones);
            @endphp
            @for ($i = 0; $i < sizeof($op)-1; $i++)
                @php
                    $j = $i + 1;
                @endphp
                <div id="{{'pieza_'.$j}}" class='d-flex flex-column'>
                    <div class='row'>
                        <h3>Pieza #{{$j}}</h3>
                        <a role='button'
                                class='remove_pieza text-danger text-capitalize mx-2 pt-3'
                                style="margin-top: -18px;" 
                                title='Eliminar Pieza #{{$j}}' item_id='{{$j}}'>
                                <i class='fa fa-minus-circle fa-2x pt-1'></i>
                            </a>
                    </div>
                    <div class='row'>
                        <div class='col-md-2'>
                            <label for='loperacion'>Operacion</label>
                            <select name='toperacion_{{$j}}' id='toperacion_{{$j}}' class='form-control' required>
                                <option value='0'>Selecciona la operacion</option>
                                @switch($op[$i])
                                    @case(1)
                                        <option value='1' selected>Cambio</option>
                                        <option value='2'>Reparacion</option>
                                        <option value='3'>Rescate</option>
                                        @break
                                    @case(2)
                                        <option value='1'>Cambio</option>
                                        <option value='2' selected>Reparacion</option>
                                        <option value='3'>Rescate</option>
                                        @break

                                    @case(3)
                                        <option value='1'>Cambio</option>
                                        <option value='2'>Reparacion</option>
                                        <option value='3' selected>Rescate</option>
                                        @break;
                                    @default
                                        
                                @endswitch
                            </select>
                        </div>
                        <div class='col-md-2'>
                            <label for='loperacion'>Nivel</label>
                            <select name='tnivel_{{$j}}' id='tnivel_{{$j}}' class='form-control' required>
                                <option value='0'>Selecciona el nivel de daño</option>
                                @switch($nivel[$i])
                                    @case(1)
                                        <option value='1' selected>Alto</option>
                                        <option value='2'>Medio</option>
                                        <option value='3'>Leve</option>
                                        @break
                                    @case(2)
                                        <option value='1'>Alto</option>
                                        <option value='2'selected>Medio</option>
                                        <option value='3'>Leve</option>
                                        @break
                                    @case(3)
                                        <option value='1'>Alto</option>
                                        <option value='2'>Medio</option>
                                        <option value='3' selected>Leve</option>
                                        @break
                                    @default
                                        
                                @endswitch
                            </select>
                        </div>
                        <div class='col-md-3'>
                            <label for='lconceptio'>Concepto</label>
                            <input type='text' value="{{$concepto[$i]}}" name='tconcepto_{{$j}}' id='tconcepto_{{$j}}' class='form-control' placeholder='Agrega el concepto...' required>
                        </div>
                        <div class='col-md-1'>
                            <label for='loperacion'>M.O.M.H</label>
                            <input type='text' value="{{$momh[$i]}}" name='tmomh_{{$j}}' id='tmomh_{{$j}}' class='form-control' placeholder='Agrega el costo de mano de obra y material de hojalateria' required>
                        </div>
                        <div class='col-md-1'>
                            <label for='loperacion'>M.O.M.P</label>
                            <input type='text' value="{{$momp[$i]}}" name='tmomp_{{$j}}' id='tmomp_{{$j}}' class='form-control' placeholder='Agrega el costo de mano de obra y material de pintura' required>
                        </div>
                        <div class='col-md-1'>
                            <label for='lconceptio'>M.O.M.M</label>
                            <input type='text' value="{{$momm[$i]}}" name='tmomm_{{$j}}' id='tmomm_{{$j}}' class='form-control' placeholder='Agrega el costo de mano de obra y material de mecanica' required>
                        </div>
                        <div class='col-md-1'>
                            <label for='lconceptio'>T.O.T</label>
                            <input type='text' value="{{$tot[$i]}}" name='ttot_{{$j}}' id='ttot_{{$j}}' class='form-control' placeholder='Agrega el costo de trabajos en otro taller' required>
                        </div>
                        <div class='col-md-1'>
                            <label for='lconceptio'>Refacciones</label>
                            <input type='text' value="{{$refacciones[$i]}}" name='trefacciones_{{$j}}' id='trefacciones_{{$j}}' class='form-control' placeholder='Agrega el costo de las refacciones' required>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <br>
        <div class="row">
            <div class="d-flex">
                <h3>Piezas</h3>
                <a class="add_pieza text-success text-capitalize mx-2 justify-vertical" 
                    role="button" title="Agregar Pieza" id="add_p">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i>
                </a>    
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
                <label for="ltmomh">Total M.O.M.H</label>
                <input type="text" value="{{$presupuestos->tmomh}}" name="ttmomh" class="form-control" id="itmomh">
            </div>
            <div class="col-md-2">
                <label for="ltmomp">Total M.O.M.P</label>
                <input type="text" value="{{$presupuestos->tmomp}}" name="ttmomp" class="form-control" id="itmomp">
            </div>
            <div class="col-md-2">
                <label for="ltmomm">Total M.O.M.M</label>
                <input type="text" value="{{$presupuestos->tmomm}}" name="ttmomm" class="form-control" id="itmomm">
            </div>
            <div class="col-md-2">
                <label for="ltmomh">Total T.O.T</label>
                <input type="text" value="{{$presupuestos->ttot}}" name="tttot" class="form-control" id="ittot">
            </div>
            <div class="col-md-2">
                <label for="ltrefacciones">Total Refacciones</label>
                <input type="text" value="{{$presupuestos->trefacciones}}" name="ttrefacciones" class="form-control" id="itrefacciones">
            </div>
            <div class="col-md-2">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular">Calcular Totales</button>
            </div>
        </div>
        <br> 
        <div class="row">
            <div class="col-md-3">
                <label for="lsubtotal">Sub-Total</label>
                <input type="text" value="{{$presupuestos->subtotal}}" name="tsubtotal" class="form-control" id="isubtotal">
            </div>
            <div class="col-md-3">
                <label for="liva">IVA</label>
                <input type="text" value="{{$presupuestos->iva}}" name="tiva" class="form-control" id="iiva">
            </div>
            <div class="col-md-3">
                <label for="lsubtotal">Total</label>
                <input type="text" value="{{$presupuestos->total}}" name="ttotal" class="form-control" id="itotal">
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular2">Calcular Totales Finales</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="cont" value="{{sizeof($op)}}" hidden readonly>
                <input type="text" id="cont2" name="cont2" hidden readonly>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>
</div>
<!-- -->
<div class='pieza_consecutivo'>
    <div id='pieza_consecutivo' class='d-flex flex-column'>
        <div class='row'>
            <h3>Pieza #consecutivo</h3>
            <a role='button'
                    class='remove_pieza text-danger text-capitalize mx-2 pt-3'
                    style="margin-top: -18px;" 
                    title='Eliminar Pieza #consecutivo' item_id='consecutivo'>
                    <i class='fa fa-minus-circle fa-2x pt-1'></i>
                </a>
        </div>
        <div class='row'>
            <div class='col-md-2'>
                <label for='loperacion'>Operacion</label>
                <select name='toperacion_consecutivo' id='toperacion_consecutivo' class='form-control' required>
                    <option value='0'>Selecciona la operacion</option>
                    <option value='1'>Cambio</option>
                    <option value='2'>Reparacion</option>
                    <option value='3'>Rescate</option>
                </select>
            </div>
            <div class='col-md-2'>
                <label for='loperacion'>Nivel</label>
                <select name='tnivel_consecutivo' id='tnivel_consecutivo' class='form-control' required>
                    <option value='0'>Selecciona el nivel de daño</option>
                    <option value='1'>Alto</option>
                    <option value='2'>Medio</option>
                    <option value='3'>Leve</option>
                </select>
            </div>
            <div class='col-md-3'>
                <label for='lconceptio'>Concepto</label>
                <input type='text' name='tconcepto_consecutivo' id='tconcepto_consecutivo' class='form-control' placeholder='Agrega el concepto...' required>
            </div>
            <div class='col-md-1'>
                <label for='loperacion'>M.O.M.H</label>
                <input type='text' name='tmomh_consecutivo' id='tmomh_consecutivo' class='form-control' placeholder='Agrega el costo de mano de obra y material de hojalateria' required>
            </div>
            <div class='col-md-1'>
                <label for='loperacion'>M.O.M.P</label>
                <input type='text' name='tmomp_consecutivo' id='tmomp_consecutivo' class='form-control' placeholder='Agrega el costo de mano de obra y material de pintura' required>
            </div>
            <div class='col-md-1'>
                <label for='lconceptio'>M.O.M.M</label>
                <input type='text' name='tmomm_consecutivo' id='tmomm_consecutivo' class='form-control' placeholder='Agrega el costo de mano de obra y material de mecanica' required>
            </div>
            <div class='col-md-1'>
                <label for='lconceptio'>T.O.T</label>
                <input type='text'  name='ttot_consecutivo' id='ttot_consecutivo' class='form-control' placeholder='Agrega el costo de trabajos en otro taller' required>
            </div>
            <div class='col-md-1'>
                <label for='lconceptio'>Refacciones</label>
                <input type='text' name='trefacciones_consecutivo' id='trefacciones_consecutivo' class='form-control' placeholder='Agrega el costo de las refacciones' required>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/costeo/presupuesto/u_presupuesto2.js') }}"></script>
@endsection