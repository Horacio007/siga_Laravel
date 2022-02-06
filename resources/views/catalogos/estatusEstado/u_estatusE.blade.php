@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_estatusE', $estatusEstado->id)}}" method="post">
            @csrf
            {{method_field('POST')}}
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Proceso</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Ubicacion:</label>
                    <input type="text" name="ubicacion" id="ubicacion" value="{{$estatusEstado->ubicacionEstado->status}}" class="form-control" readonly required>
                    <br>
                    <label for="">Proceso</label>
                    <input type="text" name="proceso" id="proceso" value="{{$estatusEstado->estatus}}" class="form-control" required>
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