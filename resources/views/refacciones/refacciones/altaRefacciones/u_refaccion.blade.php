@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_refaccion', $almacen->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Actualizar Refaccion</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="">Descripcion</label>
                <input type="text" name="descripcion" id="idescripcion" class="form-control" value="{{$almacen->descripcion}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Marca</label>
                <input type="text" name="marca" id="sautos" class="form-control" value="{{$vehiculo->marcas->marca}}" requiere readonly>
            </div>
            <div class="col-md-3">
                <label for="isubmarca">Sub-marca</label>
                <input type="text" name="submarca" id="sautoslinea" value="{{$vehiculo->submarcas->submarca}}" class="form-control" required readonly>
            </div>
            <div class="col-md-3">
                <label for="">Modelo</label>
                <input type="text" name="modelo" id="imodelo" value="{{$vehiculo->modelo}}" class="form-control" required readonly>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="">Aseguradora</label>
                <input type="text" name="aseguradora" id="saseguradora" value="{{$vehiculo->clientes->nombre}}" class="form-control" required readonly>
            </div>
            <div class="col-md-3">
                <label for="">Proveedor</label>
                <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{$almacen->proveedor}}" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha Promesa</label>
                <input type="date" name="fechapromesa" id="ifechapromesa" class="form-control" value="{{$almacen->fecha_promesa}}" required>
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection