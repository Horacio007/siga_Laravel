@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_asesor', $asesores->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Asesor</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Aseguradora</label>
                    <select name="aseguradora" id="saseguradora" class="form-control" required>
                        <option disabled selected>Elige una aseguradora</option>
                        <option selected="true" value="{{$n[0]->id}}">{{$n[0]->nombre}}</option>
                        @foreach ($list_aseguradoras as $aseguradora)
                            <option value="{{$aseguradora->id}}">{{$aseguradora->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="col-md-3">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="inombre" class="form-control" value="{{$asesores->nombre}}" required>
                </div>
                <br>
                <div class="col-md-3">
                    <label for="">Apellido Paterno</label>
                    <input type="text" name="apaterno" id="iapaterno" class="form-control" value="{{$asesores->a_paterno}}" required>
                </div>
                <div class="col-md-3">
                    <label for="">Apellido Materno</label>
                    <input type="text" name="amaterno" id="iamaterno" class="form-control" value="{{$asesores->a_materno}}" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Actualizar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
@endsection