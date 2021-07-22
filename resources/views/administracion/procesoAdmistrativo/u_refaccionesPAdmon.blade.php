@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_BrefaccionesPA', $vehiculo->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Estatus Refacciones</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="lestatus">Estatus:</label><br>
                    <select name="estatus" class="form-control" required>
                        <option value="{{$vehiculo->estatus_id}}" selected>{{$e_actual->status}}</option>
                        @foreach ($list_estatus as $estatus)
                            <option value="{{$estatus->id}}">{{$estatus->status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for=""></label>
                    <input type="submit" value="Actualizar" class="btn btn-primary btn-lg btn-block">
                </div>
            </div>
        </form>
    </div>
@endsection