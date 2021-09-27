@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('u_cotizacion', $costrefacciones->id)}}" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Cotizar Refacciones</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-md-2">
                <label for="lproveedor1" >Proveedor 1</label>
                <input type="text" value="{{$costrefacciones->nombreprov1??''}}" name="nprovedor1" id="nprovedor1" class="form-control" required placeholder="Nombre">
            </div>
            <div class="col-md-2">
                <label for="lproveedor2">Proveedor 2</label>
                <input type="text" value="{{$costrefacciones->nombreprov2??''}}" name="nprovedor2" id="nprovedor2" class="form-control" required placeholder="Nombre">
            </div>
            <div class="col-md-2">
                <label for="lproveedor3">Proveedor 3</label>
                <input type="text" value="{{$costrefacciones->nombreprov3??''}}" name="nprovedor3" id="nprovedor3" class="form-control" required placeholder="Nombre">
            </div>
        </div>
        <br>
        @php
            $conceptos = explode('/', $costrefacciones->concepto);
            $cantidad =  explode('/', $costrefacciones->cantidad);
            $proveedor1 = explode('/', $costrefacciones->proveedor1);
            $proveedor2 = explode('/', $costrefacciones->proveedor2);
            $proveedor3 =  explode('/', $costrefacciones->proveedor3);
            $proveedorfinal =  explode('/', $costrefacciones->proveedorfinal);
            $costofinal = explode('/', $costrefacciones->costo);
            $fechas = explode('/', $costrefacciones->fecha_promesa);
            $n_guia = explode('-', $costrefacciones->num_guia);
            $comentarios = explode('/', $costrefacciones->comentarios);
        @endphp
        @for ($i = 0; $i < sizeof($conceptos)-1; $i++)
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <label for="lconcepto" >Concepto #{{$j}}</label>
                    <input name="tconcepto_{{$j}}" value="{{$conceptos[$i]}}" id="tconcepto_{{$j}}" class="form-control" required>
                </div>
                <div class="col-md-1">
                    <label for="lcantidad">Cantidad #{{$j}}</label>
                    <input name="tcantidad_{{$j}}" value="{{$cantidad[$i]??''}}" id="tcantidad_{{$j}}" class="form-control" placeholder="Agrega las Cantidades" required>
                </div>
                <div class="col-md-2">
                    <label for="">Precio #{{$j}}</label>
                    <input name="tproveedor1_{{$j}}" value="{{$proveedor1[$i]??''}}" id="tproveedor1_{{$j}}" class="form-control" placeholder="Agrega los Precios" required>
                </div>
                <div class="col-md-2">
                    <label for="">Precio #{{$j}}</label>
                    <input name="tproveedor2_{{$j}}" value="{{$proveedor2[$i]??''}}" id="tproveedor2_{{$j}}" class="form-control" placeholder="Agrega los Precios" required>
                </div>
                <div class="col-md-2">
                    <label for="">Precio #{{$j}}</label>
                    <input name="tproveedor3_{{$j}}" value="{{$proveedor3[$i]??''}}" id="tproveedor3_{{$j}}" class="form-control" placeholder="Agrega los Precios" required>
                </div>
            </div>
            @php
                $j++;
            @endphp
        @endfor
        <br>
        <div class="row">
            <div class="col-md-3">
                <label for="" id="lprov1">{{'Total -> '.$costrefacciones->nombreprov1??''}}</label>
                <input type="text" value="{{$costrefacciones->tproveedor1??''}}" class="form-control"  name="tprov1" id="tprov1" required>
            </div>
            <div class="col-md-3">
                <label for="" id="lprov2">{{'Total -> '.$costrefacciones->nombreprov2??''}}</label>
                <input type="text" value="{{$costrefacciones->tproveedor2??''}}" class="form-control" name="tprov2" id="tprov2" required>
            </div>
            <div class="col-md-3">
                <label for="" id="lprov3">{{'Total -> '.$costrefacciones->nombreprov3??''}}</label>
                <input type="text" value="{{$costrefacciones->tproveedor3??''}}" class="form-control" name="tprov3" id="tprov3" required>
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular">Calcular Totales</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    @for ($i = 0; $i < sizeof($conceptos)-1; $i++)
                        <div class="col-md-4">
                            <label for="">Proveedror Final</label>
                            <input type="text" value="{{$proveedorfinal[$i]??''}}" name="tproveedorf_{{$k}}" id="tproveedorf_{{$k}}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Concepto</label>
                            <input type="text" value="{{$conceptos[$i]??''}}" name="tconceptosf_{{$k}}" id="tconceptos_{{$k}}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Costos</label>
                            <input type="text" value="{{$costofinal[$i]??''}}" name="tcostosf_{{$k}}" id="tcostosf_{{$k}}" class="form-control" required>
                        </div>
                        @php
                            $k++;
                        @endphp
                    @endfor
                </div>
            </div>
            <div class="col-md-3">
                <label for="">Costos Finales</label>
                <input type="text" value="{{$costrefacciones->costofinal??''}}" class="form-control" name="tcostosf" id="tcostosf" required>
            </div>
            <div class="col-md-3">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_calcular2">Calcular Totales Finales</button>
            </div>
        </div>
        <br>
        <div class="row">
            @for ($i = 0; $i < sizeof($conceptos)-1; $i++)
                <div class="col-md-4">
                    <label for="" >Fecha Promesa</label>
                    <input type="date" value="{{$fechas[$i]??''}}" name="tfechapromesa_{{$l}}" id="tfechapromesa_{{$l}}" class="form-control" placeholder="Agrega las Fechas Promesa">
                </div>
                <div class="col-md-4">
                    <label for="" >Numero Guia</label>
                    <input type="text" value="{{$n_guia[$i]??''}}" name="tnumguia_{{$l}}" id="tnumguia_{{$l}}" class="form-control" placeholder="Agrega los Numeros de Guia">
                </div>
                <div class="col-md-4">
                    <label for="" >Comentarios</label>
                    <input type="text" value="{{$comentarios[$i]??''}}" name="tcomentarios_{{$l}}" id="tcomentarios_{{$l}}" class="form-control" placeholder="Agrega los Comentarios">
                </div>
                @php
                    $l++;
                @endphp
            @endfor
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="t_ref" id="t_ref" value="{{sizeof($conceptos)-1}}" hidden readonly>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
    </form>
</div>
<script src="{{ asset('js/compras/cotizar/u_cotizar.js') }}"></script>
@endsection