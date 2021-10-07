@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_Brefacciones', $vehiculo->id)}}" method="post" id="formdata">
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
                        <option value="0">Selecciona el estatus</option>
                        @foreach ($list_estatus as $estatus)
                            @if ($estatus->id == $vehiculo->refacciones_id)
                                <option value="{{$estatus->id}}" selected>{{$estatus->estatus}}</option>
                            @else
                                <option value="{{$estatus->id}}">{{$estatus->estatus}}</option>
                            @endif
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