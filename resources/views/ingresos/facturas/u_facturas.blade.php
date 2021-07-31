@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/i_facturas" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Factura</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Marca</label>
                    <input type="text" value="{{$vehiculos->marcas->marca}}" id="marca" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Linea</label>
                    <input type="text" value="{{$vehiculos->submarcas->submarca}}" id="linea" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Color</label>
                    <input type="text" value="{{$vehiculos->color}}" name="color" id="color" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Modelo</label>
                    <input type="text" value="{{$vehiculos->modelo}}" name="modelo" id="modelo" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Placas</label>
                    <input type="text" value="{{$vehiculos->placas}}" name="placas" id="placas" class="form-control" disabled readonly required>
                </div>
                <div class="col-md-2">
                    <label for="">Cliente</label>
                    <input type="text" value="{{$vehiculos->clientes->nombre}}" name="cliente" id="cliente" class="form-control" disabled readonly required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Cantidad</label>
                    <input type="text" value="{{$facturas->cantidad}}" name="cantidad" id="cantidad" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha de Facturacíon</label>
                    <input type="date" value="{{$facturas->fecha_facturacion}}" name="fechaf" id="fechaf" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Estatus Aseguradora</label>
                    <select name="sestatus" id="sestatus" class="form-control" required>
                        <option value="0">Selecciona el estatus</option>
                        @foreach ($estausF as $estatus)
                            @if ($estatus->id == $facturas->estatus_aseguradora)
                                <option value="{{$estatus->id}}" selected>{{$estatus->estatus}}</option>
                            @endif
                            <option value="{{$estatus->id}}">{{$estatus->estatus}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha BBVA</label>
                    <input type="date" value="{{$facturas->fecha_bbva}}" name="fbbva" id="fbbva" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="">Comentarios</label>
                    <input type="text" value="{{$facturas->comentarios}}" name="comentarios" id="comentarios" class="form-control" placeholder="Agrega un comentario..." required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="iexpediente2" id="iexpediente2" hidden readonly required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/ingresos/facturas/u_facturas.js') }}"></script>
@endsection