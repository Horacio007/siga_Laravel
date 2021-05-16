@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_marca', $modelosv->id)}}" method="post">
            @csrf
            {{method_field('POST')}}
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Marca</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="marca" id="imarca" class="form-control" placeholder="Nombre de la marca..." value="{{$modelosv->marca}}" required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Actualizar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </form>
    </div>
@endsection