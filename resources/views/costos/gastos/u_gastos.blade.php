@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('u_gastos', $gastos->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Gasto</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Fecha</label>
                    <input type="date" value="{{$gastos->fecha}}" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="">Articulos</label>
                    <input type="text" value="{{$gastos->articulos}}" name="articulo" id="articulo" class="form-control" placeholder="Ingresa el articulo..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Cantidad</label>
                    <input type="text" value="{{$gastos->gastos}}" name="cantidad" id="cantidad" class="form-control" placeholder="Ingresa la cantidad..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Forma de Pago</label>
                    <select name="forma_pago" id="sfpago" class="form-control" required>
                        <option value="0">Seleccion Froma de Pago:</option>
                        @foreach ($forma_pago as $fp)
                            @if ($fp->id == $gastos->forma_pago)
                                <option value="{{$fp->id}}" selected>{{$fp->forma_pago}}</option>
                            @endif
                            <option value="{{$fp->id}}">{{$fp->forma_pago}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Factura</label>
                    <select name="sfactura" id="sfactura" class="form-control" required>
                        <option value="0">Aplica factura...</option>
                       @foreach ($sino as $sn)
                            @if ($sn->id == $gastos->factura)
                                <option value="{{$sn->id}}" selected>{{$sn->nombre}}</option>
                            @endif
                           <option value="{{$sn->id}}">{{$sn->nombre}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Tipo de Gasto</label>
                    <select name="gasto" id="cpago" class="form-control" required>
                        <option value="0">Seleccion Concepto de Pago:</option>
                        @foreach ($conceptos_pago as $concepto)
                            @if ($concepto->id == $gastos->tipo)
                                <option value="{{$concepto->id}}" selected>{{$concepto->concepto_pago}}</option>
                            @endif
                            <option value="{{$concepto->id}}">{{$concepto->concepto_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Proveedor</label>
                    <input type="text" value="{{$gastos->proveedor}}" name="proveedor" id="proveedor" class="form-control" placeholder="Ingrese Proveedor..." required>
                </div>
                <div class="col-md-3">
                    <label for="">Expediente</label>
                    <input type="text" value="{{$gastos->expediente}}" name="expediente" id="expediente" class="form-control" placeholder="Ingrese el numero de expediente" required>
                    <div id="inf" class="text-center">
                        <label for="" id="info"></label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/costos/gastos/u_gastos.js') }}"></script>
@endsection