@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_formaarribo', $forma_aribo->id)}}" method="post">
            @csrf
            {{method_field('POST')}}
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Forma de Arribo</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="forma" id="iforma" class="form-control" placeholder="Nombre de la forma de arribo..." value="{{$forma_aribo->forma_arribo}}" required>
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