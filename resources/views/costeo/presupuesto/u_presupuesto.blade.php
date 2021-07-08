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
        <div class="row">
            <div class="col-md-4">
                <label for="loperacion">Operacion</label>
                <textarea name="toperacion" id="toperacion" cols="30" rows="5" class="form-control" style="text-transform: uppercase;" placeholder="Agrega las operaciones">{{$presupuestos->op}}</textarea>
            </div>
            <div class="col-md-4">
                <label for="loperacion">Nivel</label>
                <textarea name="tnivel" id="tnivel" cols="30" rows="5" class="form-control" placeholder="Agrega los niveles de daño">{{$presupuestos->nivel}}</textarea>
            </div>
            <div class="col-md-4">
                <label for="lconceptio">Concepto</label>
                <textarea name="tconcepto" id="tconcepto" cols="30" rows="5" class="form-control" placeholder="Agrega los conceptos">{{$presupuestos->concepto}}</textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label for="loperacion">M.O.M.H</label>
                <textarea name="tmomh" id="tmomh" cols="30" rows="5" class="form-control" placeholder="Agrega el costo de mano de obra y material de hojalateria">{{$presupuestos->momh}}</textarea>
            </div>
            <div class="col-md-2">
                <label for="loperacion">M.O.M.P</label>
                <textarea name="tmomp" id="tmomp" cols="30" rows="5" class="form-control" placeholder="Agrega el costo de mano de obra y material de pintura">{{$presupuestos->momp}}</textarea>
            </div>
            <div class="col-md-2">
                <label for="lconceptio">M.O.M.M</label>
                <textarea name="tmomm" id="tmomm" cols="30" rows="5" class="form-control" placeholder="Agrega el costo de mano de obra y material de mecanica">{{$presupuestos->momm}}</textarea>
            </div>
            <div class="col-md-2">
                <label for="lconceptio">T.O.T</label>
                <textarea name="ttot" id="ttot" cols="30" rows="5" class="form-control" placeholder="Agrega el costo de trabajos en otro taller">{{$presupuestos->tot}}</textarea>
            </div>
            <div class="col-md-2">
                <label for="lconceptio">Refacciones</label>
                <textarea name="trefacciones" id="trefacciones" cols="30" rows="5" class="form-control" placeholder="Agrega el costo de las refacciones">{{$presupuestos->refacciones}}</textarea>
            </div>
            <div class="col-md-1"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">
                <label for="ltmomh">Total M.O.M.H</label>
                <input type="text" name="ttmomh" class="form-control" id="itmomh">
            </div>
            <div class="col-md-2">
                <label for="ltmomp">Total M.O.M.P</label>
                <input type="text" name="ttmomp" class="form-control" id="itmomp">
            </div>
            <div class="col-md-2">
                <label for="ltmomm">Total M.O.M.M</label>
                <input type="text" name="ttmomm" class="form-control" id="itmomm">
            </div>
            <div class="col-md-2">
                <label for="ltmomh">Total T.O.T</label>
                <input type="text" name="tttot" class="form-control" id="ittot">
            </div>
            <div class="col-md-2">
                <label for="ltrefacciones">Total Refacciones</label>
                <input type="text" name="ttrefacciones" class="form-control" id="itrefacciones">
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
                <input type="text" name="tsubtotal" class="form-control" id="isubtotal">
            </div>
            <div class="col-md-3">
                <label for="liva">IVA</label>
                <input type="text" name="tiva" class="form-control" id="iiva">
            </div>
            <div class="col-md-3">
                <label for="lsubtotal">Total</label>
                <input type="text" name="ttotal" class="form-control" id="itotal">
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular2">Calcular Totales Finales</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>
</div>
<script src="{{ asset('js/costeo/presupuesto/u_presupuesto.js') }}"></script>
@endsection