@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/i_estatusF" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar Estatus Facturas</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="estatus" id="estatus" class="form-control" placeholder="Nombre del estatus..." required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </form>
    </div>
@endsection