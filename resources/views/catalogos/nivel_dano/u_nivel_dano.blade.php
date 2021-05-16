@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_niveldano', $nivel_dano->id)}}" method="post">
            @csrf
            {{method_field('POST')}}
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Nivel de Daño</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="nivel" id="inivel" class="form-control" placeholder="Nombre del nivel de daño..." value="{{$nivel_dano->nivel}}" required>
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