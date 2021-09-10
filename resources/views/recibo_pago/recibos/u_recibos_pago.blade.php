@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/DataTables-1.10.25/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Buttons-1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/libs/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <div class="container-fluid">
        <form action="{{ route('u_recibo_pagos', $recibo_pagos->id) }}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Recibo de Pago</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="">Requiere Factura</label>
                    <select name="aplica_factura" class="form-control" required>
                        <option value="0">Selecciona si aplica factura</option>
                        @foreach ($si_no as $aplica_fac)
                        @if ($aplica_fac->id == $recibo_pagos->aplica_factura)
                            <option value="{{$aplica_fac->id}}" selected>{{$aplica_fac->nombre}}</option>
                        @endif      
                            <option value="{{$aplica_fac->id}}">{{$aplica_fac->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha</label>
                    <input type="date" value="{{$recibo_pagos->fecha}}" name="fecha" id="fecha" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">Cantidad</label>
                    <input type="number" value="{{$recibo_pagos->cantidad}}" name="cantidad" id="cantidad" class="form-control"required>
                </div>
                <div class="col-md-2">
                    <label for="">Forma de Pago</label>
                    <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                        <option value="0">Selecciona el tipo de anticipo</option>
                        @foreach ($tipo_pago as $tp)
                            @if ($tp->id == $recibo_pagos->forma_pago)
                                <option value="{{$tp->id}}" selected>{{$tp->tipo_pago}}</option>
                            @endif
                            <option value="{{$tp->id}}">{{$tp->tipo_pago}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Tipo de Servico</label>
                    <select name="tipo_servicio" id="i_ingresos" class="form-control">
                        <option value="0">Selecciona el tipo de servicio</option>
                        @foreach ($tipo_servicio as $servicio)                                
                            @if ($servicio->id == $recibo_pagos->tipo_servicio_id)
                                <option value="{{$servicio->id}}" selected>{{$servicio->tipo_servicio}}</option>
                            @else
                                <option value="{{$servicio->id}}">{{$servicio->tipo_servicio}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Concepto</label>
                    <input type="text" value="{{$recibo_pagos->concepto}}" name="concepto" id="concepto" class="form-control" required>
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
            <br>
        </form>
    </div>
@endsection