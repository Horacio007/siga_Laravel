@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/" method="post" id="formdataa">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Presupuesto Inicial</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="lexpediente">No. Expediente</label>
                    <input type="text" class="form-control" id="iexpediente" required>
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_buscar">Buscar</button>
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <div id="inf" class="text-center">
                        <label for="" id="info"></label>
                    </div>
                </div>
            </div>
            <br>
        </form>
        <form action="/i_presupuesto" method="POST" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Inicio de Presupuesto</h3>
                </div>
            </div>
            <br>
            <div id="section_piezas"></div>
            <br>
            <div class="row">
                <div class="d-flex">
                    <h3>Piezas</h3>
                    <a class="text-success text-capitalize mx-2 justify-vertical" 
                        role="button" title="Agregar Pieza" id="add_p">
                        <i class="fa fa-plus-circle fa-2x pt-1"></i>
                    </a>    
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="ltmomh">Total M.O.M.H</label>
                    <input type="text" name="itmomh" class="form-control" id="itmomh" required>
                </div>
                <div class="col-md-2">
                    <label for="ltmomp">Total M.O.M.P</label>
                    <input type="text" name="itmomp" class="form-control" id="itmomp" required>
                </div>
                <div class="col-md-2">
                    <label for="ltmomm">Total M.O.M.M</label>
                    <input type="text" name="itmomm" class="form-control" id="itmomm" required>
                </div>
                <div class="col-md-2">
                    <label for="ltmomh">Total T.O.T</label>
                    <input type="text" name="ittot" class="form-control" id="ittot" required>
                </div>
                <div class="col-md-2">
                    <label for="ltrefacciones">Total Refacciones</label>
                    <input type="text" name="itrefacciones" class="form-control" id="itrefacciones" required>
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
                    <input type="text" name="isubtotal" class="form-control" id="isubtotal" required>
                </div>
                <div class="col-md-3">
                    <label for="liva">IVA</label>
                    <input type="text" name="iiva" class="form-control" id="iiva" required>
                </div>
                <div class="col-md-3">
                    <label for="lsubtotal">Total</label>
                    <input type="text" name="itotal" class="form-control" id="itotal" required>
                </div>
                <div class="col-md-3">
                    <label for="lsubtotal"></label>
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular2">Calcular Totales Finales</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly>
                    <input type="text" name="cont" class="form-control" id="cont" required hidden readonly>
                </div>
                <div class="col-md-4">
                    <label for=""></label>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
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

    <script src="{{ asset('js/costeo/presupuesto/presupuesto2.js') }}"></script>
    <script src="{{ asset('libs/jsPDF/jspdf.debug.js') }}"></script>   
@endsection