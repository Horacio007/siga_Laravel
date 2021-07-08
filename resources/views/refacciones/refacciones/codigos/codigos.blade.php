@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="" class="formdata" id="formdata">
        <div class="row">
            <div class="col text-center">
                <h3>Creación de Codigo de Barras y QR</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Contenido</label>
                <input type="text" id="icontenido" class="form-control" require>
            </div>
            <div class="col-md-2">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_cbarras" item_id="2">Barras</button>
            </div>
            <div class="col-md-2">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_cqr">QR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <img id="barcode"></img>
            </div>
            <div class="col-md-6 text-center">
                <br>
                <div id="qrcode" class="col text-center"></div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('/js/refacciones/refacciones/codigos/codigos.js') }}"></script>
<script src="{{ asset('/libs/qrcode/qrcode.min.js') }}"></script>
<script src="{{ asset('/libs/JsBarcode/JsBarcode.all.min.js') }}"></script>
@endsection